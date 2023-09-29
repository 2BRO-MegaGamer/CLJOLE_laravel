<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\LoginController;
use App\Models\Friends;
use App\Models\Profile_img_bio;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\message\Message_panelController;
class FriendsController extends Controller
{
    public function Find_friend(Request $request){
        if (count($request->query) == 0) {
            return view('friends.findFriends');

        }else{

            $card_info = $this->findFriend($request);
            return view('friends.findFriends',['message'=> $card_info]);
        }
    }


    public function findFriend($request){
      $my_UserName=auth()->user()->UserName;
      $my_hashtag=auth()->user()->hashtag;
      $friend_username = $request['username'];
      $friend_hashtag = $request['hashtag'];
      $errors_text = [
        'friend_notfound' => '<div class="card-body"><div><h5 class="text-danger text-center">Didn\'t work! Is spelling correct?</h5></div></div>',
        'friend_user_hash_same' => '<div class="card-body"><div><h5 class="text-danger text-center">Do you want to be friends with yourself?🤔</h5></div></div>',
      ];
      if ($friend_username != $my_UserName || $friend_hashtag !=  $my_hashtag) {
          $table = Friends::where('user_id', auth()->id())->get();

          if (count($table) != 0) {

              $friend_id = ($this->check_user_hash($friend_username,$friend_hashtag));

              if ($friend_id != null) {
                $card_info = $this->friend_card_add($friend_username,$friend_hashtag,$friend_id,$request);
                return $card_info;
              }else{
                $user_find = $errors_text['friend_notfound'];
                return($user_find);
              }
          }else{
            return($errors_text['friend_notfound']);
          }

        }else{
          $user_find = $errors_text['friend_user_hash_same'];

          return($user_find);
        }
    }


    public function check_user_hash($friend_username,$friend_hashtag){

      $friend_id = User::where('UserName', $friend_username)->where('hashtag',$friend_hashtag)->get('id');
      if (count($friend_id) != 0 ) {
        return $friend_id[0];
      }else{
        return null;
      }
    }
    public function token_generator(Request $request){
      $token = $request->session()->token();
      $token = csrf_token();
      return $token;
    }

    public function friend_card_add($friend_username,$friend_hashtag,$friend_id ,$request){

      $FR_img_bio = Profile_img_bio::where('user_id',$friend_id->id)->get(['prof_Img_name','prof_Bio','prof_Color']);

      $FR_img = ($FR_img_bio[0]['prof_Img_name'] == null) ? 'https://cdn.icon-icons.com/icons2/3054/PNG/512/account_profile_user_icon_190494.png' : asset('storage/imgs/uploads/'. $FR_img_bio[0]['prof_Img_name']);

      $user_find = '
      <div class="">
        <div class="card-body mx-auto" style="max-width: 40rem;background:'. $FR_img_bio[0]['prof_Color'] .' ">
          <div class="row g-0">
            <div class="col">
                <div class="card text-bg-dark bg-opacity-50 ">
                    <img src="'. $FR_img .'" >
                </div>
            </div>

            <div class="col-6 col-md-3 my-1" >
              <div class="card-title">
                <h5 class="card-body">'. $friend_username . " " . $friend_hashtag . '</h5>
              </div>
            </div>
            <div class="col-6 col-md-6" style="margin-bottom:30px;">
              <div class="card-title" >
                <p class="card-body">'. e($FR_img_bio[0]['prof_Bio']) .'</p>
              </div>
            </div>
            <div class="col col-md-3">
              <form action="/findFriends" method="POST">
              <input type="hidden" name="_token" value="'. $this->token_generator($request) .'" />
                
                <button name="friend_id" class="btn btn-info position-absolute bottom-0 end-0 my-2" value="'. $friend_id->id .'">Add Friend</button>
              </form>
          </div>
          </div>
        </div>
      </div>
      ';
      return $user_find;

    }



    public function add_friend_send(Request $request){
      $error_text =[
        'friend_dupli_send' => '<div class="card-body"><div><h5 class="text-danger text-center">Friend request has already been sent</h5></div></div>',
        'friend_old_friend' => '<div class="card-body"><div><h5 class="text-danger text-center">Why are you trying to be friends with your friends?🤷‍♂️</h5></div></div>',
        'friend_dupli_get' => '<div class="card-body"><div><h5 class="text-danger text-center">You have now received a friend request from this person</h5></div></div>'
      ];
      $friend_req_sends = Friends::where('user_id', auth()->id())->get('friends_send');
      $error_detail = $this->duplicate_friend($request->friend_id);
      if ($error_detail == "") {
        if (count($friend_req_sends) != 0) {
          if ($friend_req_sends[0]->friends_send == "") {
            Friends::where('user_id', auth()->id())
            ->update(['friends_send' => ''. $request->friend_id .'']);
          }else{
            Friends::where('user_id', auth()->id())
            ->update(['friends_send' => $friend_req_sends[0]->friends_send . ','. $request->friend_id .'']);
          }
  
  
          $this->friend_gets_req($request);
          return view('friends.findFriends',['message'=> '<div class="card-body"><div><h5 class="text-danger text-center">Friend request sent.✔️</h5></div></div>']);
  
        }
      }else{
        return view('friends.findFriends',['message'=> $error_text[$error_detail]]);

      }

      
    }
    
    function friend_gets_req($request){
      $friend_req_get =Friends::where('user_id', auth()->id())->get('friends_get');
      if (count($friend_req_get) != 0) {

        if ($friend_req_get[0]->friends_get == "") {
          Friends::where('user_id', $request->friend_id)
          ->update(['friends_get' => ''. auth()->id().'']);
        }else{
          Friends::where('user_id', $request->friend_id)
          ->update(['friends_get' => $friend_req_get[0]->friends_get . ','. $request->friend_id .'']);
        }
      }
    }


    public function duplicate_friend($friend_id){
      $my_friend_req = Friends::where('user_id',auth()->id())->get(['friends_send','friends_get','friends_both'])[0];
      if ($my_friend_req->friends_send != null) {
        $my_fr_req_send = explode(',',$my_friend_req->friends_send);
        if (count($my_fr_req_send) != 0 ) {
          foreach ($my_fr_req_send as $friend) {
            if ($friend != "" && (int)$friend == $friend_id) {
              return 'friend_dupli_send';
            }
          }
        }
      }
      if ($my_friend_req->friends_get != null) {
        $my_fr_req_get= explode(',',$my_friend_req->friends_get);
        if (count($my_fr_req_get) != 0) {
          foreach ($my_fr_req_get as $friend) {
            if ($friend != "" && (int)$friend == $friend_id) {
              return 'friend_dupli_get';
            }
          }
        }
      }
      if ($my_friend_req->friends_both != null) {
        $my_fr_req_both= explode(',',$my_friend_req->friends_both);
        if (count($my_fr_req_both) != 0) {
          foreach ($my_fr_req_both as $friend) {
            if ($friend != "" && (int)$friend == $friend_id) {
              return 'friend_old_friend';
            }
          }
        }
      }
      return '';
    }
    public function get_req_friends(Request $request){
      if ((new security_for_backend_controller)->check_security_for_post($request)) {
        $my_info = Friends::where('user_id', auth()->id())->get();
        if (count($my_info) != 0) {
          $my_send_req = $my_info[0]->friends_send;
          $my_get_req = $my_info[0]->friends_get;
          $my_both_req = $my_info[0]->friends_both;
    
          $analyze_send = [];
          $id_send = [];
          if ($my_send_req != null) {
            $id_send = explode(',',$my_send_req);
            for ($i=0; $i < count($id_send); $i++) { 
              $analyze_send[$i] = $this->get_user_hash_data($id_send[$i]);
            }
          }
    
          $analyze_get = [];
          $id_get = [];
          if ($my_get_req != null) {
            $id_get = explode(',',$my_get_req);
            for ($i=0; $i < count($id_get); $i++) { 
              $analyze_get[$i] = $this->get_user_hash_data($id_get[$i]);
            }
          }
    
    
          $analyze_both = [];
          $id_both=[];
          $mes_id=[];
          if ($my_both_req != null) {
            $id_both = explode(',',$my_both_req);
            for ($i=0; $i < count($id_both); $i++) { 
              $analyze_both[$i] = $this->get_user_hash_data($id_both[$i]);
              $mes_id[$i] =['FR_id'=>$id_both[$i],'Mes_id'=>(new Message_panelController)->get_mes_id( auth()->id(),$id_both[$i])[0]];
            }
          }
    
    
    
          $data = [
            [$analyze_send,$id_send],
            [$analyze_get,$id_get],
            [$analyze_both,$id_both,$mes_id],
          ];
          return $data;
        }else{
          return [];
        }
      }else{
        return "There is some problem pls refresh page";
      }


    }

    public function get_user_hash_data($id){

      $user_info = (User::where('id',$id)->get(['Username','hashtag']));
      return $user_info;
    }

    public function get_mes_id($my_id,$fr_id){
      
    }


    public function reject_detect_send(Request $request){
      $reject_id = $request->reject;
      $my_send_friend_req_reject = (Friends::where('user_id',auth()->id())->get('friends_send'))[0];




      $analyze_send_friends_id = explode(',',$my_send_friend_req_reject->friends_send);
      for ($i=0; $i < count($analyze_send_friends_id); $i++) { 
        if ($analyze_send_friends_id[$i] == $reject_id) {
          unset($analyze_send_friends_id[$i]);
        }
      }
      $return_data_for_db_send ='';
      if (count($analyze_send_friends_id) != 0) {
        foreach ($analyze_send_friends_id as $friend_id) {
          if ($return_data_for_db_send == '') {
            $return_data_for_db_send = $friend_id;
          }else{
            $return_data_for_db_send += "," . $friend_id;
          }
        }
      }
      if ($return_data_for_db_send == "") {
        $return_data_for_db_send = null;
      }
      Friends::where('user_id',auth()->id())->update(['friends_send'=>$return_data_for_db_send]);



      $FR_req_get_friends = ((Friends::where('user_id',$reject_id)->get('friends_get'))[0])->friends_get;
      $analyze_gets = explode(',',$FR_req_get_friends);

      for ($i=0; $i < count($analyze_gets); $i++) { 
        if ($analyze_gets[$i] == auth()->id()) {
          unset($analyze_gets[$i]);
        }
      }
      $return_data_for_db_gets ='';
      if (count($analyze_gets) != 0) {
        foreach ($analyze_gets as $friend_id) {
          if ($return_data_for_db_gets == '') {
            $return_data_for_db_gets =(string) $friend_id;
          }else{
            $return_data_for_db_gets += "," . $friend_id;
          }
        }
      }

      if ($return_data_for_db_gets == "") {
        $return_data_for_db_gets = null;
      }
      Friends::where('user_id',$reject_id)->update(['friends_get'=>$return_data_for_db_gets]);

      return redirect()->back();


    }
    public function detect_get(Request $request){

      $data_get_key = array_keys($request->input());
      if ($data_get_key[0] == 'reject') {
        $R_A_get_reject = $data_get_key[0];
        $reject_id = $request->$R_A_get_reject;
        $my_get_friend_req_reject = Friends::where('user_id',auth()->id())->get('friends_get');
        if ($my_get_friend_req_reject[0]->friends_get != null) {
          $this->get_friends_req_reject($my_get_friend_req_reject[0],$reject_id,$R_A_get_reject);
        }
      }else{
        $R_A_get_accept = $data_get_key[0];
        $accept_id = $request->$R_A_get_accept;
        $my_get_friend_req_accept = Friends::where('user_id',auth()->id())->get('friends_get');
        if ($my_get_friend_req_accept[0]->friends_get != null) {
          $this->get_friends_req_reject($my_get_friend_req_accept[0],$accept_id,$R_A_get_accept);

        }
      }

      return redirect()->back();
    }

    public function get_id_username_hash($username,$hashtag){
      $user_id = (User::where('UserName',$username)
        ->where('hashtag',$hashtag)->get('id'))[0];
      if (isset($user_id->id)) {
        return $user_id->id;

      }else{
        return null;
      }
    }

    public function  get_friends_req_reject($my_get_friend_req,$friend_req_id,$method){
      $analyze_get_friends_id = explode(',',$my_get_friend_req->friends_get);
      for ($i=0; $i < count($analyze_get_friends_id); $i++) { 
        if ($analyze_get_friends_id[$i] == $friend_req_id) {
          unset($analyze_get_friends_id[$i]);
        }
      }
      $return_data_for_db ='';
      if (count($analyze_get_friends_id) != 0) {
        foreach ($analyze_get_friends_id as $friend_id) {
          if ($return_data_for_db == '') {
            $return_data_for_db = $friend_id;
          }else{
            $return_data_for_db += "," . $friend_id;
          }
        }
      }
      if ($return_data_for_db == "") {
        $return_data_for_db = null;
      }
      Friends::where('user_id',auth()->id())->update(['friends_get'=>$return_data_for_db]);



      $FR_req_sender_friends = ((Friends::where('user_id',$friend_req_id)->get('friends_send'))[0])->friends_send;
      $analyze_senders = explode(',',$FR_req_sender_friends);

      for ($i=0; $i < count($analyze_senders); $i++) { 
        if ($analyze_senders[$i] == auth()->id()) {
          unset($analyze_senders[$i]);
        }
      }
      $return_data_for_db_sender ='';
      if (count($analyze_senders) != 0) {
        foreach ($analyze_senders as $friend_id) {
          if ($return_data_for_db_sender == '') {
            $return_data_for_db_sender =(string) $friend_id;
          }else{
            $return_data_for_db_sender += "," . $friend_id;
          }
        }
      }

      if ($return_data_for_db_sender == "") {
        $return_data_for_db_sender = null;
      }
      Friends::where('user_id',$friend_req_id)->update(['friends_send'=>$return_data_for_db_sender]);


      if ($method == 'accept') {
        $my_friends_accepted = (Friends::where('user_id',auth()->id())->get('friends_both'))[0]->friends_both;
        $friend_friends_accepted = (Friends::where('user_id',$friend_req_id)->get('friends_both'))[0]->friends_both;

        if ($my_friends_accepted != null) {

          $my_friends_accepted = (string)$my_friends_accepted . ',' . $friend_req_id;

        }else{
          $my_friends_accepted = $friend_req_id;
        }

        if ($friend_friends_accepted != null) {

          $friend_friends_accepted = (string)$friend_friends_accepted . ',' . auth()->id();

        }else{
          $friend_friends_accepted = auth()->id();
        }
        
        Friends::where('user_id',auth()->id())->update(['friends_both'=>$my_friends_accepted]);
        Friends::where('user_id',$friend_req_id)->update(['friends_both'=> $friend_friends_accepted]);


      }
    }

}
