<?php

namespace App\Http\Controllers;

use App\Models\Profile_img_bio;
use Illuminate\Http\Request;

class Profile extends Controller
{
    public function profile_details(){
        $profie_id = Profile_img_bio::where("user_id" , auth()->id())->get();
        $data_profile =[];
        if (sizeof($profie_id) == 0) {
            Profile_img_bio::create([
                'user_id' => auth()->id(),
                'prof_img_name',
                'prof_img_size',
                'path',
                'type',
                'prof_bio'
            ]);
            $data_profile = [
                'firstName' => auth()->user()->firstName,
                'lastName' => auth()->user()->lastName,
                'UserName' =>  auth()->user()->UserName,
                'profile' => (Profile_img_bio::where("user_id" , auth()->id())->get())[0]
            ];
        }else{
            $data_profile = [
                'firstName' => auth()->user()->firstName,
                'lastName' => auth()->user()->lastName,
                'UserName' =>  auth()->user()->UserName,
                'profile' => $profie_id[0]
            ];
        }
        return $data_profile;
    }
}
