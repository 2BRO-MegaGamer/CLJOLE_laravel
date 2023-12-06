<?php

namespace App\Http\Controllers;

use App\Models\Profile_img_bio;
use App\Models\User;
use Illuminate\Http\Request;

class Profile extends Controller
{
    public function profile_details($id){
        $Profile_img_bio = Profile_img_bio::where("user_id" , $id)->get();
        $User = User::where("id", $id)->get()[0];
        $data_profile =[];

        $data_profile = [
            'firstName' => $User->firstName,
            'lastName' => $User->lastName,
            'UserName' =>  $User->UserName,
            'profile' => $Profile_img_bio[0]
        ];
        return $data_profile;
    }

    public function get_members_profile_info_with_peer_id(Request $request){
        if ((new security_for_backend_controller)->check_security_for_post($request)) {
            $room_uuid = $request->room_uuid;
            $members = $request->members;
            $fr_peer = $request->fr_info;
            $profiles=[];
            if ($fr_peer === null) {
                for($i = 0; $i < count($members); $i++){
                    $profile_get = [];
                    $id_member = key($members[$i]);
                    $user_hash_id = explode("_",$members[$i][$id_member])[1];
                    // $username = explode('-',$user_hash_id)[0];
                    // $hashtag = explode('-',$user_hash_id)[1];
                    $id = explode('-',$user_hash_id)[2];
                    $profile_get= $this->profile_details($id);
                    $profile_get["permission"] = (new MeetingRoomController)->check_user_status_in_room($request->room_uuid,$id);
                    $profiles[$members[$i][$id_member]] = $profile_get;
                }
            }else{
                $user_hash_id = explode("_",$fr_peer)[1];
                $id = explode('-',$user_hash_id)[2];
                $profile_get = $this->profile_details($id);
                $profile_get["permission"] = (new MeetingRoomController)->check_user_status_in_room($request->room_uuid,$id);
                $profiles[$fr_peer] = $profile_get;
            }
            return $profiles;

        }
        
    }
}
