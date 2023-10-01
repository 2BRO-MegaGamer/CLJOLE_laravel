var chat_message_sidebar_btn =   document.getElementById("chat_message_sidebar_btn");
var member_list_sidebar_btn =   document.getElementById("member_list_sidebar_btn");
var dark_light_mode_sidebar_btn =   document.getElementById("dark_light_mode_sidebar_btn");
var announcement_sidebar_btn =   document.getElementById("announcement_sidebar_btn");
var status_sidebar_btn =   document.getElementById("status_sidebar_btn");
var setting_sidebar_btn =   document.getElementById("setting_sidebar_btn");
var report_room_sidebar_btn =   document.getElementById("report_room_sidebar_btn");
var leave_room_sidebar_btn =   document.getElementById("leave_room_sidebar_btn");


var side_panle_style_active = 'background:rgb(80, 80, 80);';
var side_btn_not_active = 'btn btn-light rounded-0 rounded-start w-100 h-100 fs-3';
var side_btn_active = 'btn btn-info rounded-0 rounded-start w-100 h-100 fs-3';

chat_message_sidebar_btn.addEventListener("click",()=>{
    show_chat_message();
})



member_list_sidebar_btn.addEventListener("click",()=>{
    show_member_list();

    
})

function show_member_list() {
    var members_list_div = document.getElementById("members_list_div");
    var chat_message_div = document.getElementById("chat_message_div");

    if (chat_message_div.getAttribute("style") == side_panle_style_active) {
        chat_message_sidebar_btn.setAttribute('class',side_btn_not_active)
        chat_message_div.setAttribute('style',side_panle_style_active+"display:none;");
    }else{
        make_room_page_smaller_for_c_m_list();
    }
    member_list_sidebar_btn.setAttribute("class",side_btn_active)
    members_list_div.setAttribute('style',side_panle_style_active);
}


function show_chat_message() {
    var members_list_div = document.getElementById("members_list_div");
    var chat_message_div = document.getElementById("chat_message_div");

    if (members_list_div.getAttribute("style") == side_panle_style_active) {
        member_list_sidebar_btn.setAttribute('class',side_btn_not_active)
        members_list_div.setAttribute('style',side_panle_style_active+"display:none;");
    }else{
        make_room_page_smaller_for_c_m_list()
    }
    chat_message_sidebar_btn.setAttribute("class",side_btn_active)
    chat_message_div.setAttribute('style',side_panle_style_active);
}