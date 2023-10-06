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



function make_card_for_voice_chat_card(userName,hashtag,fr_peer) {
    var webcam_or_voice_scroll_style = document.getElementById("webcam_or_voice_scroll_style");
    console.log(webcam_or_voice_scroll_style.children);
    var all_member_voice_div = webcam_or_voice_scroll_style.children;
    var is_there_any_same_div =false;
    for (let i = 0; i < all_member_voice_div.length; i++) {
        if (all_member_voice_div[i].id === fr_peer+"_div_voice_chat") {
            console.log("vojod");
            is_there_any_same_div = true;
        }
    }
    if (is_there_any_same_div === false) {
        var style_of_card_voice_chat = `
        <div id="`+fr_peer+`_div_voice_chat" class="card border-danger text-center mx-3 " style="margin-bottom: 5px;">
            <div class="card-header p-1 " style="background: rgb(255, 145, 0);">
                <div class="text-start">
                    `+ userName +`
                </div>
                <div class="text-end">
                    `+ hashtag +`
                </div>
                <div class="opacity-0 d-none" style="background: rgba(0, 0, 0, 0);">
                    <video id="`+fr_peer+`_voice_chat" width="0px" ></video>
                </div>
            </div>
            <div class="card-body  p-0 m-0">
                <div class="position-relative border-top border-primary  rounded-bottom" style="background: rgb(255, 145, 0);">
                    <div class=" text-center">
                        <button class="btn p-0 m-0 text-danger"><i class="bi bi-mic-mute fs-4"></i></button>
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