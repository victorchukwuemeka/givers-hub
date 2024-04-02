<?php

namespace App\Models\Logs;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;

class AuthLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_agent',
        'ip_address',
        'description',
        // Add other fillable attributes as needed for other details about the auth log
    ];

    // Define the relationship with users (optional, if you want to associate auth logs with specific users)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUserNameAttribute()
    {
        return $this->user?->username;
    }
}
