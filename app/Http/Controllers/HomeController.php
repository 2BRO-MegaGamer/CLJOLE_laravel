<?php

namespace App\Http\Controllers;

use App\Models\ChatInfo;
use App\Models\Profile_img_bio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function home()
    {
        return view('home');
    }
    public function about(){
        $table = ChatInfo::orderby('id')->get();
        dd($table);
        return view('test');
    }

    public function contact(){
        dd(['salam'=>'salam2']);
        return view('test');
    }
    public function index(){
        return view('test');

    }
}
