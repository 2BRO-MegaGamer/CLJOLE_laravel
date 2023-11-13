
<div class="position-absolute start-0 top-0 p-0 m-0 z-2 top-0 opacity-75">
    <button id="close_m_c_list" class="btn btn-danger rounded-1 p-0 m-0"><i class="bi bi-x"></i></button>
</div>


<div id="chat_message_div" class="h-100 border text-center position-relative" style="background:rgb(80, 80, 80);display:none;">
    <div id="chat_message_scroll_style" class="overflow-auto" style="max-height: 80%;">
        <div class="d-block" id="message_save_in_room">
            <div style="min-height: 20px;width:100%;"></div>
            {{-- @for ($i = 0; $i < 50; $i++)
            <div class="card my-4 border-0 position-relative" style="background: none">
                <div class="text-start text-light p-0 m-0" style="background: none;width:max-content">
                    userName
                </div>
                <div class="card-body m-0 p-0 rounded" style="background: #f4fe61;">
                    <div class=" mx-4 my-0">
                        وسلام بر شماوسلام بر شماوسلام بر شماوسلام بر شماوسلام بر شماوسلام بر شماوسلام بر شماوسلام بر شماوسلام بر شماوسلام بر شماوسلام بر شماوسلام بر شماوسلام بر شماوسلام بر شماوسلام بر شما 
                    </div>
                </div>
                <div class="position-absolute start-0 p-0 m-0 bottom-0">
                    <button class="btn p-0 m-0"><i class="bi bi-flag"></i></button>
                </div>
            </div>
            @endfor --}}
        </div>
    </div>
    <div class="position-absolute bottom-0 w-100" style="height: 20%;">
        <div class="h-100">
            <div class="form-floating" style="height: 68%">
                <textarea id="textarea_for_message_in_room" class="form-control h-100 rounded-0" placeholder="Leave a comment here"  style="resize: none;"></textarea>
                <label for="textarea_for_message_in_room">Message</label>
            </div>
            <div style="height: 32%">
                <button class="btn btn-info w-100 h-100 rounded-0"><i class="bi bi-file-earmark-arrow-up fs-4"></i></button>
            </div>
        </div>
    </div>
</div>

<div id="members_list_div" class="w-100 h-100 border " style="background:rgb(80, 80, 80);display:none;">
    <div id="members_info_scroll_style" class="list-group overflow-auto rounded-0"  style="max-height: 100%;">
        <div id="hosts_info">
            <div class="dropdown">
                <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/twbs.png" alt="twbs" width="32" height="32" class="rounded-circle flex-shrink-0">
                    <div class="d-flex gap-2 w-100 justify-content-between">
                        <div>
                            <h6 class="mb-0">{{$HOST_userName}}</h6>
                            <p class="mb-0 opacity-75">{{$HOST_hashtag}}</p>
                        </div>
                        <small class="opacity-100  my-auto text-end">🟢</small>
                    </div>
                </a>
                <div class="dropdown-menu  p-0 m-0 " style="max-width: fit-content;">
                    <div class="row w-100 p-0 m-0 ">
                        <button class="col btn btn-light rounded-0 text-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-info-circle fs-4 p-0 m-0"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div id="mods_info">
            <div class="dropdown">
                <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/twbs.png" alt="twbs" width="32" height="32" class="rounded-circle flex-shrink-0">
                    <div class="d-flex gap-2 w-100 justify-content-between">
                        <div>
                            <h6 class="mb-0">userName </h6>
                            <p class="mb-0 opacity-75">#0001</p>
                        </div>
                        <small class="opacity-100 my-auto text-end">🔴</small>
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
        </div>
        <div id="members_info">


            @for ($i = 0; $i < 50; $i++)
            <div class="dropdown">
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
            </div>
        @endfor


        </div>


    </div>
</div>
<script src="/js/meetingRoom/room_detail/m_c_list.js"></script>


<style>
#chat_message_scroll_style::-webkit-scrollbar {
    width: 5px;
}

#chat_message_scroll_style::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
}

#chat_message_scroll_style::-webkit-scrollbar-thumb {
    background-color: darkgrey;
    outline: 1px solid slategrey;
}

#members_info_scroll_style::-webkit-scrollbar {
    width: 5px;
}

#members_info_scroll_style::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
}

#members_info_scroll_style::-webkit-scrollbar-thumb {
    background-color: darkgrey;
    outline: 1px solid slategrey;
}


</style>







        {{-- <div class="dropdown">
            <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://github.com/twbs.png" alt="twbs" width="32" height="32" class="rounded-circle flex-shrink-0">
                <div class="d-flex gap-2 w-100 justify-content-between">
                    <div>
                        <h6 class="mb-0">userName </h6>
                        <p class="mb-0 opacity-75">#0001</p>
                    </div>
                    <small class="opacity-50 text-nowrap">16m</small>
                </div>
            </a>
            <div class="dropdown-menu  p-0 m-0 " style="max-width: fit-content;">
                <div class="row w-100 p-0 m-0 ">
                    <button class="col btn btn-light rounded-0 text-dark " href="#"><i class="bi bi-ban fs-4 p-0 m-0"></i></button>
                    <button class="col btn btn-light rounded-0 text-info" href="#"><i class="bi bi-megaphone fs-4 p-0 m-0"></i></button>
                    <button class="col btn btn-light rounded-0 text-secondary" href="#"><i class="bi bi-info-circle fs-4 p-0 m-0"></i></button>
                    <button class="col btn btn-light rounded-0 text-danger " href="#"><i class="bi bi-arrow-bar-right fs-4 p-0 m-0"></i></button>
                </div>
            </div>
        </div> --}}