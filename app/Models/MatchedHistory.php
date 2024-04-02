<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchedHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'upgrade_id',
        'sender_user_id',
        'receiver_user_id',
        'amount',
        'account_name',
        'account_number',
        'payment_method',
        'penalty_date',
        'payment_date',
        'approved_date',
        'proof',
        'txn_id',
        'memo',
        'status',
    ];

    public function upgrade()
    {
        return $this->belongsTo(Upgrade::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_user_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_user_id');
    }
}
