<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $suppliers = Supplier::with('user')->get(); // eager-load user info

        return view('dashboard.admin-dashboard', compact('suppliers'));
    }
    public function approveSupplier($id)
{
    $supplier = Supplier::findOrFail($id);
    $supplier->is_approved = true;
    $supplier->save();

    return redirect()->route('admin.dashboard')->with('success', 'Supplier approved.');
}
}
