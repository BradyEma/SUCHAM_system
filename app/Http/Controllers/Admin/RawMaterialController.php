<?php

namespace App\Http\Controllers\Admin;

use App\Models\Inventory;
use App\Models\RawMaterial;
use Illuminate\Http\Request;
use App\Models\ConversionLog;
use App\Models\ReorderReport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\InventoryProcessor;


class RawMaterialController extends Controller
{
    public function index(Request $request)
    {
        $materials = RawMaterial::all();
        $query = ConversionLog::query();

        if ($request->filled('product')) {
            $query->where('product', $request->input('product'));
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->input('date'));
        }

        $conversionLogs = $query->latest()->paginate(10); // Paginate 10 per page
        return view('admin.raw-materials.index', compact('materials', 'conversionLogs'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'material_name' => 'required|string|in:Sugarcane,Beeswax',
            'quantity' => 'required|integer|min:1',
            'reorder_threshold' => 'required|integer|min:0',
        ]);

        $materials = RawMaterial::create($data);

        // ✅ Use instead:
        if (strtolower($materials->material_name) === 'sugarcane') {
            $this->convertSugarcane($materials);
        } elseif (strtolower($materials->material_name) === 'beeswax') {
            $this->convertBeeswax($materials);
        }

        return redirect()->back()->with('success', 'Raw materials added and converted.');
    }
    private function convertToFinalProducts($materialName, $rawQty)
    {
        $unitsPerBatch = 100;

        if (strtolower($materialName) === 'sugarcane') {
            $finalProducts = [
                'white sugar' => 20,
                'brown sugar' => 20,
                'raw sugar' => 20,
                'sugar cubes' => 20,
                'molasses' => 20,
            ];
        } elseif (strtolower($materialName) === 'beeswax') {
            $finalProducts = [
                'honey' => 100,
            ];
        } else {
            return; // Unknown material
        }

        $batches = intdiv($rawQty, $unitsPerBatch);

        foreach ($finalProducts as $product => $amountPerBatch) {
            Inventory::updateOrCreate(
                ['product' => $product], // ← match condition
                [
                    'product' => $product, // ← required during insert
                    'quantity' => DB::raw("quantity + " . ($batches * $amountPerBatch))
                ]
            );
        }
    }
    public function checkAndConvert()
    {
        $sugarcane = RawMaterial::where('material_name', 'Sugarcane')->first();
        $beeswax = RawMaterial::where('material_name', 'Beeswax')->first();

        // ✅ Convert Sugarcane if stock > threshold
        if ($sugarcane && $sugarcane->quantity > $sugarcane->reorder_threshold) {
            $this->convertSugarcane($sugarcane);
        }

        // ✅ Convert Beeswax if stock > threshold
        if ($beeswax && $beeswax->quantity > $beeswax->reorder_threshold) {
            $this->convertBeeswax($beeswax);
        }

        return redirect()->back()->with('success', 'Checked and processed conversions if applicable.');
    }
    private function convertSugarcane($sugarcane)
    {
        $amountToUse = 100; // Use 100 units per conversion batch

        if ($sugarcane->quantity < $amountToUse) return;

        // Products derived from sugarcane
        $products = [
            'white sugar' => 25,
            'brown sugar' => 20,
            'raw sugar' => 20,
            'sugar cubes' => 15,
            'mollases' => 10,
        ];

        foreach ($products as $product => $amountProduced) {
            Inventory::updateOrCreate(
                ['product' => $product], // ✅ FIXED
                [
                    'product' => $product, // ✅ include in both keys and updates
                    'quantity' => DB::raw("quantity + $amountProduced")
                ]
            );

            ConversionLog::create([
                'raw_material' => 'Sugarcane',
                'converted_product' => $product,
                'amount_used' => $amountToUse,
                'amount_produced' => $amountProduced,
                'converted_at' => now(), // optional (if timestamps not auto handled)
            ]);
        }

        $sugarcane->decrement('quantity', $amountToUse);
        $this->checkAndReorder($sugarcane); // ← ADD THIS
    }
    private function convertBeeswax($beeswax)
    {
        $amountToUse = 50;
        $produced = 30;

        if ($beeswax->quantity < $amountToUse) return;

        Inventory::updateOrCreate(
            ['product' => 'honey'],
            [
                'product' => 'honey',
                'quantity' => DB::raw("quantity + $produced")
            ]
        );

        ConversionLog::create([
            'raw_material' => 'Beeswax',
            'converted_product' => 'honey',
            'amount_used' => $amountToUse,
            'amount_produced' => $produced,
            'created_at' => now(), // optional (if timestamps not auto handled)
        ]);

        $beeswax->decrement('quantity', $amountToUse);
        $this->checkAndReorder($beeswax);
    }
    private function checkAndReorder(RawMaterial $material)
    {
        if ($material->quantity < $material->reorder_threshold) {
            $reorderQty = 100; // You can customize logic
            $material->increment('quantity', $reorderQty);

            // Log reorder
            ReorderReport::create([
                'material_name' => $material->material_name,
                'quantity_requested' => $reorderQty,
                'requested_by' => 'System',
                'requested_at' => now(),
            ]);
        }
    }
}
