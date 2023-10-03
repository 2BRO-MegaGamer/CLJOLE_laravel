var peer_first = peer_connection(MY_UNIQUE_ID);


function peer_connected(peer_get) {
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



    make_connection_to_anothers_peer(ROOM_UUID,peer,null);







    peer.on('connection', (conn) => {

        console.log(conn,"connection");

        conn.on('open',()=>{
            console.log("user-connect first",conn);
            conn.send({"user-connect":MY_UNIQUE_ID})

        })
        conn.on('open', () => {
            conn.send({"user-connect":MY_UNIQUE_ID})
        })

        conn.on('close',()=>{
            console.log("close",conn['peer']);
        })

        conn.on('data', (data) => {
            console.log(data,"data");
            switch (Object.keys(data)[0]) {
                case "user-reconnect":
                    var conn = peer.connect(data['user-reconnect'] + '_reconnect');
    
                    conn.on('open', () => {
                        conn.send({"force-refresh":MY_UNIQUE_ID})
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


async function make_connection_to_anothers_peer(room_uuid,peer,Members_get) {
    if (Members_get === null) {
        get_all_members(room_uuid,peer)
    }else{
        var Members = Members_get;
        for (let i = 0; i < Members.length; i++) {
            var member_id = Object.keys(Members[i])
            var member_peer_id = Members[i][member_id];
            var conn = peer.connect(member_peer_id,{metadata:{
                connected_TO_uq_id:MY_UNIQUE_ID,
                connected_TO_username:USER_NAME,
                connected_TO_hashtag:USER_HAHSTAG,
                connected_TO_id:USER_ID
            }});

            conn.on('close', () => {

                console.log({"user-disconnect":member_peer_id});
            })
        }
    }



}


async function get_all_members(room_uuid,peer) {
    $.ajax({
        type: "POST",
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: path+'/get_members_peer_id',
        data: {
            _token : $('meta[name="csrf-token"]').attr('content'), 
            username:USER_NAME,
            hashtag:USER_HAHSTAG,
            user_id:USER_ID,
            user_token:USER_TOKEN,
            my_id: USER_ID,
            room_uuid: room_uuid,
        },
        dataType: "json",
        success: function(resultData) {make_connection_to_anothers_peer(room_uuid,peer,resultData);}
    });


}





function peer_connection(unique_id) {
    var connected = false;
    var peer_check = new Peer(unique_id,{
        host: '/',
        port: '3002',
    })

    peer_check.on('open',(id)=>{
        const dataConnection = peer_check.connect(unique_id,{metadata:{
            userName:USER_NAME,
            hashtag:USER_HAHSTAG,
            user_id:USER_ID
        }})
        var peer = [];
        peer[0] = true;
        peer[1] = peer_check;
        connected = true;
        peer_connected(peer)
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