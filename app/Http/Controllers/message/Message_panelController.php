<?php

namespace App\Http\Controllers\message;

use App\Http\Controllers\Controller;
use App\Http\Controllers\security_for_backend_controller;
use App\Http\Controllers\UserStatusController;
use App\Models\Message_panel;
use App\Models\Message_texts;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
class Message_panelController extends Controller
{
    public function get_message_panel(Request $request){

        if ((new security_for_backend_controller)->check_security_for_post($request)) {

            $result[0] = $this->get_mes_id($request->my_id,$request->fr_id)[0];
            $result[1] = $this->get_all_text_message($result[0]);
            return $result;
        }else{
            return 'We encountered a problem, please refresh the page';
        }
        
    }

    public function get_mes_id($my_id,$fr_id){
        $table_1 = Message_panel::where('user_id_1',$my_id)->where('user_id_2',$fr_id)->get();
        $table_2 = Message_panel::where('user_id_2',$my_id)->where('user_id_1',$fr_id)->get();
    
        $return_data = [];
        if (count($table_1) == 0 && count($table_2) == 0) {
            $mes_id = Message_panel::create([
                'user_id_1'=>$my_id,
                'user_id_2'=>$fr_id,
                'Mes_type'=>'PRIVATE'
            ])->id;
            $return_data[0]= $mes_id;
        }else{
            if (count($table_1) != 0) {
                $return_data[0]= $table_1[0]->id;
            }
            if (count($table_2) != 0) {
                $return_data[0]= $table_2[0]->id;
            }
        }
        return $return_data;
    }

    public function get_all_text_message($Mes_id){
        $all_message = Message_texts::where('Mes_id',$Mes_id)->get();
        $array_message=[];
        if (count($all_message) != 0) {
            for ($i=0; $i < count($all_message); $i++) { 
                $array_message[$i]=[
                    'id'=> $all_message[$i]->id,
                    'user_send_id'=> $all_message[$i]->user_send_id,
                    'message_text'=> $all_message[$i]->message_text,
                    'is_mes_seen'=> $all_message[$i]->is_mes_seen,
                    'is_send_notif'=> $all_message[$i]->is_send_notif,
                    'created_at'=> $all_message[$i]->created_at,
                    'updated_at'=> $all_message[$i]->updated_at
                ];
            }
        }else{
            $array_message[0] = 'There is no message for u';
        }

        return $array_message;
    }

    public function send_text_message(Request $request){
        if ((new security_for_backend_controller)->check_security_for_post($request)) {
            $message_id = Message_texts::create([
                'Mes_id' => $request->Mes_id,
                'user_send_id' => $request->my_id,
                'message_text' => $request->message_text
            ])->id;
            return [$message_id,date("Y-m-d H:i:s")];

        }else{
            return 'We encountered a problem, please refresh the page';
        }

        
    }




    public function all_message_seen(Request $request){

        if ((new security_for_backend_controller)->check_security_for_post($request)) {
            $my_id = $request->my_id;
            $Mes_id = $request->Mes_id;
            Message_texts::where('Mes_id',$Mes_id)->where('user_send_id','!=',$my_id)->where('is_mes_seen','false')->update([
                'is_mes_seen' => "true",
                'is_send_notif'=> "true"
            ]);
        }else{
            return 'We encountered a problem, please refresh the page';
        }

    }

    public function update_sec_chat(Request $request){

        if ((new security_for_backend_controller)->check_security_for_post($request)) {
            $req_messages_id_string = $request->messages_id;
            $req_messages_id_array = explode(',', $request->messages_id);
            $messages_get = Message_texts::where('Mes_id',$request->Mes_id)->get();
            $messages_get_id_string="";
            $messages_get_id_array=[];
            $messages_statuse = [];
            $resualt_array=[];


            for ($i=0; $i < count($messages_get); $i++) { 
                if ($messages_get_id_string == "") {
                    $messages_get_id_string = $messages_get[$i]->id;
                }else{
                    $messages_get_id_string = $messages_get_id_string . "," . $messages_get[$i]->id;
                }
                array_push($messages_get_id_array,(string)$messages_get[$i]->id);
                if ($messages_get[$i]->user_send_id == (string) auth()->id()) {
                    array_push($messages_statuse,['id'=>$messages_get[$i]->id,'is_mes_seen'=>$messages_get[$i]->is_mes_seen,'is_send_notif'=>$messages_get[$i]->is_send_notif]);
                }
            }
            $resualt_array[0] =['new_message_detect'=> 'false'];
            $resualt_array[1]=['deleted_message_detected'=>'false'];
            $resualt_array[2] = ['all_new_ids'=> 'false'];
            $resualt_array[3] = ['message_status'=> $messages_statuse];
            if ($req_messages_id_string != $messages_get_id_string) {
                $diff_message_1 = array_diff($messages_get_id_array,$req_messages_id_array);
                $diff_message_2 = array_diff($req_messages_id_array,$messages_get_id_array);
                $resualt_array[2] = ['all_new_ids'=> 'false'];
                
                if (count($diff_message_1) != 0) {
                    $resualt_array[0]=['new_message_detect'=>$diff_message_1];
                    $resualt_array[2] = ['all_new_ids'=> $messages_get_id_string];
                    foreach ($diff_message_1 as $key => $value) {
                        Message_texts::where('id', $value)->update([
                            'is_mes_seen' => "true",
                            'is_send_notif'=> "true"
                        ]);
                    }

                }else{
                    $resualt_array[0] =['new_message_detect'=> 'false'];
                }
                if (count($diff_message_2) != 0) {
                    $resualt_array[1]=['deleted_message_detected'=>$diff_message_2];
                    $resualt_array[2] = ['all_new_ids'=> $messages_get_id_string];

                }else{
                    $resualt_array[1]=['deleted_message_detected'=>'false'];
                }
                
            }


            return $resualt_array;
        }else{
            return 'We encountered a problem, please refresh the page';
        }
    }





    public function get_specific_message(Request $request){
        if ((new security_for_backend_controller)->check_security_for_post($request)) {

            $message_id = $request->message_id;
            $Mes_id = $request->Mes_id;

            $message_text_detail = (Message_texts::where('Mes_id',$Mes_id)->where('id',$message_id)->get())[0];

            if (($message_text_detail) != []) {

                $result = $message_text_detail;
                return $result;
            }else{
                return [];
            }
        }else{
            return 'We encountered a problem, please refresh the page';
        }


    }



    public function remove_my_message(Request $request){
        if ((new security_for_backend_controller)->check_security_for_post($request)) {
            Message_texts::where('user_send_id',$request->my_id)->where('id',$request->message_id)->delete();
            return "true";
        }else{
            return 'We encountered a problem, please refresh the page';
        }
    }



    public function get_friends_statuse(Request $request){
        if ((new security_for_backend_controller)->check_security_for_post($request)) {
            (new UserStatusController)->change_my_statuse($request);
            if (isset($request->fr_info)) {
                $resualt= $this->Friend_status($request);
                return $resualt;
            }
        }else{
            return 'We encountered a problem, please refresh the page';
        }
    }

    public function Friend_status($request){
        $resualt=[];
        for ($i=0; $i < count($request->fr_info); $i++) {
            $Mes_id = ($request->fr_info[$i])['Mes_id'];
            $fr_id = ($request->fr_info[$i])['FR_id'];
            $unseen_messages = Message_texts::where('user_send_id',"!=",$request->my_id)->where('Mes_id',$Mes_id)->get(['id','user_send_id','is_mes_seen']);
            $unseen_count = count($unseen_messages);
            $FR_status = User::where('id',$fr_id)->get('status');

            $this->update_notification($unseen_messages);


            $out_put = [
                'fr_id'=>$fr_id,
                'message_unseen'=>(string) $unseen_count,
                'status'=>$FR_status[0]->status,
            ];
            array_push($resualt,$out_put);
        }



        return $resualt;

    }

    public function update_notification($unseen_messages){
        for ($i=0; $i < count($unseen_messages); $i++) {
            if ($unseen_messages[$i]->is_mes_seen == 'false') {
                Message_texts::where('id',$unseen_messages[$i]->id)->update([
                    'is_send_notif'=>'true'
                ]);
            }
        }
    }












}
