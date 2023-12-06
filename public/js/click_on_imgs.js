
window.addEventListener("load",()=>{
    setInterval(()=>{
        set_fullScreen_for_imgs(get_all_imgs());
    },5000)
})


function get_all_imgs() {
    var all_imgs = document.querySelectorAll('img');
    return all_imgs;
}



function set_fullScreen_for_imgs(all_imgs) {
    all_imgs.forEach(imgs => {
        if (imgs.getAttribute("have_Listener") !== "true") {
            imgs.addEventListener('click',(e)=>{
                if ((e.target).getAttribute("can_fullscreen") === "true") {
                    if (imgs.id === "") {
                        imgs.id = "in_full_screen_img";
                        imgs.addAttribute("have_Listener","true");
                    }
                    imgs.requestFullscreen();
                }
            })
        }
    });
}