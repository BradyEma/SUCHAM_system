<p>Hello {{ $ticket->user->name }},</p>
<p>Here’s a response to your support request:</p>
<p><strong>Subject:</strong> {{ $ticket->subject }}</p>
<p>{{ $replyText }}</p>
