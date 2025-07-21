<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Supplier;
use App\Models\Wholesaler;
use App\Models\Retailer;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationships
    public function supplier()
    {
        return $this->hasOne(Supplier::class);
    }

    public function wholesaler()
    {
        return $this->hasOne(Wholesaler::class, 'user_id');
    }

    public function retailer()
    {
        return $this->hasOne(Retailer::class);
    }

    // Utility Methods
    public function isOnline()
    {
        return $this->last_seen && $this->last_seen->gt(now()->subMinutes(5));
    }

    public function canChatWith(User $otherUser): bool
    {
        if ($this->role === 'admin') {
            return true; // admin can talk to anyone
        }

        $allowedChat = [
            'supplier'   => ['admin'],
            'wholesaler' => ['admin', 'retailer'],
            'retailer'   => ['admin', 'wholesaler', 'customer'],
            'customer'   => ['admin', 'retailer'],
        ];

        return in_array($otherUser->role, $allowedChat[$this->role] ?? []);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function hasRole($roles)
    {
        return in_array($this->role, (array) $roles);
    }
}
