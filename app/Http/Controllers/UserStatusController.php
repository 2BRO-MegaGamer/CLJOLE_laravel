<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserStatusController extends Controller
{
    public function change_my_statuse($request){
        DB::table('users')->where('id',auth()->id())->update([
            'status' => 'Online'
        ]);
        if ((new security_for_backend_controller)->check_security_for_post($request)) {

            $event_scheduler = DB::select('SELECT @@event_scheduler');
            $bool_check = false;
            foreach ($event_scheduler[0] as $scheduler => $ON_OFF) {
                if ($ON_OFF == 'OFF') {
                    DB::select('SET GLOBAL event_scheduler = ON;');
                    $bool_check = true;
                }else{
                    $bool_check = true;

                }
            }

            if ($bool_check) {

                $all_events = DB::select('SHOW EVENTS');
                $event_exist = true;
                if (count($all_events) == 0) {
                    $this->create_event($request->my_id,$request->username,$request->hashtag);
                }else{
                    foreach ($all_events as $event) {

                        if ($event->Name == 'user_offline_'. $request->my_id .'_'. $request->username) {
                            $event_exist = false;
                            // $this->create_event($request->my_id,$request->username,$request->hashtag);
                        }
                    }
                    if ($event_exist) {
                        $this->create_event($request->my_id,$request->username,$request->hashtag);
                    }
                }
            }

        }else{
            return 'We encountered a problem, please refresh the page';
        }
    }

    public function create_event($my_id,$userName,$hashtag){
        $sql_add_event = 'CREATE EVENT user_offline_'. $my_id .'_'. $userName.'
        ON SCHEDULE
            EVERY 60 SECOND
        DO
        UPDATE users SET status = "Offline" WHERE id="'.$my_id.'" AND UserName = "'. $userName .'" AND hashtag="'. $hashtag.'" AND status="ONLINE";';
        DB::select($sql_add_event);
    }
    public function drop_event($my_id,$userName){
        $drop_event = 'DROP EVENT user_offline_'. $my_id .'_'. $userName.'';
        DB::select($drop_event);
        
    }

    public function change_statuse_online($my_id,$my_username){
        User::where([
            "id"=>$my_id,
            'UserName' =>$my_username
        ])->update([
            'status'=>'Online'
        ]);
    }
}
