<?php

namespace App\Models;

use App\Models\SupportTicket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // ✅ RIGHT

class SupportTicketReply extends Model
{
    use HasFactory;

    protected $fillable = ['support_ticket_id', 'user_id', 'message'];

    public function ticket()
    {
        return $this->belongsTo(SupportTicket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
