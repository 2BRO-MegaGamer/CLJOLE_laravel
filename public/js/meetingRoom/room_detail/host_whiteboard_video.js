var bottom_of_white_board_div = document.getElementById("bottom_of_white_board_div");
var white_board_div = document.getElementById("white_board_div");


var bottom_of_host_video_div = document.getElementById("bottom_of_host_video_div");
var host_video_div = document.getElementById("host_video_div");


var bottom_video_style_active = 'box-shadow: 8px 0px 50px 3px black; background:rgba(36, 36, 36, 0.511);';


white_board_div.addEventListener("mouseover",(e)=>{
    white_board_div.addEventListener("mouseleave",(e)=>{
        if (bottom_of_white_board_div.getAttribute("style") == bottom_video_style_active) {
            bottom_of_white_board_div.removeAttribute("style");
            bottom_of_white_board_div.setAttribute("style",bottom_video_style_active + "opacity:0;");
            white_board_div.removeEventListener("mouseleave",()=>{})

        }
    })
    if (bottom_of_white_board_div.getAttribute("style") !== bottom_video_style_active) {
        bottom_of_white_board_div.setAttribute("style",bottom_video_style_active);
    }
})


host_video_div.addEventListener("mouseover",(e)=>{
    host_video_div.addEventListener("mouseleave",(e)=>{
        if (bottom_of_host_video_div.getAttribute("style") == bottom_video_style_active) {
            bottom_of_host_video_div.setAttribute("style",bottom_video_style_active + "opacity:0;");
            host_video_div.removeEventListener("mouseleave",()=>{})
        }
    })
    if (bottom_of_host_video_div.getAttribute("style") !== bottom_video_style_active) {
        bottom_of_host_video_div.setAttribute("style",bottom_video_style_active);
    }
})



var use_mic_btn = document.getElementById("use_mic_btn");

use_mic_btn.addEventListener("click",()=>{
    if (use_mic_btn.getAttribute('mute') == "true") {
        user_want_to_use_mic(public_peer);
        // var btn_unmuted = ["btn col text-light","bi bi-mic fs-4"];
        // person.setAttribute('mute',"false");
        // person.setAttribute('class',btn_unmuted[0]);
        // document.getElementById(id_for_voice_element).removeAttribute("muted");
        // (person.children)[0].setAttribute('class',btn_unmuted[1])
    }else{

    }
})


async function user_want_to_use_mic(peer) {
    var stream = await get_media_stream(false,true);
    console.log(stream,"ssssssssssssssss");
    // peer_connected(peer,stream);
}


async function get_media_stream(video,voice) {

    navigator.mediaDevices.getUserMedia({video: video,audio: voice}, function(stream) {
        console.log(stream);
        return stream;
    }, function(err) {
            console.log('Failed to get local stream' ,err);
    })

}