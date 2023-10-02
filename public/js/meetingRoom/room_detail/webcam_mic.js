var bottom_of_member_webcam_div = document.getElementById("bottom_of_member_webcam_div");
var member_video_div = document.getElementById("member_video_div");


var bottom_video_member_style_active = 'box-shadow: 0px -10px 50px 3px rgb(255, 0, 0); background:rgba(36, 36, 36, 0.511);';


member_video_div.addEventListener("mouseover",(e)=>{
    member_video_div.addEventListener("mouseleave",(e)=>{
        if (bottom_of_member_webcam_div.getAttribute("style") == bottom_video_member_style_active) {
            bottom_of_member_webcam_div.setAttribute("style",bottom_video_member_style_active + "opacity:0;");
            member_video_div.removeEventListener("mouseleave",()=>{})
        }
    })
    if (bottom_of_member_webcam_div.getAttribute("style") !== bottom_video_member_style_active) {
        bottom_of_member_webcam_div.setAttribute("style",bottom_video_member_style_active);
    }
})