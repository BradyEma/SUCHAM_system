<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conversation extends Model
{
    protected $fillable = [
        'sender_id',
        'receiver_id'
    ];

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function getLatestMessage()
    {
        return $this->messages()->latest()->first();
    }

    public function getUnreadCount($userId)
    {
        return $this->messages()
            ->where('sender_id', '!=', $userId)
            ->where('is_read', false)
            ->count();
    }

public function getContactsProperty()
{
    $currentUser = auth()->user();

    return User::where('id', '!=', $currentUser->id)
        ->get()
        ->filter(fn($user) => $currentUser->canChatWith($user));
}

public function selectContact($contactId)
{
    $contact = User::findOrFail($contactId);

    if (!auth()->user()->canChatWith($contact)) {
        abort(403, 'Not allowed to chat with this user.');
    }

    $this->selectedContact = $contact;
    // Load messages, etc.
}



}
