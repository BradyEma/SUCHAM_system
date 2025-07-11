<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerSegment;
use Illuminate\Http\Request;
use App\Mail\PromoMail;

class CustomerSegmentController extends Controller
{
    public function index(Request $request)
    {
        
        
        $cluster = $request->input('cluster');
        
        $segments = \App\Models\CustomerSegment::when($cluster !== null, function ($query) use ($cluster) {
            return $query->where('cluster', $cluster);
        })->paginate(10);
        
        $clusterCounts = \App\Models\CustomerSegment::selectRaw('cluster, COUNT(*) as total')
        ->groupBy('cluster')
        ->pluck('total', 'cluster');
        
        $avgSpend = CustomerSegment::selectRaw('cluster, AVG(order_amount) as avg_spend')
        ->groupBy('cluster')
        ->pluck('avg_spend', 'cluster');

        //for the segment labels
        $segmentLabels = [
            0 => 'Budget Buyers',
            1 => 'Frequent Buyers',
            2 => 'High Spenders'
        ];

        // previous return || return view('admin.customer-segments.index', compact('segments', 'clusterCounts', 'cluster'));
        return view('admin.customer-segments.index', compact('segments', 'clusterCounts', 'cluster', 'segmentLabels', 'avgSpend'));

    }
    public function sendPromotionToCluster($cluster)
    {
        $customers = CustomerSegment::where('cluster', $cluster)->get();

        foreach ($customers as $c) {
            // Look up user email via customer_id
            $user = \App\Models\User::find($c->customer_id);
            if ($user && $user->email) {
                Mail::to($user->email)->send(new PromoMail("You're a valued customer! Enjoy 15% off this month."));
            }
        }

        return redirect()->back()->with('success', "Promotions sent to Cluster $cluster.");
    }
}
