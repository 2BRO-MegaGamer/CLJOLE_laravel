<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\getcilentIPController;
use App\Http\Controllers\UserIp;
use App\Models\Hashtag;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'UserName' => ['required', 'string',  'max:255'],
            'gender' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
    public function hashtag_generator($UserName){

        $table = Hashtag::where('username',$UserName)->get();
        if (count($table) == 0) {
            return '#0001';
        }else{
            $all_hashtag = $this->all_num_hash($table);
            $hash_can_be = $this->missing_number($all_hashtag);
            return($this->get_num_hash($hash_can_be));
        }
    }
    

    public function missing_number($num_list){
        if (count($num_list) == 1) {
            return [0=> $num_list[0]+1];
        }else{
            if (min($num_list) != 1) {
                return [0=>1];
    
            }else{
    
                $new_arr = range(min($num_list),max($num_list));
                $diff_array = array_diff($new_arr, $num_list);
                return $diff_array;
            }
        }

    }


    public function get_num_hash($hash_can_be){
        $adad_saz = min($hash_can_be);
        switch (strlen($adad_saz)){
            case 1:
                $C_hashtag_mis = "#000".($adad_saz);
                break;
            case 2:
                $C_hashtag_mis = "#00".($adad_saz);
                
                break;
                
            case 3:
                $C_hashtag_mis = "#0".($adad_saz);
                
                break;
                
            case 4:
                $C_hashtag_mis = "#" . ($adad_saz);
                
                break;
                
                
        }

        return $C_hashtag_mis;
    }
    public function all_num_hash($table){

        $get_all_hashtag=[];
        for ($i=0; $i < count($table); $i++) { 
            $get_all_hashtag[$i] = (int)((explode("#",$table[$i]->hashtag))[1]);
        }
        return $get_all_hashtag;
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $ip = (new getcilentIPController)->getClientIps();
        $hashtag = $this->hashtag_generator($data['UserName']);
        return User::create([
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'UserName' => $data['UserName'],
            'hashtag' => $hashtag,
            'email' => $data['email'],
            'gender' => $data['gender'],
            'password' => Hash::make($data['password']),
            'last_ip' => $ip
        ]);

        
    }

}
