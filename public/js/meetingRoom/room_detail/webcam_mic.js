// var bottom_of_member_webcam_div = document.getElementById("bottom_of_member_webcam_div");
// var member_video_div = document.getElementById("member_video_div");


var bottom_video_member_style_active = 'box-shadow: 0px -10px 50px 3px rgb(255, 0, 0); background:rgba(36, 36, 36, 0.511);';


// member_video_div.addEventListener("mouseover",(e)=>{
//     member_video_div.addEventListener("mouseleave",(e)=>{
//         if (bottom_of_member_webcam_div.getAttribute("style") == bottom_video_member_style_active) {
//             bottom_of_member_webcam_div.setAttribute("style",bottom_video_member_style_active + "opacity:0;");
//             member_video_div.removeEventListener("mouseleave",()=>{})
//         }
//     })
//     if (bottom_of_member_webcam_div.getAttribute("style") !== bottom_video_member_style_active) {
//         bottom_of_member_webcam_div.setAttribute("style",bottom_video_member_style_active);
//     }
// })
function edit_host_voice_card() {
    var HOST_userName_div = document.getElementById("HOST_userName_div");
    var HOST_hashtag_div = document.getElementById("HOST_hashtag_div");
    HOST_userName_div.innerText = HOST_INFO.HOST_NAME;
    HOST_hashtag_div.innerText = HOST_INFO.HOST_HASHTAG;
}
edit_host_voice_card();

function make_card_for_voice_chat_card(call_info,HOST) {
    console.log(call_info);
    var call_recipient = call_info.call_recipient;
    var call_sender = call_info.call_sender;
    if (call_recipient.userName == HOST.HOST_NAME && call_recipient.hashtag == HOST.HOST_HASHTAG && call_recipient.userID == HOST.HOST_id) {
        console.log("call_recipient HOST");
        HTML_appear_card(call_sender.userName,call_sender.hashtag,call_sender.peer_id);

    }
    if (call_sender.userName == HOST.HOST_NAME && call_sender.hashtag == HOST.HOST_HASHTAG && call_sender.userID == HOST.HOST_id) {
        console.log("call_sender HOST");
        HTML_appear_card(call_recipient.userName,call_recipient.hashtag,call_recipient.peer_id);
    }
    if (!(call_sender.userName == HOST.HOST_NAME && call_sender.hashtag == HOST.HOST_HASHTAG && call_sender.userID == HOST.HOST_id) && !(call_recipient.userName == HOST.HOST_NAME && call_recipient.hashtag == HOST.HOST_HASHTAG && call_recipient.userID == HOST.HOST_id)) {
        console.log("NO one HOST");
        HTML_appear_card(call_sender.userName,call_sender.hashtag,call_sender.peer_id);
        HTML_appear_card(call_recipient.userName,call_recipient.hashtag,call_recipient.peer_id);
        
    }
    edit_host_voice_card();

    // if (userName == HOST.HOST_NAME && hashtag== HOST.HOST_HASHTAG && id == HOST.HOST_id) {
    //     edit_host_voice_card();
    //     HTML_appear_card(USER_INFO.USER_NAME,USER_INFO.USER_HASHTAG,USER_INFO.MY_UNIQUE_ID);
    // }else{
    //     if (USER_INFO.USER_NAME == HOST.HOST_NAME && USER_INFO.USER_HASHTAG == HOST.HOST_HASHTAG && USER_INFO.USER_ID == HOST.HOST_id) {
    //         edit_host_voice_card();
    //     }
    //     HTML_appear_card(userName,hashtag,fr_peer);

    // }

    // edit_host_voice_card();




    function HTML_appear_card(userName,hashtag,peer_id) {
        var webcam_or_voice_scroll_style = document.getElementById("webcam_or_voice_scroll_style");
        var all_member_voice_div = webcam_or_voice_scroll_style.children;
        var is_there_any_same_div =false;
        for (let i = 0; i < all_member_voice_div.length; i++) {
            if (all_member_voice_div[i].id === peer_id+"_div_voice_chat_card") {
                is_there_any_same_div = true;
            }
        }
        if (is_there_any_same_div === false) {
            var style_of_card_voice_chat = `
            <div id="`+peer_id+`_div_voice_chat_card" class="card border-danger text-center mx-3 " style="margin-bottom: 5px;">
                <div class="card-header p-1 " style="background: rgb(255, 145, 0);">
                    <div class="text-start">
                        `+ userName +`
                    </div>
                    <div class="text-end">
                        `+ hashtag +`
                    </div>
                    <div class="opacity-0 d-none" style="background: rgba(0, 0, 0, 0);">
                        <video id="`+peer_id+`_voice_chat" width="0px" muted></video>
                    </div>
                </div>
                <div class="card-body  p-0 m-0">
                    <div class="position-relative border-top border-primary  rounded-bottom" style="background: rgb(255, 145, 0);">
                        <div class=" text-center">
                            <button onclick="mute_this_person(this,"`+peer_id+`")" muted="true" class="btn p-0 m-0 text-danger" disabled><i class="bi bi-mic-mute fs-4"></i></button>
                        </div>
                        <div class="position-absolute bottom-0 start-0">
                            <button class="btn p-0 m-0"><i class="bi bi-flag"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            `;
            if (webcam_or_voice_scroll_style.innerHTML === "") {
                webcam_or_voice_scroll_style.innerHTML = style_of_card_voice_chat;
            }else{
                webcam_or_voice_scroll_style.innerHTML = webcam_or_voice_scroll_style.innerHTML + "\n" + style_of_card_voice_chat;
            }
        }
    }






}


function mute_this_person(person,peer_id) {
    var id_for_voice_element;

    if (peer_id === "HOST_voice_chat_video") {
        id_for_voice_element = "HOST_voice_chat_video";
    }else{
        id_for_voice_element = peer_id+"_voice_chat";
    }

    if (person.getAttribute('mute') == "true") {
        var btn_unmuted = ["btn p-0 m-0 text-success","bi bi-mic fs-4"];
        person.setAttribute('mute',"false");
        person.setAttribute('class',btn_unmuted[0]);
        document.getElementById(id_for_voice_element).removeAttribute("muted");
        (person.children)[0].setAttribute('class',btn_unmuted[1])


    }else{
        var btn_muted = ["btn p-0 m-0 text-danger","bi bi-mic-mute fs-4"];
        person.setAttribute('mute',"true");
        person.setAttribute('class',btn_muted[0]);
        (person.children)[0].setAttribute('class',btn_muted[1])
        document.getElementById(id_for_voice_element).setAttribute("muted","");


    }
}


















{/* <div class="card border-danger text-center mx-3" style="margin-bottom: 5px;">
<div id="member_video_div" class="w-100 bg-dark">
    <video width="100%" src=""></video>
    <div id="bottom_of_member_webcam_div" class="position-absolute bottom-0 start-50 translate-middle-x w-100 rounded-0 rounded-top" style="box-shadow: 0px -10px 50px 3px rgb(255, 0, 0); background:rgba(36, 36, 36, 0.511);opacity:0;">
        <div class="row w-100 text-center m-0 p-0">
            <div class="col align-items-center d-flex w-100">
                <input type="range" class="form-range" min="0" max="100" value="100"  id="customRange2">
            </div>
            <div class="col  text-end">
                <button class="btn m-0 p-0 text-light"> <i class="bi bi-fullscreen "></i></button>
            </div>
        </div>
    </div>
</div>
</div> */}