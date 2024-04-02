<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

      //
      protected $fillable = [
        'name',
        'status',
        'content',
        'view',
        'type',
        'parent_menu_id',
        'sub_menu_id',
        'url',
        'iframe',
        'linked_view',
        'linked_post',
        'external_link',
    ];

    
}
