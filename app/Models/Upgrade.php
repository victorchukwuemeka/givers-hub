<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upgrade extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'package_id',
        'amount',
        'expected',
        'received',
        'status',
    ];

    protected $casts = [
        'expected' => 'integer',
        'received' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function matched_history()
    {
        return $this->hasOne(MatchedHistory::class);
    }
}
