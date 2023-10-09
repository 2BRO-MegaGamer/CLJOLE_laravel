var peer_first = peer_connection(USER_INFO.MY_UNIQUE_ID,null);
let local_stream = undefined;
function make_empty_media_stream(voice_or_video) {

    const createEmptyAudioTrack = () => {
        const ctx = new AudioContext();
        const oscillator = ctx.createOscillator();
        const dst = oscillator.connect(ctx.createMediaStreamDestination());
        oscillator.start();
        const track = dst.stream.getAudioTracks()[0];
        return Object.assign(track, { enabled: false });
    };

    const createEmptyVideoTrack = ({ width, height }) => {
        const canvas = Object.assign(document.createElement('canvas'), { width, height });
        canvas.getContext('2d').fillRect(0, 0, width, height);
        const stream = canvas.captureStream();
        const track = stream.getVideoTracks()[0];
        return Object.assign(track, { enabled: false });
    };

    const audioTrack = createEmptyAudioTrack();
    const videoTrack = createEmptyVideoTrack({ width:640, height:480 });
    if (voice_or_video === 'voice') {
        local_stream = new MediaStream([audioTrack]);
        return new MediaStream([audioTrack]);
        
    }else{
        local_stream = new MediaStream([audioTrack]);

        return new MediaStream([audioTrack, videoTrack]);
        
    }
}


async function get_voice_media_stream() {
    var getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia;
    await getUserMedia({ audio: true}, function(stream) {
        return stream;
    }, function(err) {
        console.log('Failed to get local stream' ,err);
    });
}



function peer_connected(peer_get,media_option) {
    public_peer = peer_get[1];
    var peer = peer_get[1];

    // var peer_voice = new Peer(MY_UNIQUE_ID + "_VOICE",{
    //     host: '/',
    //     port: '3002',
    // })
    // var peer_web_cam = new Peer(MY_UNIQUE_ID + "_WEB_CAM",{
    //     host: '/',
    //     port: '3002',
    // })
    // var connections = [[MY_UNIQUE_ID,peer_host]];
    // peer_web_cam.on("open",(id)=>{
    //     connections[1] = [id,peer_web_cam]
    // })
    // peer_voice.on("open",(id)=>{
    //     connections[2] = [id,peer_voice]
    // })



    make_connection_to_anothers_peer(ROOM_INFO.ROOM_UUID,peer,null,media_option);


    peer.on('call',(call)=>{

        var conn = peer.connect(call['peer']);
        var fr_id = ((call['peer']).split("_")[1]).split('-')[2];
        conn.on('close', () => {

        })
        console.log("get call",call);
        
        var call_detail = (call.metadata)['call_detail'];
        var call_recipient = call_detail.call_recipient;
        var call_sender = call_detail.call_sender;
        var mediastream_detail = (call.metadata)['mediaStream'];
        call.answer(local_stream);
        call.on("stream",stream=>{
            make_card_for_voice_chat_card({call_recipient,call_sender},HOST_INFO);
            if ((mediastream_detail)['empty'] === true) {
                document.getElementById('')
            }else{
                if ((mediastream_detail)['video'] === true) {
                    
                }else{

                }
            }
            console.log("stream2",call);
        })
    })




    peer.on('connection', (conn) => {

        conn.on('open', () => {
            console.log({"user-connect":conn['peer']});
        })

        conn.on('close',()=>{
            console.log({"user-disconnect":conn['peer']});
            // $.ajax({
            //     type: "POST",
            //     headers: {
            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     },
            //     url: path+'/member_disconnect',
            //     data: {
            //         _token : $('meta[name="csrf-token"]').attr('content'), 
            //         username:USER_NAME,
            //         hashtag:USER_HASHTAG,
            //         user_id:USER_ID,
            //         user_token:USER_TOKEN,
            //         my_id: USER_ID,
            //         fr_id:conn['peer'],
            //         room_uuid: ROOM_UUID,
            //     },
            //     dataType: "json",
            // });
        })

        conn.on('data', (data) => {
            console.log(data,"data");
            switch (Object.keys(data)[0]) {
                case "user-reconnect":
                    var conn = peer.connect(data['user-reconnect'] + '_reconnect');
    
                    conn.on('open', () => {
                        conn.send({"force-refresh":USER_INFO.MY_UNIQUE_ID})
                        peer.disconnect();
                        peer.destroy();
                        document.getElementById('videos_connection').remove();
                        var div = document.createElement('div');
                        div.innerHTML = same_user_join_room;
                        document.getElementById("div_asli").append(div);
                        document.getElementById("same_user_detect").addEventListener("click",()=>{
                            console.log("clicked");
                            same_user_detect(peer);
                        })
                    })
                    break;
                case 'user-connect':
                    console.log("user-connect");

                    break;
            }
        });
    });
}


async function make_connection_to_anothers_peer(room_uuid,peer,Members_get,media_option) {
    if (Members_get === null) {
        get_all_members(room_uuid,peer)
    }else{
        var Members = Members_get;
        var connection_check = [];
        var media_for_peer;
        if (media_option == null) {
            media_for_peer = make_empty_media_stream('voice');
            
        }else{
            media_for_peer = media_option;
        }

        for (let i = 0; i < Members.length; i++) {
            var member_id = Object.keys(Members[i])[0]
            var member_peer_id = Members[i][member_id];
            var member_peer_id_u_h_i = (member_peer_id.split('_')[1]);
            var member_userName =member_peer_id_u_h_i.split('-')[0];
            var member_hashtag = "#" + member_peer_id_u_h_i.split('-')[1];
            connection_check[i] = 
                {
                    "member_id":member_id,
                    "member_peer_id":member_peer_id,
                    "member_userName":member_userName,
                    "member_hashtag":member_hashtag,
                    "connected":false,
                }
        }
        var call = []
        for (let i = 0; i < Members.length; i++) {
            var member_id = Object.keys(Members[i])[0];

            var member_peer_id = Members[i][member_id];
            var member_peer_id_u_h_i = (member_peer_id.split('_')[1]);
            var member_userName =member_peer_id_u_h_i.split('-')[0];
            var member_hashtag = "#" + member_peer_id_u_h_i.split('-')[1];

            var conn = peer.connect(member_peer_id,{metadata:{
                connected_TO_uq_id:USER_INFO.MY_UNIQUE_ID,
                connected_TO_username:USER_INFO.USER_NAME,
                connected_TO_hashtag:USER_INFO.USER_HASHTAG,
                connected_TO_id:USER_INFO.USER_ID
            }});
            
            call[i] = peer.call(member_peer_id, media_for_peer , {metadata:{mediaStream:{voicechat:false,video:false,empty:true},call_detail:{call_recipient:{userName:member_userName,userID:member_id,hashtag:member_hashtag,peer_id:member_peer_id},call_sender:{userName:USER_INFO.USER_NAME,userID:USER_INFO.USER_ID,hashtag:USER_INFO.USER_HASHTAG,peer_id:USER_INFO.MY_UNIQUE_ID} ,HOST:HOST_INFO}}});
            
            call[i].on('stream',(remoteStream)=>{
                var call_detail = (call[i].metadata)['call_detail'];
                var call_recipient = call_detail.call_recipient;
                var call_sender = call_detail.call_sender;
                var mediastream_detail = (call[i].metadata)['mediaStream'];
                if ((mediastream_detail)['empty'] === true) {
                    make_card_for_voice_chat_card({call_recipient,call_sender},HOST_INFO);
                    console.log("anjam2",call_detail);
                }else{
                    if ((mediastream_detail)['video'] === true) {
                        
                    }else{

                    }
                }
                console.log("send call",call_detail);
            })

            conn.on('open',()=>{
                connection_check[i]['connected'] = true;
                conn.on('close', () => {
                    connection_check[i]['connected'] = false;
                })
            })
        }
        setTimeout(async ()=>{
            remove_member_from_db_no_connection(connection_check,room_uuid);
            // add_voice_call_to_anothers_peer(connection_check,room_uuid,peer,await get_voice_media_stream());

        },100)
    }
}
async function add_voice_call_to_anothers_peer(members,room_uuid,peer,voice_stream) {


    for (let i = 0; i < members.length; i++) {
        console.log(members);
        if (members[i]['connected'] === true) {
            var call = peer.call(members[i]['member_peer_id'], voice_stream,{metadata:{voicechat:true}});
            console.log(call,members[i]['member_id'],members[i]['member_peer_id'],voice_stream);

            call.on('stream', function(remoteStream) {
                console.log('remoteStream',remoteStream);
            });
        }

    }

}

async function get_all_members(room_uuid,peer,media_option) {
    $.ajax({
        type: "POST",
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: path+'/get_members_peer_id',
        data: {
            _token : $('meta[name="csrf-token"]').attr('content'), 
            username:USER_INFO.USER_NAME,
            hashtag:USER_INFO.USER_HASHTAG,
            user_id:USER_INFO.USER_ID,
            user_token:USER_INFO.USER_TOKEN,
            my_id: USER_INFO.USER_ID,
            room_uuid: room_uuid,
        },
        dataType: "json",
        success: function(resultData) {make_connection_to_anothers_peer(room_uuid,peer,resultData,media_option);}
    });


}


function remove_member_from_db_no_connection(members_info,room_uuid) {
    for (let i = 0; i < members_info.length; i++) {
        if (members_info[i]['connected'] === false) {
            // $.ajax({
            //     type: "POST",
            //     headers: {
            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     },
            //     url: path+'/members_cannot_make_connection_to_member',
            //     data: {
            //         _token : $('meta[name="csrf-token"]').attr('content'), 
            //         username:USER_INFO.USER_NAME,
            //         hashtag:USER_INFO.USER_HASHTAG,
            //         user_id:USER_INFO.USER_ID,
            //         user_token:USER_INFO.USER_TOKEN,
            //         my_id: USER_INFO.USER_ID,
            //         room_uuid: room_uuid,
            //         member_id: members_info[i]['member_id'],
            //         member_peer_id: members_info[i]['member_peer_id'],
            //         connected: members_info[i]['connected'],
            //     }
            // });
        
        }
        
    }
}




function peer_connection(unique_id,media_option) {
    if (media_option == null) {
        media_for_peer = null;
    }else{
        media_for_peer = media_option;
    }
    var connected = false;
    var peer_check = new Peer(unique_id,{
        host: '/',
        port: '3002',
    })
    peer_check.on('open',(id)=>{

        peer_check.connect(unique_id,{metadata:{
            userName:USER_INFO.USER_NAME,
            hashtag:USER_INFO.USER_HASHTAG,
            user_id:USER_INFO.USER_ID
        }})
        var peer = [];
        peer[0] = true;
        peer[1] = peer_check;
        connected = true;
        peer_connected(peer,media_for_peer);
    })
    setTimeout(()=>{
        if (connected === false) {
            cant_connect_to_peer(unique_id);
        }
    },500)
}
function cant_connect_to_peer(id) {
    peer = false;
    console.log("cant connect ID: " + id);
}