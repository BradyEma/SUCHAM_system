<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerSegment;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendPromoEmailJob;

class CustomerSegmentController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->input('label');

        $query = CustomerSegment::query();

        if ($filter) {
            $query->where('label', $filter);
        }

        $segments = $query->paginate(10); // Show 10 per page

        $grouped = CustomerSegment::selectRaw('label, COUNT(*) as count')
            ->groupBy('label')
            ->pluck('count', 'label');

        $allLabels = $grouped->keys();

        return view('admin.customer-segments.index', compact('segments', 'grouped', 'filter', 'allLabels'));
    }
    public function refresh()
    {
        // Call the ML segmentation script
        $exitCode = Artisan::call('segments:run'); // We'll define this console command next

        if ($exitCode === 0) {
            Session::flash('success', 'Customer segments refreshed successfully.');
        } else {
            Session::flash('error', 'There was an error refreshing segments.');
        }

        return redirect()->route('admin.customer.segments');
    }
    public function exportPdf()
    {
        $segments = collect(\League\Csv\Reader::createFromPath(storage_path('app/data/customer_segments.csv'), 'r')
            ->setHeaderOffset(0)
            ->getRecords());

        $pdf = Pdf::loadView('admin.customer-segments.pdf', ['segments' => $segments]);

        return $pdf->download('customer_segments.pdf');
    }

    public function sendPromo(Request $request)
    {
        $cluster = $request->input('cluster');

        $records = collect(\League\Csv\Reader::createFromPath(storage_path('app/data/customer_segments.csv'), 'r')
            ->setHeaderOffset(0)
            ->getRecords());

        $ids = $records->filter(fn($r) => $r['cluster'] == $cluster)->pluck('customer_id');

        $emails = collect(\League\Csv\Reader::createFromPath(storage_path('app/data/datasets.csv'), 'r')
            ->setHeaderOffset(0)
            ->getRecords())
            ->whereIn('customer_id', $ids)
            ->pluck('customers_email')
            ->unique();

        foreach ($emails as $email) {
            // Dispatch each email to queue
            SendPromoEmailJob::dispatch($email, $cluster);
        }

        return back()->with('success', "📬 Promotion emails are being queued for Cluster $cluster.");
    }

}
