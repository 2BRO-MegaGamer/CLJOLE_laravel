<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message_texts extends Model
{
    // use HasFactory;
    protected $fillable = [
        'Mes_id',
        'user_send_id',
        'message_text',
        'is_mes_seen',
        'is_send_notif',
    ];
}
