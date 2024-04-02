<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;

    protected $fillable = [
            'name',
            'email',
            'title',
            'subject',
            'phone_number',
            'message',
            'client_ip',
            'country',
            'client_agent'
    ];

}
