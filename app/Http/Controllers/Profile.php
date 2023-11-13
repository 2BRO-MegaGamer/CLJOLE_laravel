<?php

namespace App\Http\Controllers;

use App\Models\Profile_img_bio;
use Illuminate\Http\Request;

class Profile extends Controller
{
    public function profile_details(){
        $profie_id = Profile_img_bio::where("user_id" , auth()->id())->get();
        $data_profile =[];

        $data_profile = [
            'firstName' => auth()->user()->firstName,
            'lastName' => auth()->user()->lastName,
            'UserName' =>  auth()->user()->UserName,
            'profile' => $profie_id[0]
        ];
        return $data_profile;
    }
}
