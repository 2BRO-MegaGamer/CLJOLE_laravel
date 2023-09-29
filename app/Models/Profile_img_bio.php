<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile_img_bio extends Model
{
    // use HasFactory;






    protected $fillable = [
        'user_id',
        'prof_Img_name',
        'prof_Img_size',
        'path',
        'type',
        'prof_Bio',
        'prof_Color'
    ];
}


