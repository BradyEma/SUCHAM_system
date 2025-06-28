<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
   public function dashboard()
{
    $suppliers = Supplier::with('user')->get(); // with('user') is optional
    return view('dashboard.admin-dashboard', compact('suppliers'));
}

   public function approveSupplier($id)
{
    // $id is the user's ID, not supplier.id
    $supplier = Supplier::where('user_id', $id)->firstOrFail();

    $supplier->is_approved = true;
    $supplier->save(); // ✅ Will now update using WHERE user_id = ?

    return redirect()->back()->with('success', 'Supplier approved successfully.');
}


}
