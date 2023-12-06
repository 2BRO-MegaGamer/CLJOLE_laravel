var textarea_for_message_in_room = document.getElementById("textarea_for_message_in_room");

textarea_for_message_in_room.addEventListener('keydown',(e)=>{
    if (e.key === "Enter" && e.shiftKey === false) {
        e.preventDefault();
        var message_text = textarea_for_message_in_room.value;
        message_text = message_text.replace(/(\r\n|\n|\r)/gm," ");
        if (message_text != "") {
            send_text_message(public_peer,message_text,dataConnection_peer_members);
            textarea_for_message_in_room.value = "";
        }
    }
})


function send_text_message(peer,text,all_data_connection) {
    var members_info = check_members_peer_live_connection(peer);
    console.log("sended?");
    var members_peer_id = Object.keys(members_info);
    for (let i = 0; i < members_peer_id.length; i++) {
        if (members_info[members_peer_id[i]] === true) {
            console.log(members_info , "members_info[members_peer_id[i]]");
            (all_data_connection[members_peer_id[i]]).send({"message-from-members":{
                sender_peer_id : USER_INFO.MY_UNIQUE_ID,
                sender_room_name : USER_INFO.IN_ROOM_NAME,
                sender_user_name : USER_INFO.USER_NAME,
                sender_hashtag : USER_INFO.USER_HASHTAG,
                sender_is_host : USER_INFO.AM_I_HOST,
                sender_Permission : ROOM_INFO.ROOM_Permission,
                text_message : text
            }})
        }
    }
    var my_message_html = make_card_message(USER_INFO.USER_NAME,USER_INFO.USER_HASHTAG,USER_INFO.IN_ROOM_NAME,USER_INFO.MY_UNIQUE_ID,USER_INFO.AM_I_HOST,text,"my");
    var message_save_in_room = document.getElementById("message_save_in_room");
    message_save_in_room.innerHTML = message_save_in_room.innerHTML + my_message_html;
}


function message_detect_from_user(data) {
    var sender_user_name = data.sender_user_name;
    var sender_hashtag = data.sender_hashtag;
    var sender_room_name = data.sender_room_name;
    var sender_peer_id = data.sender_peer_id;
    var sender_is_host = data.sender_is_host;
    var text_message = data.text_message;
    var sender_Permission = data.sender_Permission;
    var message_html = make_card_message(sender_user_name,sender_hashtag,sender_room_name,sender_peer_id,sender_is_host,text_message,sender_Permission);
    var message_save_in_room = document.getElementById("message_save_in_room");
    message_save_in_room.innerHTML = message_save_in_room.innerHTML + message_html;
    // make_message_scroll_to_bottom(message_save_in_room)
}


// function make_message_scroll_to_bottom(message_div) {
//     var height_message_div = ;
    
// }


function make_card_message(sender_user_name,sender_hashtag,sender_room_name,sender_peer_id,sender_is_host,text_message,permission) {
    var permission_changes={
        HOST:{color:"fe6161"},
        MOD:{color:"f4fe61"},
        Member:{color:"ED96FE"},
        my:{color:"96fefc"}
    }
    var color;
    var is_report_able ="";

    switch (permission) {
        case "HOST":
            color = permission_changes[permission].color;
            break;
        case "MOD":
            color = permission_changes[permission].color;
            break;
        case "Member":
            color = permission_changes[permission].color;
            break;
        case "my":
            color = permission_changes[permission].color;
            is_report_able = "d-none";
            break;
    }
    var card_html = `

    <div class="card border-0 position-relative" id="`+sender_peer_id+`_message" style="background: none;margin-bottom:1rem ;background:rgba(125,125,125,0.5);">
        <div class="text-start text-light p-0 m-0" style="background: none;width:max-content">
            `+sender_room_name+` `+sender_hashtag+`
        </div>
        <div class="card-body m-0 p-0 rounded-bottom" style="background: #`+color+`;">
            <div class=" mx-4 my-0">
            `+text_message+`
            </div>
        </div>
        <div class="position-absolute `+is_report_able+` start-0 p-0 m-0 bottom-0">
            <button class="btn p-0 m-0" username="`+sender_user_name+`" hashtag="`+sender_hashtag+`" in_room_name="`+sender_room_name+`" peer_id="`+sender_peer_id+`" is_host="`+sender_is_host+`" ><i class="bi bi-flag"></i></button>
        </div>
    </div>
    `
    return(card_html);
}