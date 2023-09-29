
// $.ajax({
//     type: "POST",
//     headers: {
//     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     },
//     url: path+'/member_disconnect',
//     data: {
//         _token : $('meta[name="csrf-token"]').attr('content'), 
//         username:USER_NAME,
//         hashtag:USER_HAHSTAG,
//         user_id:USER_ID,
//         user_token:USER_TOKEN,
//         my_id: USER_ID,
//         fr_id:fr_id,
//         room_uuid: ROOM_UUID,
//     },
//     dataType: "text",
//     success: function(Data) {console.log(Data);}
// });




function get_card_send(username_hash,id) {

    if (username_hash.length != 0) {
        var string_send_data = '<li class="list-group-item bg-dark text-light p-2 "><div style="width: 100%;"><p class="d-inline" style="width: 70%;">'+ username_hash[0].Username + " " + username_hash[0].hashtag +'</p><div class="d-inline position-absolute end-0 mx-2"><form action="/remove_Frined_send_req" method="get"><button class="btn p-0 mx-2" name="reject" value="'+ id +'"><i class="bi bi-x-circle text-danger"></i></button></form></div></div></li> ';

        return string_send_data;
    }
}

function get_card_get(username_hash,id) {

    if (username_hash.length != 0) {
        var string_get_data = '<li class="list-group-item bg-dark text-light p-2 "><div style="width: 100%;"><p class="d-inline" style="width: 70%;">'+ username_hash[0].Username + " " + username_hash[0].hashtag +'</p><div class="d-inline position-absolute end-0 mx-2"><form action="/Frined_get_req" method="get"><button class="btn p-0 mx-2" name="accept" value="'+ id +'"><i class="bi bi-check-circle text-success"></i></button><button class="btn p-0 mx-2" name="reject" value="'+ id +'"><i class="bi bi-x-circle text-danger"></i></button></form></div></div></li> '


        return string_get_data;
    }
}
function get_card_both(username_hash,id) {
    if (username_hash.length != 0) {


        var string_both_data = `
        <li class="list-group-item bg-dark text-light dropend-center  p-0 m-0" style="width: 100%;">
            <a class=" text-decoration-none text-center text-light m-0 p-0" style="width: 100%;" role="button" data-bs-toggle="dropdown" >
                <div>
                <div class="row">
                    <div class="col">
                        <p class="m-0 p-0">`+ username_hash[0].Username + ` ` + username_hash[0].hashtag +`</p>
                    </div>
                    <div class="col">
                        <span id="FR_online_statuse_`+ id +`" class="badge rounded-pill"><div class="spinner-grow text-secondary" role="status" style="height:15px;"><span class="visually-hidden">Loading...</span></div></span>
                    </div>
                    <div class="col">
                        <span id="FR_num_message_`+ id +`" class="badge bg-info border m-0 px-2 py-0"><div class="spinner-grow text-primary" role="status" style="height:15px;"><span class="visually-hidden">Loading...</span></div></span>
                    </div>
                </div>
                </div>
            </a>
            <ul class="dropdown-menu bg-black text-light dropdown-menu-lg-end">
                <li><button class="dropdown-item bg-black text-light btn" fr_id="`+ id +`"  id="`+ id +`_btn"  data-bs-target="#modal_chat_`+ id +`"  data-bs-toggle="modal">send chat</button></li>
                <li><a class="dropdown-item bg-black text-light btn" href="#">view Profile</a></li>
                <li>
                    <div class="card p-0 m-0" style="background-color:rgba(130,130,130,255);">
                        <div class="card-body m-0 p-0" style="width:100%">
                            <ul class="list-group m-0 p-0 ">
                                <li class="list-group-item opacity-75 p-0 m-0 py-1" style="background-color:red;">
                                    <img class="rounded-circle mx-2" width="25" height="25" src="https://cdn.icon-icons.com/icons2/3054/PNG/512/account_profile_user_icon_190494.png"></img>
                                    <div class="d-inline">esm lobby</div>
                                </li>
                                <a href="#" class="list-group-item opacity-75" style="background-color:rgba(200,200,200,255)">join lobby</a>
                                <a href="#" class="list-group-item opacity-75" style="background-color:rgba(200,200,200,255)">invite to lobby</a>
                                <a href="#" class="list-group-item opacity-75" style="background-color:rgba(200,200,200,255)">specte match</a>
                                <a href="#" class="list-group-item opacity-75" style="background-color:rgba(200,200,200,255)">view lobby info</a>
                                <a href="#" class="list-group-item opacity-75" style="background-color:rgba(200,200,200,255)">request to join</a>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </li>
        `;

        var modal_for_friend = `


        <div>
            <div class="modal fade" id="modal_chat_`+ id +`" aria-hidden="true" aria-labelledby="Label_chat_`+ id +`" tabindex="-1">
                <div class="modal-dialog  modal-dialog-scrollable modal-lg" >
                    <div class="modal-content bg-black text-light" style="min-height: 250px;">
                        <div class="modal-header position-relative border-secondary border-3">
                            <h1 class="modal-title fs-4" id="`+id+`Label_chat">`+ username_hash[0].Username +`</h1>
                            <small class="my-0" >`+ username_hash[0].hashtag +`</small>
                        </div>
                        <div class="modal-body m-0 p-0" id="message_saver_`+id+`" style="min-height: 500;max-height:500;">
                            <div class="text-center w-100">
                                <div class="spinner-grow text-secondary" style="width: 10rem; height: 10rem;" role="status" ><span class="visually-hidden">Loading...</span></div>                        
                            </div>
                        </div>
                        <div class="modal-footer" style="min-height: 100px;">
                            <div class="w-100">
                                <div class="position-relative">
                                    <div>
                                        <label for="text_area_`+ id +`" class="form-label d-block">character : 255</label>
                                        <input placeholder="Type message.." maxlength="255" autocomplete="off" id="text_area_`+ id +`" style="width: 80%;max-height:200px;"></input>
                                    </div>
                                    <div class="position-absolute end-0 top-50">
                                        <button type="button" class="btn btn-success" id="sendchat_id_`+ id +`"  value="Submit">Send</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        


        `;


        var model_controller = document.getElementById("model_controller_friends");
        var model_controller_child =(model_controller).children;
        var model_ids = [];
        if (model_controller_child.length != 0 ) {
            for (let i = 0; i < model_controller_child.length; i++) {
                model_ids[i] = model_controller_child[i].id;
            }
        }

        const parser = new DOMParser();
        const modal_for_friend_html = parser.parseFromString(modal_for_friend, 'text/xml');
        const modal_for_friend_id = modal_for_friend_html.children[0].children[0].id;

        if (model_controller.innerHTML == '') {
            model_controller.innerHTML = modal_for_friend_html.children[0].innerHTML;
            
        }else{
            for (let i = 0; i < model_ids.length; i++) {
                var found=undefined;
                if (model_ids.length != 0) {
                    found = model_ids.find((element)=> element == modal_for_friend_id);
                }
                if (found == undefined) {
                    if (model_ids[i] != modal_for_friend_id) {
                        model_controller.innerHTML += modal_for_friend_html.children[0].innerHTML;
                    }
                }
            }
        }
        return string_both_data;
    }
}



function message_data_script(friend,my_id,path) {

    if (friend.length != 0) {
        for (let i = 0; i < friend[1].length; i++) {
            var user_id_btn = document.getElementById(friend[1][i]+"_btn")
            user_id_btn.addEventListener("click",function(){
                $.ajax({
                    type: "POST",
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: path+'/get_messages',
                    data: {
                        _token : $('meta[name="csrf-token"]').attr('content'), 
                        username:username,
                        hashtag:hashtag,
                        user_id:user_id,
                        user_token:user_token,
                        my_id: my_id,
                        fr_id: friend[1][i],
                    },
                    dataType: "json",
                    success: function(data) {
                        chat_saver_modal(data[1],my_id,friend[1][i],data[0],path);
                        send_chat_script(my_id,data[0],friend[1][i],path);
                    }
                });
            })
        }
    }
}




function chat_saver_modal(text_array,my_id,fr_id,Mes_id,path) {
    var html_messages ='';
    var string_message_id ='';
    if (text_array != 'There is no message for u') {
        for (let i = 0; i < text_array.length; i++) {
            var card = get_card_message(text_array[i],my_id,fr_id);
            if (html_messages == '') {
                html_messages = card;
            }else{
                html_messages += card;
            }
            if (string_message_id == '') {
                string_message_id =  (text_array[i].id).toString();
            }else{
                string_message_id = string_message_id + ','+text_array[i].id
            }

        }
        html_messages = `
        <ul class="list-group list-group-flush py-3">
        `+ html_messages +`
        </ul>
        `;
        see_all_message(Mes_id,path,my_id);
    }else{
        html_messages='<p class="text-center">'+ text_array +'</p>'
    }
    update_sec_chat_saver(my_id,fr_id,Mes_id,path);

    var message_saver = document.getElementById('message_saver_'+fr_id);
    message_saver.innerHTML = html_messages;
    message_saver.setAttribute('messages_id',string_message_id);
    var fr_saver_height = document.getElementById("message_saver_"+fr_id);
    fr_saver_height.scrollTo(0,fr_saver_height.scrollHeight)

}

function get_card_message(text_detail,my_id,fr_id) {
    var all_message_status = [
        '<i class="bi bi-check-all"> </i>',
        '<i class="bi bi-check"> </i>',
        '<i class="bi bi-check-all text-danger"> </i>'
    ];
    var message_id = text_detail.id;
    var user_send_id = text_detail.user_send_id;
    var message_text = text_detail.message_text;
    var is_mes_seen = text_detail.is_mes_seen;
    var is_send_notif = text_detail.is_send_notif;
    var created_at = text_detail.created_at;
    var time =  (((created_at.split('T'))[1]).split('.000000Z'))[0];
    var date = (created_at.split('T'))[0];
    var message_status;
    if (is_mes_seen == 'false') {
        if (is_send_notif == 'false') {
            message_status = all_message_status[1];
            
        }else{
            message_status = all_message_status[0];
        }
    }else{
        message_status = all_message_status[2];
    }
    if (user_send_id == my_id) {
        return my_message(message_id,message_text,message_status,time,date,fr_id);
    }else{
        return fr_message(message_id,message_text,message_status,time,date);
    }





}



function send_chat_script(my_id,Mes_id,fr_id,path) {
    var send_chat_id_btn = document.getElementById('sendchat_id_'+fr_id)
    var text_area = document.getElementById('text_area_'+fr_id)
    send_chat_id_btn.addEventListener('click',function(){
        if (text_area.value != '') {
            update_chat_saver((my_id+"_to_"+fr_id+"_mes_id_"+Mes_id),text_area.value,fr_id);
            $.ajax({
                type: "POST",
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: path+'/send_message',
                data: {
                    _token : $('meta[name="csrf-token"]').attr('content'), 
                    username:username,
                    hashtag:hashtag,
                    user_id:user_id,
                    user_token:user_token,
                    my_id: my_id,
                    fr_id: fr_id,
                    Mes_id:Mes_id,
                    message_text:text_area.value
                },
                dataType: "json",
                success: function(data) {
                    var fr_saver_height = document.getElementById("message_saver_"+fr_id);
                    fr_saver_height.scrollTo(0,fr_saver_height.scrollHeight)
                    update_status_message(data,my_id,fr_id,Mes_id);
                }
            });
            text_area.value = '';

        }
    })
}


function update_chat_saver(message_id,message_text,fr_id) {
    message_status = '<i class="bi bi-clock-history"> </i>';
    var time = date = 
    `
    <div class="spinner-border spinner-border-sm" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
    `;

    var card = my_message(message_id,message_text,message_status,time,date,fr_id);
    var fr_message_saver = document.getElementById("message_saver_"+fr_id);
    if ((fr_message_saver.children)[0].innerHTML == 'There is no message for u') {
        (fr_message_saver.children)[0].remove();
        fr_message_saver.innerHTML = '<ul class="list-group list-group-flush py-3"></ul>'
    }
    (fr_message_saver.children)[0].innerHTML += card
    var messages_id =  fr_message_saver.getAttribute("messages_id");
    messages_id += ',' +message_id;
    fr_message_saver.removeAttribute('messages_id');
    fr_message_saver.setAttribute('messages_id',messages_id);
    

}
function update_status_message(data,my_id,fr_id,Mes_id) {
    var message_id = data[0];
    var message_date_time = data[1];
    var time = (message_date_time.split(' '))[1];
    var date = (message_date_time.split(' '))[0];
    var creative_id = (my_id+"_to_"+fr_id+"_mes_id_"+Mes_id);
    var message_card_id     = document.getElementById('message_id_'+creative_id);
    var message_card_status = document.getElementById('message_status_'+creative_id);
    var message_card_time   = document.getElementById('message_time_'+creative_id);
    var message_card_date   = document.getElementById('message_date_'+creative_id);
    var message_card_delete = document.getElementById('delete_btn_'+creative_id);
    var message_saver = document.getElementById("message_saver_"+fr_id);


    message_card_status.innerHTML = '<i class="bi bi-check"> </i>';
    message_card_time.innerHTML = time;
    message_card_date.innerHTML = date;


    message_card_id.id = ('message_id_'+message_id);
    message_card_status.id = ('message_status_'+message_id);
    message_card_time.id = ('message_time_'+message_id);
    message_card_date.id = ('message_date_'+message_id);
    message_card_delete.id = ('delete_btn_'+message_id);

    var all_id = message_saver.getAttribute("messages_id").split(',')
    var new_all_id = '';
    for (let i = 0; i < all_id.length; i++) {
        if (all_id[i] == creative_id ) {
            all_id[i] = message_id;
        }
        if (new_all_id == '') {
            new_all_id = all_id[i];
        }else{
            new_all_id +=","+ all_id[i];
        }
    }
    message_saver.removeAttribute('messages_id');
    message_saver.setAttribute('messages_id',new_all_id);
}





function see_all_message(Mes_id,path,my_id) {
    $.ajax({
        type: "POST",
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: path+'/all_message_seen',
        data: {
            _token : $('meta[name="csrf-token"]').attr('content'), 
            username:username,
            hashtag:hashtag,
            user_id:user_id,
            user_token:user_token,
            my_id: my_id,
            Mes_id: Mes_id,
        },
        dataType: "json",
        success: function(data) {

        }
    });

}






function update_sec_chat_saver(my_id,fr_id,Mes_id,path) {
    var modal_chat = document.getElementById("modal_chat_"+fr_id);
    var message_saver = document.getElementById("message_saver_"+fr_id);
    var update_massage_saver_message_id = setInterval(()=>{

        var messages_id = message_saver.getAttribute('messages_id');
        $.ajax({
            type: "POST",
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: path+'/update_sec_chat',
            data: {
                _token : $('meta[name="csrf-token"]').attr('content'), 
                username:username,
                hashtag:hashtag,
                user_id:user_id,
                user_token:user_token,
                my_id: my_id,
                fr_id: fr_id,
                Mes_id:Mes_id,
                messages_id:messages_id
            },
            dataType: "json",
            success: function(data) {
                if (data.length != 0) {
                    var new_message_detect = data[0];
                    var delete_message_detect = data[1];
                    var message_status = data[3];
                    var all_message_status = [
                        '<i class="bi bi-check"> </i>',
                        '<i class="bi bi-check-all"> </i>',
                        '<i class="bi bi-check-all text-danger"> </i>'
                    ];
                    var count_my_message = message_status['message_status'].length
                    for (let i = 0; i < count_my_message; i++) {
                        var message = (message_status['message_status'])[i];
                        var message_id = message['id'];
                        var is_mes_seen = message['is_mes_seen'];
                        var is_send_notif = message['is_send_notif'];
                        if (is_mes_seen == 'true' && is_send_notif == 'true') {
                            if (document.getElementById('message_status_'+message_id).innerHTML != all_message_status[2]) {
                                document.getElementById('message_status_'+message_id).innerHTML = all_message_status[2];
                            }
                        }else if (is_mes_seen == 'false' && is_send_notif == 'true') {
                            if (document.getElementById('message_status_'+message_id).innerHTML != all_message_status[1]) {
                                document.getElementById('message_status_'+message_id).innerHTML = all_message_status[1];
                            }
                        }else{
                            if (document.getElementById('message_status_'+message_id).innerHTML != all_message_status[0]) {
                                document.getElementById('message_status_'+message_id).innerHTML = all_message_status[0];
                            }
                        }
                    }
                    if (new_message_detect.new_message_detect != 'false') {
                        var message_object = new_message_detect.new_message_detect;
                        var message_object_keys = Object.keys(message_object);
                        for (let i = 0; i < message_object_keys.length; i++) {
                            var message_id = message_object[message_object_keys[i]];
                            if (get_specific_message(message_id,Mes_id,my_id,fr_id,path) != 'false') {
                                message_saver.removeAttribute('messages_id');
                                message_saver.setAttribute('messages_id',data[2].all_new_ids);
        
                            }
    
                        }
    
                    }
                    if (delete_message_detect.deleted_message_detected != 'false') {
    
                        var delete_object = delete_message_detect.deleted_message_detected;
                        var delete_object_keys = Object.keys(delete_object);
                        
                        for (let i = 0; i < delete_object_keys.length; i++) {
                            if (delete_object[delete_object_keys[i]] != '') {
                                var message_id = delete_object[delete_object_keys[i]];
                                if ((message_id.split('_')).length == 1) {
                                    var deleted_message = document.getElementById("message_id_"+message_id);
                                    if (deleted_message != null) {
                                        deleted_message.remove();
                                    }
                                    message_saver.removeAttribute('messages_id');
                                    message_saver.setAttribute('messages_id',data[2].all_new_ids);
                                }
                            }
                        }
                    }
                }
            }
        });
    },4000)
}


function notification_for_new_message_AND_fr_statuse_my_onlinestatus(my_id,Mes_id,bool) {
    if (bool) {
        setInterval(()=>{

            $.ajax({
                type: "POST",
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: path+'/get_friends_statuse',
                data: {
                    _token : $('meta[name="csrf-token"]').attr('content'), 
                    username:username,
                    hashtag:hashtag,
                    user_id:user_id,
                    user_token:user_token,
                    my_id: my_id,
                    fr_info:Mes_id,
                },
                dataType: "json",
                success: function(data) {
                    if (Mes_id.length != 0) {
                        for (let i = 0; i < data.length; i++) {
                            document.getElementById("FR_online_statuse_"+data[i]['fr_id']).innerText = data[i].status;
                            if (data[i].message_unseen != 0) {
                                document.getElementById("FR_num_message_"+data[i]['fr_id']).innerText = data[i].message_unseen;
                            }else{
                                document.getElementById("FR_num_message_"+data[i]['fr_id']).innerText = '';
                            }
                        }
                    }
                }
            });
        },3400);
    }



}



function get_specific_message(message_id,Mes_id,my_id,fr_id,path) {
    var messages_id =[];
    if (document.getElementById("message_saver_"+fr_id)!=null) {
        messages_id = (document.getElementById("message_saver_"+fr_id).getAttribute("messages_id")).split(',')
    }

    var bool_check_id=true;

    for (let i = 0; i < messages_id.length; i++) {
        if (messages_id[i] == message_id) {
            bool_check_id = false;
        }
    }
    if (bool_check_id) {



        $.ajax({
            type: "POST",
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: path+'/get_specific_message',
            data: {
                _token : $('meta[name="csrf-token"]').attr('content'), 
                username:username,
                hashtag:hashtag,
                user_id:user_id,
                user_token:user_token,
                my_id:my_id,
                Mes_id:Mes_id,
                message_id:message_id
            },
            dataType: "json",
            success: function(data) {
                if (data.length != 0) {
                    if (data.user_send_id != my_id) {
                        var time = ((data.created_at).split('T')[1]).split('.000000Z')[0];
                        var date = ((data.created_at).split('T')[0]).split('.000000Z')[0];
                        var message_status = '<i class="bi bi-check-all text-danger"> </i>'
                        var resualt_message = {
                            'id' : data.id,
                            'text': data.message_text,
                            'status': message_status,
                            'time': time,
                            'date': date,
                        }
                        var message_saver = document.getElementById("message_saver_"+fr_id);
                        var card_message_html = fr_message(''+resualt_message.id+'',resualt_message.text,resualt_message.status,resualt_message.time,resualt_message.date);
                        if ((message_saver.children)[0].innerHTML == 'There is no message for u') {
                            (message_saver.children)[0].remove();
                            message_saver.innerHTML = '<ul class="list-group list-group-flush py-3"></ul>'
                        }
                        (message_saver.children)[0].innerHTML += card_message_html
                        var fr_saver_height = document.getElementById("message_saver_"+fr_id);
                        fr_saver_height.scrollTo(0,fr_saver_height.scrollHeight)
                    }
                }else{
                    return 'false';
                }
            }
        });
    }


}



function delete_my_message(message,my_id,fr_id) {
    var message_id = ((message.id).split('delete_btn_'))[1];



    $.ajax({
        type: "POST",
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: path+'/remove_my_message',
        data: {
            _token : $('meta[name="csrf-token"]').attr('content'), 
            username:username,
            hashtag:hashtag,
            user_id:user_id,
            user_token:user_token,
            my_id:my_id,
            message_id:message_id
        },
        dataType: "json",
        success: function(data) {

        }
    });

    var message_saver = document.getElementById("message_saver_"+fr_id);
    var all_ids_string_old = message_saver.getAttribute("messages_id");
    var all_ids_array = all_ids_string_old.split(',');
    var all_ids_string_new='';
    for (let i = 0; i < all_ids_array.length; i++) {
        if (all_ids_array[i] == message_id) {
            all_ids_array.splice(i,1);
        }

        if (all_ids_string_new =='') {
            all_ids_string_new = all_ids_array[i];
        }else{
            all_ids_string_new =all_ids_string_new +","+ all_ids_array[i]
        }
        
    }
    message_saver.removeAttribute('messages_id');
    message_saver.setAttribute('messages_id',all_ids_string_new)
    document.getElementById("message_id_"+message_id).remove();
}





function my_message(message_id,message_text,message_status,time,date,fr_id) {
        
    var basic_card_message_my=
    `
    <li class="list-group-item border-bottom border-danger bg-dark" id="message_id_`+message_id+`">
        <div class="row">
            <div class="col">
                <div class="row text-light">
                    <div class="col text-start">
                        <button class="btn btn-dark" id="delete_btn_`+message_id+`" onclick={delete_my_message(this,'`+user_id+`','`+fr_id+`')}><i class="bi bi-trash3"> </i></button>
                    </div>
                    <div class="col text-center fs-4" id="message_status_`+message_id+`">
                        `+message_status+`
                    </div>
                    <div class="col text-end">
                        <small class="d-block" id="message_time_`+message_id+`">`+time+`</small>
                        <i id="message_date_`+message_id+`">`+date+`</i>
                    </div>
                </div>
            </div>
            <div class="col ">
                <div class="card text-center m-0 p-0" style="background-color: rgb(255, 255, 255);">
                    <div class="card-title">
                        <p class="m-0 p-0">`+message_text+`</p>
                    </div>
                </div>
            </div>
        </div>
    </li>
    `;
    return basic_card_message_my;
}
function fr_message(message_id,message_text,message_status,time,date) {
    var basic_card_message_fr=
    `
    <li class="list-group-item border-bottom border-danger bg-dark" id="message_id_`+message_id+`">
        <div class="row">
            <div class="col">
                <div class="card text-center m-0 p-0" style="background-color: rgb(187, 187, 187);">
                    <div class="card-title">
                        <p class="m-0 p-0">`+message_text+`</p>
                    </div>
                </div>
            </div>
            <div class="col">
                
                <div class="row text-light">
                    <div class="col text-start">
                        <small class="d-block" id="message_time_`+message_id+`" >`+time+`</small>
                        <i id="message_date_`+message_id+`">`+date+`</i>
                    </div>
                    <div class="col text-center fs-4" id="message_status_`+message_id+`">
                        `+message_status+`
                    </div>
                    <div class="col text-end">
                    </div>
                </div>
            </div>
        </div>
    </li>
    `;
    return basic_card_message_fr;
}






















