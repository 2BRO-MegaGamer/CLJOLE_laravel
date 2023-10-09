<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class security_for_backend_controller extends Controller
{
    public function check_security_for_post($request){

        $user_hash_id = auth()->user()->UserName."_".auth()->user()->hashtag."_".auth()->id();
        $user_token_create = password_hash($user_hash_id,PASSWORD_DEFAULT);
        $user_hash_id_get = $request->username."_".$request->hashtag."_".$request->user_id;
        if (password_verify($user_hash_id , $request->user_token) && $request->my_id == auth()->id() && password_verify($user_hash_id_get,$user_token_create)) {
            return true;
        }else{
            return false;
        }
    }
}
