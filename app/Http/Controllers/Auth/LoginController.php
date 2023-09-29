<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Friends;
use App\Models\Profile_img_bio;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
    }
    public function prof_friend_user($user_id){
        $exsist_data_prof = Profile_img_bio::where('user_id',$user_id)->get();
        $exsist_data_friend = Friends::where('user_id',$user_id)->get();
        if (count($exsist_data_prof) == 0) {
            Profile_img_bio::create([
                'user_id'=>$user_id,
                'prof_Img_name',
                'prof_Img_size',
                'path',
                'type',
                'prof_Bio',
                'prof_Color'
            ]);
        }
        if (count($exsist_data_friend) == 0) {
            Friends::create([
                'user_id'=>$user_id,
                'friends_get',
                'friends_send',
                'friends_both'
            ]);
        }

    }



}
