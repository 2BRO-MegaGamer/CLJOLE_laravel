
function get_members_profile_info(members,fr_peer,is_it_host) {
    $.ajax({
        type: "POST",
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/get_member_profile_and_detail',
        data: {
            _token : $('meta[name="csrf-token"]').attr('content'), 
            username:USER_INFO.USER_NAME,
            hashtag:USER_INFO.USER_HASHTAG,
            user_id:USER_INFO.USER_ID,
            user_token:USER_INFO.USER_TOKEN,
            my_id: USER_INFO.USER_ID,
            room_uuid: ROOM_INFO.ROOM_UUID,
            members: members,
            fr_info:fr_peer
        },
        dataType: "json",
        success: function(resultData) {make_member_list_visible(resultData,is_it_host);}
    });
}
function change_host_prof_img() {
    get_members_profile_info(null,HOST_INFO.HOST_peer_id,true);
}

function make_member_list_visible(members_info,is_it_host) {
    var members_user_hash_id = Object.keys(members_info);
    var all_old_member_item_div = [document.getElementById("hosts_info").children,document.getElementById("mods_info").children,document.getElementById("members_info").children];
    var bool_for_items = check_members_visible_in_list(all_old_member_item_div, members_info,is_it_host);
    if (bool_for_items === false) {
        members_user_hash_id = [];
    }else if(bool_for_items !== true){
        members_user_hash_id = bool_for_items;
    }
    if (members_user_hash_id.length > 0) {
        members_user_hash_id.forEach(u_h_i => {

            if (u_h_i === HOST_INFO.HOST_peer_id) {

                document.getElementById("HOST_profile_img").src = "http://" +  window.location['host'] + '/storage/imgs/uploads/' + (members_info[u_h_i].profile).prof_Img_name;
                document.getElementById("HOST_profile_img_secend").src = "http://" +  window.location['host'] + '/storage/imgs/uploads/' + (members_info[u_h_i].profile).prof_Img_name;
            }else{
                var member = members_info[u_h_i];

                var member_permissions_info = member.permission;
                let object_t_array = Object.entries(member_permissions_info);
                let object_filtred = object_t_array.filter(([key, value]) => value === true);
                let out_of_filter = Object.fromEntries(object_filtred);
                let m_permission = (Object.keys(out_of_filter))[0];
                if (m_permission !== "HOST") {
                    create_html_for_member_list(member,u_h_i,m_permission,null);
                }
            }
        });
    }
}


function check_members_visible_in_list(old_members,get_members,is_it_host) {
    if (is_it_host) {
        return true;
    }
    var host = HOST_INFO.HOST_peer_id;
    var all_NEW_mods_members_peer_ids = Object.keys(get_members);
    var all_OLD_mods_members_peer_ids = [];
    // var diff_new_and_old=[];
    all_OLD_mods_members_peer_ids.push(host);
    if (old_members[1].length > 0) {
        for (let i = 0; i < old_members[1].length; i++) {
            all_OLD_mods_members_peer_ids.push((old_members[1][i].id).split("_item")[0]);
        }
    }
    if (old_members[2].length > 0) {
        for (let i = 0; i < old_members[2].length; i++) {
            all_OLD_mods_members_peer_ids.push((old_members[2][i].id).split("_item")[0]);
        }
    }
    var diff_new_old_members = getDifference_between_members(all_OLD_mods_members_peer_ids,all_NEW_mods_members_peer_ids);
    return diff_new_old_members;

}


function getDifference_between_members(old_member, new_member) {
    var diff_members = [];
    for (let i = 0; i < new_member.length; i++) {
        var is_it_simple = true;
        for (let y = 0; y < old_member.length; y++) {
            if (new_member[i] == old_member[y]) {
                is_it_simple = false;
            }
            
        }
        if (is_it_simple === true) {
            diff_members.push(new_member[i]);
        }
        
    }

    return diff_members;
}



function create_html_for_member_list(member,peer_id,m_permission,is_it_me) {
    var mods_info = document.getElementById("mods_info");
    var members_info = document.getElementById("members_info");
    var username = (peer_id.split("_")[1]).split('-')[0];
    var hashtag = (peer_id.split("_")[1]).split('-')[1];
    var img_src = ((member.profile).path) !== null ? "http://" +  window.location['host'] + '/storage/imgs/uploads/' + (member.profile).prof_Img_name  : "https://github.com/twbs.png";
    var btn_for_show_info_card = '<button class="col btn btn-light rounded-0 text-secondary dropdown-toggle" data-bs-toggle="modal" data-bs-target="#'+peer_id+'_modal"><i class="bi bi-info-circle fs-4 p-0 m-0"></i></button>';
    var controller_change = {
        host : 
        `
        <button class="col btn btn-light rounded-0 text-dark " href="#"><i class="bi bi-ban fs-4 p-0 m-0"></i></button>
        <button class="col btn btn-light rounded-0 text-info" href="#"><i class="bi bi-megaphone fs-4 p-0 m-0"></i></button>
        <button class="col btn btn-light rounded-0 text-success rounded-end" href="#"><i class="bi bi-person-fill-check fs-4 p-0 m-0"></i></button>
        <button class="col btn btn-light rounded-0 text-danger " href="#"><i class="bi bi-arrow-bar-right fs-4 p-0 m-0"></i></button>
        `,
        mods:
        `
        <button class="col btn btn-light rounded-0 text-dark " href="#"><i class="bi bi-ban fs-4 p-0 m-0"></i></button>
        <button class="col btn btn-light rounded-0 text-danger " href="#"><i class="bi bi-arrow-bar-right fs-4 p-0 m-0"></i></button>
        `,
        members:
        `
        <button class="col btn btn-light rounded-0 text-secondary" href="#"><i class="bi bi-info-circle fs-4 p-0 m-0"></i></button>
        `
    }
    var controller_html = "";

    switch (ROOM_INFO.ROOM_Permission) {
        case "HOST":
            controller_html = controller_change.host;
            break;
    
        case "MOD":
            controller_html = controller_change.mods;
            break;
        default:
            controller_html = controller_change.members;
            break;
    }
    
    
    
    let base_html_card_for_member_list = `

    <div id="`+peer_id+`_item">
        <div class="dropdown">
            <a class="list-group-item list-group-item-action d-flex gap-3 py-3"  role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="`+img_src+`" can_fullscreen = "false" id="`+peer_id+`_PROF_IMG" alt="twbs" width="32" height="32" class="rounded-circle flex-shrink-0">
                <div class="d-flex gap-2 w-100 justify-content-between">
                    <div>
                        <h6 class="mb-0" id="`+peer_id+`_UserName">`+username+`</h6>
                        <p class="mb-0 opacity-75" id="`+peer_id+`_hashtag">#`+hashtag+`</p>
                    </div>
                    <small class="opacity-100 my-auto text-end" id=`+peer_id+`_network status">🔴</small>
                </div>
            </a>
            <div class="dropdown-menu  p-0 m-0 " style="max-width: fit-content;">
                <div class="row w-100 p-0 m-0 rounded "  >
                    `+  controller_html + btn_for_show_info_card +`
                </div>
            </div>
        </div> 
        <div class="modal " id="`+peer_id+`_modal" aria-labelledby="`+peer_id+`_label" aria-hidden="true" tabindex="-1" >
            <div class="modal-dialog">
                <div class="modal-content position-relative bg-dark text-light">
                <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="row mw-100 mh-100">
                        <div class="col-3">
                        <img src="`+img_src+`" can_fullscreen = "true" class="rounded-end w-100 h-100">
                        </div>
                        <div class="col-sm-9">
                            <h5 class="modal-title">`+username+` <small class="opacity-75">#`+hashtag+`</small></h5>
                            <div>
                            `+((member.profile).prof_Bio)+`
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    `;


    switch (m_permission) {
        case "MOD":
            mods_info.innerHTML += base_html_card_for_member_list;
            break;
        default:
            members_info.innerHTML += base_html_card_for_member_list;
            break;
    }


    // mods_info.innerHTML += base_html_card_for_member_list;
}




/////////////////////////////////MODS/////////////////////////////////


/* 
<div class="dropdown">
    <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" id="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="https://github.com/twbs.png" id="PEER_ID+_PROF_IMG" alt="twbs" width="32" height="32" class="rounded-circle flex-shrink-0">
        <div class="d-flex gap-2 w-100 justify-content-between">
            <div>
                <h6 class="mb-0" id="PEER_ID+_UserName">userName </h6>
                <p class="mb-0 opacity-75" id="PEER_ID+_hashtag">#0001</p>
            </div>
            <small class="opacity-100 my-auto text-end" id="PEER_ID+_network status">🔴</small>
        </div>
    </a>
    <div class="dropdown-menu  p-0 m-0 " style="max-width: fit-content;">
        <div class="row w-100 p-0 m-0 ">
            <button class="col btn btn-light rounded-0 text-dark " href="#"><i class="bi bi-ban fs-4 p-0 m-0"></i></button>
            <button class="col btn btn-light rounded-0 text-info" href="#"><i class="bi bi-megaphone fs-4 p-0 m-0"></i></button>
            <button class="col btn btn-light rounded-0 text-secondary" href="#"><i class="bi bi-info-circle fs-4 p-0 m-0"></i></button>
            <button class="col btn btn-light rounded-0 text-success rounded-end" href="#"><i class="bi bi-person-fill-check fs-4 p-0 m-0"></i></button>
            <button class="col btn btn-light rounded-0 text-danger " href="#"><i class="bi bi-arrow-bar-right fs-4 p-0 m-0"></i></button>
        </div>
    </div>
</div> 
*/




/////////////////////////////////MODS/////////////////////////////////

/////////////////////////////////members/////////////////////////////////



/* <div class="dropdown">
<a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    <img src="https://github.com/twbs.png" alt="twbs" width="32" height="32" class="rounded-circle flex-shrink-0">
    <div class="d-flex gap-2 w-100 justify-content-between">
        <div>
            <h6 class="mb-0">userName </h6>
            <p class="mb-0 opacity-75">#0001</p>
        </div>
        <small class="opacity-100  my-auto text-end">🟢</small>
    </div>
</a>
<div class="dropdown-menu  p-0 m-0 " style="max-width: fit-content;">
    <div class="row w-100 p-0 m-0 ">
        <button class="col btn btn-light rounded-0 text-dark rounded-start" href="#"><i class="bi bi-ban fs-4 p-0 m-0"></i></button>
        <button class="col btn btn-light rounded-0 text-info" href="#"><i class="bi bi-megaphone fs-4 p-0 m-0"></i></button>
        <button class="col btn btn-light rounded-0 text-secondary" href="#"><i class="bi bi-info-circle fs-4 p-0 m-0"></i></button>
        <button class="col btn btn-light rounded-0 text-success rounded-end" href="#"><i class="bi bi-person-fill-check fs-4 p-0 m-0"></i></button>
        <button class="col btn btn-light rounded-0 text-danger rounded-end" href="#"><i class="bi bi-arrow-bar-right fs-4 p-0 m-0"></i></button>
    </div>
</div>
</div> */




/////////////////////////////////members/////////////////////////////////



/////////////////////////////////HOST/////////////////////////////////

{/* <div id="hosts_info">
<div class="dropdown">
    <a class="list-group-item list-group-item-action d-flex gap-3 py-3" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <img id="HOST_profile_img" src="https://github.com/twbs.png" alt="twbs" width="32" height="32" class="rounded-circle flex-shrink-0">
        <div class="d-flex gap-2 w-100 justify-content-between">
            <div>
                <h6 id="HOST_userName" class="mb-0">{{$HOST_userName}}</h6>
                <p id="HOST_hashtag" class="mb-0 opacity-75">{{$HOST_hashtag}}</p>
            </div>
            <small id="HOST_internet_status" class="opacity-100  my-auto text-end">🟢</small>
        </div>
    </a>
    <div class="dropdown-menu  p-0 m-0 " style="max-width: fit-content;">
        <div class="row w-100 p-0 m-0 ">
            <button class="col btn btn-light rounded-0 text-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-info-circle fs-4 p-0 m-0"></i></button>
        </div>
    </div>
</div>
</div> */}



/////////////////////////////////HOST/////////////////////////////////
