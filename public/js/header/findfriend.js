addEventListener("input",()=>{
    find_btn_click()
})


function find_btn_click(){

    var username = document.getElementById("username");
    var hashtag = document.getElementById("hashtag");
    var btn_findFriend = document.getElementById("findFriend");
    var all_input = [username,hashtag];
    var error_count=0;
    all_input.forEach(inha => {
        if (inha.value == "") {
            error_count++;
        }
    });

    if (error_count == 0) {
        if (btn_findFriend.getAttribute("disabled") == "") {
            btn_findFriend.removeAttribute("disabled");
        }
    }


}