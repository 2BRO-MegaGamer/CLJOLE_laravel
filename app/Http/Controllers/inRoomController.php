<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use Illuminate\Http\Request;

class inRoomController extends Controller
{
    public function members_cannot_make_connection_to_member(Request $request){
        if ((new security_for_backend_controller)->check_security_for_post($request)) {
            if ($request->connected == 'false') {
                $members = (Rooms::where('room_uuid',$request->room_uuid)->get())[0]->Members;
                $members = explode(",",$members);
                $m_id_string = '';
                for ($i=0; $i < count($members); $i++) { 
                    if ($members[$i] == $request->member_id) {
                        array_splice($members,$i,1);
                    }
                }
                for ($i=0; $i < count($members) ; $i++) { 
                    if ($m_id_string == '') {
                        $m_id_string = $members[$i];
                    }else{
                        $m_id_string = $m_id_string . "," . $members[$i];
                    }
                }
                Rooms::where('room_uuid',$request->room_uuid)->update([
                    'Members'=>$m_id_string
                ]);
            }

        }
    }
}
