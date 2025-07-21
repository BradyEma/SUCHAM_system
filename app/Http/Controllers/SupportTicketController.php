<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use App\Mail\SupportTicketReplyMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;



class SupportTicketController extends Controller
{
  
    use AuthorizesRequests;

    public function index(Request $request)
    {
        // Start the query based on user role
        $query = auth()->user()->isAdmin()
            ? SupportTicket::with('user') // Admin can see all with user info
            : SupportTicket::where('user_id', auth()->id());

        // Apply category filter if present
        if ($request->has('category') && in_array($request->category, ['inquiry', 'complaint', 'general'])) {
            $query->where('category', $request->category);
        }

        // Get tickets sorted by latest
        $tickets = $query->latest()->get();

        return view('support.index', compact('tickets'));
    }


    public function create()
    {
        $faqs = Faq::all();
        return view('support.create', compact('faqs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'attachment' => 'nullable|file|mimes:jpg,png,pdf,docx|max:2048',
            'category' => 'required|in:inquiry,complaint,general',
        ]);

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('attachments', 'public');
        }

        $data['user_id'] = auth()->id();
        $ticket = SupportTicket::create($data);

        // (Optional) notify admin via email or Notification
        return redirect()->route('support.index')->with('success', 'Ticket submitted successfully!');
    }

    //admin reply method
    public function reply(Request $request, SupportTicket $ticket)
    {

        $ticket->load('user');
        // Ensure only admins can reply
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        // Validate reply input
        $request->validate([
            'reply_text' => 'required|string',
        ]);

        // Update ticket with admin reply and mark as resolved
        $ticket->update([
            'admin_reply' => $request->reply_text,
            'status' => 'resolved',
        ]);

        $replyMessage = $request->reply_text;


        // Send reply email to user
        //(incase an email is to sent every time a message is sent) 
        // Mail::to($ticket->user->email)->send(new SupportTicketReplyMail($ticket, $replyMessage));
        // for an email being sent on first reply only below
        

        if (!$ticket->replied_at && $ticket->user) {
            Mail::to($ticket->user->email)->send(new SupportTicketReplyMail($ticket, $replyMessage));
            $ticket->update(['replied_at' => now()]);
        }

        // Redirect back with success flash message
        return redirect()->route('support.index')->with('success', 'Reply sent successfully!');
    }
    public function show(SupportTicket $ticket)
    {
        $this->authorize('view', $ticket); // optional security
        return view('support.show', compact('ticket'));
    }
    public function storeReply(Request $request, SupportTicket $ticket)
    {
        $request->validate(['message' => 'required|string']);

        $ticket->replies()->create([
            'user_id' => auth()->id(),
            'message' => $request->message,
        ]);

        $ticket->update(['status' => 'in_progress']); // optional

        return back()->with('success', 'Reply sent successfully.');
    }
    public function updateStatus(Request $request, SupportTicket $ticket)
    {
        $this->authorize('update', $ticket);

        $request->validate([
            'status' => 'required|in:open,in_progress,resolved',
        ]);

        $ticket->update(['status' => $request->status]);

        return back()->with('success', 'Ticket status updated to: ' . ucfirst(str_replace('_', ' ', $request->status)));
    }




}
