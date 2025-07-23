<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wholesaler;
use Illuminate\Support\Facades\Storage;

class WholesalerController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $wholesaler = Wholesaler::where('user_id', $user->id)->first();

        return view('dashboard.wholesaler-dashboard', compact('user', 'wholesaler'));
    }

    public function showProfileForm()
    {
        $user = Auth::user();
        $wholesaler = Wholesaler::where('user_id', $user->id)->first();

        return view('dashboard.wholesaler-profile', compact('user', 'wholesaler'));
    }

    public function storeProfile(Request $request)
    {
        $request->validate([
            'business_name' => 'required|string',
            'phone' => 'required|string',
            'location' => 'required|string',
            'tin' => 'nullable|string',
            'document' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $userId = Auth::id();

        $documentPath = null;
        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('documents', 'public');
        }

        Wholesaler::updateOrCreate(
            ['user_id' => $userId],
            [
                'business_name' => $request->business_name,
                'phone' => $request->phone,
                'location' => $request->location,
                'tin' => $request->tin,
                'status' => 'pending',
                'document_path' => $documentPath ?? Wholesaler::where('user_id', $userId)->value('document_path'),
            ]
        );

        return redirect()->route('wholesaler.dashboard')->with('success', 'Profile saved!');
    }

    // ✅ Add this method for profile picture upload
    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = auth()->user();

        // Delete old image if it exists
        if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        $path = $request->file('profile_picture')->store('profile_pictures', 'public');
        $user->profile_picture = $path;
        $user->save();

        return back()->with('profile_success', 'Profile picture updated successfully.');
    }
}
