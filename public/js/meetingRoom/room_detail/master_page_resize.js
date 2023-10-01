function make_room_page_smaller_for_c_m_list() {
    var M_C_list = document.getElementById("M_C_list");
    var host_video_whiteboard = document.getElementById("host_video_whiteboard");
    M_C_list.setAttribute("style","max-width: 20%;")
    host_video_whiteboard.setAttribute("style","max-width: 65%;")
}


function make_room_page_bigger_for_host_videos() {
    var M_C_list = document.getElementById("M_C_list");
    var host_video_whiteboard = document.getElementById("host_video_whiteboard");
    M_C_list.setAttribute("style","max-width: 20%;display:none;")
    host_video_whiteboard.setAttribute("style","max-width: 85%;")
    
}

var close_m_c_list = document.getElementById("close_m_c_list");


close_m_c_list.addEventListener("click",()=>{
    make_room_page_bigger_for_host_videos()

});
make_room_page_bigger_for_host_videos();