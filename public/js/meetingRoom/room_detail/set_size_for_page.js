
function set_max_height_width() {
    var body = document.documentElement;
    var cilent_width = window.innerWidth;
    var cilent_height = window.innerHeight;
    var style_value = "max-width:"+cilent_width+"px;max-height:"+cilent_height+"px;";
    body.setAttribute("style",style_value);
    console.log("size changed",style_value);
}
set_max_height_width()