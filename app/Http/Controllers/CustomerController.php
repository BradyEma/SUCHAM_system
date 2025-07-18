<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function dashboard()
{
    $user = Auth::user();

    // Get customer's active conversations
    $conversations = Conversation::where('sender_id', $user->id)
        ->orWhere('receiver_id', $user->id)
        ->with(['sender', 'receiver', 'messages' => function($query) {
            $query->latest()->limit(1);
        }])
        ->get();

    // Count unread messages
    $unreadCount = Message::whereHas('conversation', function($query) use ($user) {
        $query->where('sender_id', $user->id)
              ->orWhere('receiver_id', $user->id);
    })
    ->where('sender_id', '!=', $user->id)
    ->where('is_read', false)
    ->count();

    $products = Product::all(); // or paginate(10)

    // Get recent activity (last 7 days)
    $recentActivity = $conversations->filter(function($conversation) {
        return $conversation->updated_at->isAfter(now()->subDays(7));
    })->count();

    // Mock stats (you can later fetch real data from orders, etc.)
    $stats = [
        'active_orders' => 0,
        'total_spent' => 0,
        'messages' => $unreadCount,
        'wishlist_items' => 0,
    ];

    return view('dashboard.customer-dashboard', compact(
        'user',
        'products',
        'conversations',
        'unreadCount',
        'recentActivity',
        'stats'
        
    ));
}


    public function profile()
    {
        $user = Auth::user();
        return view('dashboard.customer-profile', compact('user'));
    }
    public function addToWishlist(Request $request)
{
    $request->validate([
        'product_name' => 'required|string',
        'product_image' => 'required|string',
    ]);

    Wishlist::firstOrCreate([
        'user_id' => auth()->id(),
        'product_name' => $request->product_name,
        'product_image' => $request->product_image,
    ]);

    return response()->json(['success' => true]);
}

public function getWishlist()
{
    return Wishlist::where('user_id', auth()->id())->get();
}

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        $user = Auth::user();
        $user->update($request->only(['name', 'email']));

        return redirect()->route('customer.profile')->with('success', 'Profile updated successfully!');
    }
    public function products()
{
    // Replace this with your actual logic
    return view('dashboard.customer-products');
}
public function wishlist()
{
    return view('dashboard.customer-wishlist');
}

public function orders()
{
    $user = Auth::user();

    // Count unread messages for the current user
    $unreadCount = Message::whereHas('conversation', function ($query) use ($user) {
        $query->where('sender_id', $user->id)->orWhere('receiver_id', $user->id);
    })
    ->where('sender_id', '!=', $user->id)
    ->where('is_read', false)
    ->count();

    return view('dashboard.customer-orders', compact('unreadCount'));
}


}