<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friends extends Model
{
    // use HasFactory;
    protected $fillable = [
        'user_id',
        'friends_get',
        'friends_send',
        'friends_both',
    ];
}
