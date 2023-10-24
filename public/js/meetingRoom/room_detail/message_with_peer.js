var textarea_for_message_in_room = document.getElementById("textarea_for_message_in_room");

textarea_for_message_in_room.addEventListener('keydown',(e)=>{
    if (e.key === "Enter" && e.shiftKey === false) {
        e.preventDefault();
        var message_text = textarea_for_message_in_room.value;
        message_text = message_text.replace(/(\r\n|\n|\r)/gm," ");
        if (message_text != "") {
            send_text_message(public_peer,message_text,dataConnection_peer_members);
        }
    }
})


function send_text_message(peer,text,all_data_connection) {
    var members_info = check_members_peer_live_connection(peer);
    console.log("sended?");
    var members_peer_id = Object.keys(members_info);
    for (let i = 0; i < members_peer_id.length; i++) {
        if (members_info[members_peer_id[i]] === true) {
            (all_data_connection[members_peer_id[i]]).send({"message_from_members":{
                sender_peer_id : USER_INFO.MY_UNIQUE_ID,
                sender_room_name : USER_INFO.IN_ROOM_NAME,
                sender_user_name : USER_INFO.USER_NAME,
                sender_hashtag : USER_INFO.USER_HASHTAG,
                sender_is_host : USER_INFO.AM_I_HOST,
                text_message : text
            }})
        }
    }
}