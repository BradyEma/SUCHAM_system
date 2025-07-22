<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Supplier;
use App\Models\Logistics;
use Illuminate\Http\Request;
use App\Models\DemandPrediction;
use App\Models\VendorValidation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Symfony\Component\Process\Exception\ProcessFailedException;


class AdminController extends Controller
{
    
   public function dashboard() 
    {
        $suppliers = Supplier::with('user')->get();

        // Fetch the latest validation per supplier
        $validations = VendorValidation::select('vendor_validations.*')
            ->join(DB::raw('(SELECT MAX(id) as max_id FROM vendor_validations GROUP BY supplier_id) as latest'), function($join) {
                $join->on('vendor_validations.id', '=', 'latest.max_id');
            })
            ->get()
            ->keyBy('supplier_id'); // Keyed by supplier_id for easy lookup

        $predictions = DemandPrediction::orderBy('predicted_for')->take(6)->get();

        $forecastLabels = $predictions->pluck('predicted_for')->map(function ($date) {
            return \Carbon\Carbon::parse($date)->format('M Y');
        });

        $forecastData = $predictions->pluck('quantity');

        return view('dashboard.admin-dashboard', compact(
            'forecastLabels', 'forecastData', 'suppliers', 'validations'
        ));
 $statusCounts = [
        'pending' => Logistics::where('status', 'pending')->count(),
        'processing' => Logistics::where('status', 'processing')->count(),
        'shipped' => Logistics::where('status', 'shipped')->count(),
        'completed' => Logistics::where('status', 'completed')->count(),
        'canceled' => Logistics::where('status', 'canceled')->count(),
    ];

    return view('admin.dashboard', compact('statusCounts'));




    }



        public function activateSupplier($id)
        {
            $supplier = Supplier::where('user_id', $id)->firstOrFail();
            $supplier->status = 'active';
            $supplier->save();

            return redirect()->back()->with('success', 'Supplier has been activated.');
        }

    
    public function showSupplier($id)
    {
        $user = User::findOrFail($id);
        $supplier = Supplier::where('user_id', $user->id)->first();

        $vendorValidation = VendorValidation::where('supplier_id', $user->id)->latest()->first();
        $validation = $vendorValidation;

        return view('admin.supplier-show', compact('user', 'supplier', 'vendorValidation', 'validation'));
    }


            public function suspendSupplier($id)
        {
            $supplier = Supplier::where('user_id', $id)->firstOrFail();
            $supplier->status = 'suspended';
            $supplier->save();

            return redirect()->back()->with('success', 'Supplier suspended successfully.');
        }

        public function deactivateSupplier($id)
        {
            $supplier = Supplier::where('user_id', $id)->firstOrFail();
            $supplier->status = 'deactivated';
            $supplier->save();

            return redirect()->back()->with('success', 'Supplier deactivated successfully.');
        }

        public function chatWithSupplier($id)
        {
            $supplier = Supplier::where('user_id', $id)->firstOrFail();
            return view('admin.chat-with-supplier', compact('supplier'));
        }

        public function profile()
    {
        $admin = auth()->user(); // Get the logged-in admin user

        return view('dashboard.admin-profile', compact('admin'));
    }

    public function uploadProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = auth()->user();

        // Store the image
        $path = $request->file('profile_picture')->store('profile_pictures', 'public');

        // Save path to DB (make sure your `users` table has a `profile_picture` column)
        $user->profile_picture = $path;
        $user->save();

        return redirect()->route('admin.profile')->with('success', 'Profile picture updated!');
    }

    public function demandPredictions(Request $request)
    {
        $group = $request->query('group', 'month'); // default = month

        $forecastPath = storage_path('app/data/demand_predictions.csv');
        $historyPath = storage_path('app/data/datasets.csv');

        $forecast = [];
        if (file_exists($forecastPath)) {
            $csv = array_map('str_getcsv', file($forecastPath));
            $header = array_map('trim', array_shift($csv));
            $forecast = array_map(fn($row) => [
                'product' => $row[0],
                'period' => date($group === 'year' ? 'Y' : ($group === 'week' ? 'o-\WW' : 'Y-m'), strtotime($row[1])),
                'quantity' => $row[2],
                'type' => 'forecast'
            ], $csv);
        }

        $history = [];
        if (file_exists($historyPath)) {
            $df = collect(array_map('str_getcsv', file($historyPath)));
            $header = array_map('trim', $df->shift());
            $records = $df->map(fn($row) => array_combine($header, $row));

            $grouped = $records->groupBy('product')->map(function ($groupRows) use ($group) {
                return $groupRows->groupBy(function ($r) use ($group) {
                    $date = strtotime($r['order_date']);
                    return date($group === 'year' ? 'Y' : ($group === 'week' ? 'o-\WW' : 'Y-m'), $date);
                })->map(function ($rows, $period) {
                    return [
                        'product' => $rows[0]['product'],
                        'period' => $period,
                        'quantity' => $rows->sum('order_amount'),
                        'type' => 'historical',
                    ];
                });
            })->flatten(1)->values();

            $history = $grouped->all();
        }

        return response()->json([...$history, ...$forecast]);
    }


}
