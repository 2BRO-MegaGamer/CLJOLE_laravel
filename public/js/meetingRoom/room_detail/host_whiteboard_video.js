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