<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activation extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'txn_id',
        'amount',
        'payment_method',
        'account_name',
        'account_number',
        'status',
        'date_paid',
        'panelty_date',
        'comment',
        'status',
    ];
}
