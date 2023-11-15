@php
use App\Models\Profile_img_bio;
use App\Http\Controllers\Profile;
use App\Http\Controllers\HeaderController;
use App\Http\Controllers\UserStatusController;


(new UserStatusController)->change_statuse_online(auth()->user()->id,auth()->user()->UserName);

$profile=(new Profile)->profile_details();


if ($profile['profile']->user_id != null) {
    if ($profile['profile']->prof_Img_name != null) {
        $profile_img = asset($profile['profile']->prof_Img_name);
    }else{
        $profile_img = null;

    }
    
}else {
    $profile_img = null;

}

@endphp


<div class="d-flex">
    <div class="m-2">
        <div class="dropdown d-inline">
            <div class="row text-light">
                <div class="col">
                    <img src="{{ ($profile_img == null) ? 'https://cdn.icon-icons.com/icons2/3054/PNG/512/account_profile_user_icon_190494.png' : asset('storage/imgs/uploads/'.$profile["profile"]->prof_Img_name) }}" class="rounded d-inline" style="height:35px;width:35px">

                </div>
                <div class="z-3 col p-0 m-0">
                    <button id="info_user_btn" class="btn btn-secondary dropdown-toggle text-truncate" style="max-width: 200px" data-bs-toggle="dropdown" aria-expanded="false">{{Auth::user()->UserName}}</button>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="/seeprofile">Profile</a></li>
                        <li><a id="get_friends_info" data-bs-toggle="modal" data-bs-target="#see_freind_list" class="dropdown-item" type="button">Friends</a></li>
                        <li><form action="/home" method="post"> @csrf<a class="dropdown-item" href="/logout">log out</a></form></li>
                    </ul>
                </div>
                <div id="hashtag_side_animation" class="z-0 col text-center align-self-center position-absolute w-75" style="height: 70%;">
                    <div class=" bg-secondary border border-start-0 rounded-end position-relative" >
                        <span id="hashtag_value_small" class="fw-bold">{{auth()->user()->hashtag}}</span>
                        <span id="icon_copy" class="position-absolute top-0 start-100 translate-middle badge rounded-pill p-0 m-0" style="opacity: 0;color:#dc3545;"><i class="bi bi-clipboard-plus fs-5 "></i></span>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    #hashtag_side_animation{
        opacity: 0;
        animation-name: hashtag_out;
        animation-duration: 1s;
        animation-fill-mode: forwards;
    }

    @keyframes hashtag_out{
        0%{
            opacity: 0;
            left: 20%;
        }

        100%{
            opacity: 1;
            left: 100%;

        }
    }
    @keyframes text_copy{
        0%{
            opacity: 0;
            color: #dc3545;
        }
        25%{
            opacity: 1;
            color: #dc3545;
        }
        50%{
            opacity: 1;
            color: #0DCAF0;

        }
        100%{
            opacity: 0;
            color: #0DCAF0;
        }
    }


</style>
<script defer>
document.getElementById("hashtag_value_small").addEventListener("click",(e)=>{
    var hashtag_value_small = document.getElementById("hashtag_value_small")
    var info_user_btn = document.getElementById("info_user_btn")
    navigator.clipboard.writeText(info_user_btn.innerText + "" + hashtag_value_small.innerText);
    change_color_animation();
})
function change_color_animation() {
    var icon_copy = document.getElementById('icon_copy');
    if (icon_copy.style.animationName == '') {
        icon_copy.style.animationName='text_copy';
        icon_copy.style.animationDuration='1s';
    }else{
        setTimeout(()=>{
        icon_copy.style.animationName='';
        icon_copy.style.animationDuration='';
    },1000)
    }

}
</script>

<?php
$server_path = 'http://'. $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'];
$user_hash_id = auth()->user()->UserName."_".auth()->user()->hashtag."_".auth()->id();
$user_token = password_hash($user_hash_id,PASSWORD_DEFAULT);
?>
<script defer>
    const username = '{{auth()->user()->UserName}}';
    const hashtag = '{{auth()->user()->hashtag}}';
    const user_id = '{{auth()->id()}}';
    const user_token = '{{$user_token}}';
    const path = '{{$server_path}}';
function friend_data(username,hashtag,user_id,user_token,bool) {
    $.ajax({
        type: "POST",
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: path+'/get_info',
        data: {
            _token : $('meta[name="csrf-token"]').attr('content'), 
            username:username,
        hashtag:hashtag,
        user_id:user_id,
        user_token:user_token,
        my_id: {{auth()->id()}},
        },
        dataType: "json",
        success: function(data) {
            if (data.length != 0) {
            var send_data = data[0];
            var get_data = data[1];
            var both_data = data[2];
            if (send_data.length != 0) {
                for (let i = 0; i < send_data[0].length; i++) {
                    if (i == 0) {
                        document.getElementById('Friend_send_req').innerHTML = ''
                    }
                    var send_card = get_card_send(send_data[0][i],send_data[1][i]);
                    document.getElementById('Friend_send_req').innerHTML += send_card;
                }

            }
            if (get_data.length != 0) {
                for (let i = 0; i < get_data[0].length; i++) {
                    if (i==0) {
                        document.getElementById('Friend_get_req').innerHTML=''
                    }
                    var get_card = get_card_get(get_data[0][i],get_data[1][i]);
                    document.getElementById('Friend_get_req').innerHTML += get_card;
                }
            }

            if (both_data.length != 0) {
                for (let i = 0; i < both_data[0].length; i++) {
                    if (i==0) {
                        document.getElementById('Friend_both_req').innerHTML=''
                    }

                    var both_card = get_card_both(both_data[0][i],both_data[1][i]);
                    document.getElementById('Friend_both_req').innerHTML += both_card;

                }
            }
            notification_for_new_message_AND_fr_statuse_my_onlinestatus(user_id,both_data[2],bool);
            message_data_script(both_data,{{auth()->id()}},path);
            }

        }
    });


}



var btn_get = document.getElementById("get_friends_info");
var bool_for_click = true;
if (btn_get != null) {
    btn_get.addEventListener("click",()=>{
        if (bool_for_click) {
            friend_data(username,hashtag,user_id,user_token,bool_for_click);
            bool_for_click = false;
        }
    })
    setTimeout(()=>{
        friend_data(username,hashtag,user_id,user_token,bool_for_click);
        bool_for_click = false;

    },5000)
}



</script>
