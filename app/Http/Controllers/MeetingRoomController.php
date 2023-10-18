<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MeetingRoomController extends Controller
{
    public function create_page(){
        $no_rooms = $this->have_Rooms(auth()->id());
        if ($no_rooms === true) {
            $uuid = Str::uuid();
            return view('meetingRoom.create',["roomID" => $uuid]);
        }else{
            return view('meetingRoom.create',["roomID" => $no_rooms[0]->room_uuid,'room_status'=>$no_rooms[0]->type]);
        }
    }
    public function create_room(Request $request){

        $no_rooms = $this->have_Rooms(auth()->id());
        if ($no_rooms === true) {
            $new_rooms = new Rooms;
            $new_rooms->creator_id = auth()->id();
            $new_rooms->room_name = $request->room_name;
            $new_rooms->room_uuid = $request->room_uuid;
            $new_rooms->type = $request->type_Room;
            $new_rooms->save();
            return redirect('/mR/joinTo/'.$request->room_uuid)->with(['message'=>[false,'Click Join Room, if u dont want to change your name',$request->room_uuid]]);

        }else{
            if ($no_rooms[0]->creator_id == auth()->id()) {
                if (!($no_rooms[0]->type === $request->type_Room)) {
                    Rooms::where('room_uuid',$no_rooms[0]->room_uuid)->update([
                        'type'=>$request->type_Room
                    ]);
                }
                return redirect('/mR/joinTo/'.$request->room_uuid)->with(['message'=>[false,'Click Join Room, if u dont want to change your name',$request->room_uuid]]);

            }
        }

    }
    public function genarate_room(Request $request,string $roomID){
        if ($request->isMethod('post') === false) {
            return redirect('/mR/joinTo/'.$roomID)->with(['message'=>[false,'Click Join Room, if u dont want to change your name',$roomID]]);
        }else{
            $get_rooms = Rooms::where('room_uuid',$roomID)->get();
            if (count($get_rooms) == 0) {
                return redirect('/mR/joinTo/'.$roomID)->with(['message'=>[false,'There is no room with this id',$roomID]]);
            }else{
                $info_user_inRoom = $this->check_user_status_in_room($get_rooms);
                $member_check = $this->am_i_in_list($get_rooms,"Members");
                $dublicate_detect = "false";
                if ($member_check === true) {
                    $dublicate_detect = "true";
                }
                $room_type = $get_rooms[0]->type;
                $host_details = ($this->get_host_information($roomID));
                foreach ($info_user_inRoom as $column => $Bool_ids) {
                    if ($Bool_ids  === true) {
                        $Permission = '';
                        switch ($column) {
                            case 'host':
                                $Permission = 'HOST';
                                break;
                            case 'moderator':
                                $Permission = 'MOD';
                                break;
                            case 'accept_m':
                                $Permission = 'Member';
                                break;
                            case 'wait_to_accept':
                                $Permission = 'NULL';
                                break;
                        }
                        if ($Permission !== 'NULL') {
                            $this->make_user_visible_in_Member_list($roomID,$get_rooms);
                            return view('meetingRoom.Room',[
                                'my_custom_name'=>$request->my_custom_name,
                                'roomUUID'=>$roomID,'roomID'=>$get_rooms[0]->id,
                                'Permission'=>$Permission,
                                'duplicate'=>$dublicate_detect,
                                "HOST_userName"=> $host_details[0],
                                "HOST_hashtag"=> $host_details[1],
                                "HOST_id"=> $host_details[2],
                            ]);
                        }
                    }
                }
                if ($room_type === 'public') {
                    $this->make_user_visible_in_Member_list($roomID,$get_rooms);
                    return view('meetingRoom.Room',[
                        'my_custom_name'=>$request->my_custom_name,
                        'roomUUID'=>$roomID,'roomID'=>$get_rooms[0]->id,
                        'Permission'=>'Member',
                        'duplicate'=>$dublicate_detect,
                        "HOST_userName"=> $host_details[0],
                        "HOST_hashtag"=> $host_details[1],
                        "HOST_id"=> $host_details[2],
                    ]);
                }else{
                    $message = '';
                    if ($info_user_inRoom['wait_to_accept'] === true) {
                        $message = 'Your membership request has been sent,pls wait';
                    }else{
                        $this->make_user_visible_in_wait_list($roomID);
                        $message = 'You are not a member of this group. Your request has been sent to the administrators';
                    }
                    return redirect('/mR/joinTo/'.$roomID)->with(['message'=>[false,$message,$roomID]]);
                }
            }
        }
    }

    public function get_host_information($roomUUID){
        $room_creator_id =  Rooms::where('room_uuid',$roomUUID)->get('creator_id')[0]->creator_id;
        $host_information = User::where('id', $room_creator_id)->get(['UserName','hashtag'])[0];
        return [$host_information['UserName'],$host_information['hashtag'],$room_creator_id];
    }


    public function make_user_visible_in_wait_list($room_id){
        $room_info = Rooms::where('room_uuid',$room_id)->get();
        if (!($room_info[0]->wait_to_accept == null)) {
            $string_ids = $room_info[0]->wait_to_accept . "," . auth()->id();
        }else{
            $string_ids = (string) auth()->id();
        }
        Rooms::where('room_uuid',$room_id)->update([
            'wait_to_accept'=> $string_ids
        ]);
    }



    public function make_user_visible_in_Member_list($room_id,$room_info){
        $member_check = $this->am_i_in_list($room_info,"Members");
        $need_update = true;
        $string_ids='';
        if (!($member_check === true)) {
            if (is_string($member_check)) {
                $string_ids = $member_check . "," . auth()->id();
            }else{
                $string_ids = (string) auth()->id();
            }
        }else{
            $need_update = false;
        }
        if ($need_update) {
            Rooms::where('room_uuid',$room_id)->update([
                'Members'=> $string_ids
            ]);
        }
    }
    public function joinTo_page(string $roomID){
        $message = session()->get("message");
        if ($message != null) {
            if ($message[0] === false) {
                return view('meetingRoom.join',['roomID'=>$message[2],'message'=> $message[1]]);
            }else{
                return view('meetingRoom.join',['roomID'=>$roomID]);
            }
        }else{
            return view('meetingRoom.join',['roomID'=>$roomID]);
        }
    }
    public function check_user_status_in_room($roomID){
        $host_check = $this->am_i_host($roomID[0]);
        $moderator_check = $this->am_i_in_list($roomID,array_keys($roomID[0]->toArray())[5]);
        $accept_m_check = $this->am_i_in_list($roomID,array_keys($roomID[0]->toArray())[7]);
        $wait_to_accept_check = $this->am_i_in_list($roomID,array_keys($roomID[0]->toArray())[6]);
        $all_data = ["host"=>$host_check,"moderator"=>$moderator_check,"accept_m"=>$accept_m_check,"wait_to_accept"=>$wait_to_accept_check];
        return $all_data;
    }


    public function am_i_host($roomInfo){
        if (($roomInfo->creator_id) == auth()->id()) {
            return true;
        }else{
            return false;
        }
    }


    public function am_i_in_list($room_INFO,$column){
        $bool_am_i = false;
        if ($room_INFO[0]->$column == null) {
            return null;
        }else{
            $list_members = explode(",",$room_INFO[0]->$column);
            for ($i=0; $i < count($list_members); $i++) { 
                if ($list_members[$i] == auth()->id()) {
                    $bool_am_i = true;
                }
            }
            if (!$bool_am_i) {
                // array_push($list_members, (string) auth()->id());
                $string_ids = '';
                for ($i=0; $i < count($list_members); $i++) { 
                    if ($string_ids == '') {
                        $string_ids = $list_members[$i];
                    }else{
                        $string_ids = $string_ids . ",". $list_members[$i];
                    }
                }
                return $string_ids;
            }else{
                return true;
            }
        }
        
    }
    public function have_Rooms($my_id){
        $have_rooms = Rooms::where("creator_id",$my_id)->get();
        if (count($have_rooms) == 0) {
            return true;
        }else{
            return $have_rooms;
        }
    }


    public function member_disconnect(Request $request){
        return $request;
        if ((new security_for_backend_controller)->check_security_for_post($request)) {
            $room_info = Rooms::where('room_uuid',$request->room_uuid)->get();
            $string_id = '';

            if ($room_info[0]->Members != null) {
                $get_ids = explode(",",$room_info[0]->Members);
                for ($i=0; $i < count($get_ids); $i++) { 
                    if ($get_ids[$i] == $request->fr_id) {
                        unset($get_ids[$i]);
                    }
                }
                foreach ($get_ids as $ids) {
                    if ($string_id == "") {
                        $string_id = $ids;
                    }else{
                        $string_id = $string_id . "," . $ids;
                    }
                }
            }else{
                $string_id = null;
            }
            Rooms::where('room_uuid',$request->room_uuid)->update([
                'Members'=> $string_id
            ]);
            return $string_id;
        }
    }






    public function get_members_peer_id(Request $request){
        if ((new security_for_backend_controller)->check_security_for_post($request)) {
            $room_info = Rooms::where('room_uuid',$request->room_uuid)->get();
            $room_string_ids = $room_info[0]->Members;
            $room_array_ids = explode(",",$room_string_ids);
            $peer_ids=[];
            for ($i=0; $i < count($room_array_ids); $i++) { 
                if ($room_array_ids[$i] != auth()->id()) {
                    $member = User::where('id',$room_array_ids[$i])->get();
                    if (count($member) != 0) {
                        $member_info = $member[0]->UserName . "-" . (explode('#',$member[0]->hashtag)[1]) . "-" . $room_array_ids[$i];
                        $get_member_peer_id = $request->room_uuid ."_" . $member_info;
                        array_push($peer_ids,[$room_array_ids[$i] => $get_member_peer_id]);
                    }else{
                        return [];
                    }
                }
            }
            return($peer_ids);
            
        }else{
            return 'pls try again';
        }
    }



    








    
}












































// if ($roomID[0]->wait_to_accept == null) {
//     Rooms::where('room_uuid',$request->room_uuid)->update([
//         'wait_to_accept' => ''. auth()->id()
//     ]);
// }else{
//     $wait_member = explode(",",$roomID[0]->wait_to_accept);
//     array_push($wait_member, (string) auth()->id());
//     $string_ids = '';
//     for ($i=0; $i < count($wait_member); $i++) { 
//         if ($wait_member[$i] != auth()->id()) {
//             if ($string_ids == '') {
//                 $string_ids = $wait_member[$i];
//             }else{
//                 $string_ids = $string_ids . ",". $wait_member[$i];
//             }
//         }
//     }
//     if ($string_ids != '') {
//         Rooms::where('room_uuid',$request->room_uuid)->update([
//             'wait_to_accept' => $string_ids
//         ]);
//     }
// }