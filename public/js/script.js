function show_hide_pass(TOF,info,eye) {
    switch (TOF) {
        case true:
            var showpass_input = document.getElementById(info);
            showpass_input.removeAttribute("type");
            showpass_input.setAttribute("type","text");
            var eye_look = eye;
            eye_look.removeAttribute("onclick");
            eye_look.setAttribute("onclick","show_hide_pass(false,\'"+ info +"\',this)")
            eye_look.children[0].removeAttribute("class");
            eye_look.children[0].setAttribute("class","bi bi-eye-slash position-absolute start-50 top-50 translate-middle")
            break;
        
        case false:
            var showpass_input = document.getElementById(info);
            showpass_input.removeAttribute("type");
            showpass_input.setAttribute("type","password");
            var eye_look = eye;
            eye_look.removeAttribute("onclick");
            eye_look.setAttribute("onclick","show_hide_pass(true,\'"+ info +"\',this)")
            eye_look.children[0].removeAttribute("class");
            eye_look.children[0].setAttribute("class","bi bi-eye position-absolute start-50 top-50 translate-middle")

            break
        default:
            break;
    }
    
}


