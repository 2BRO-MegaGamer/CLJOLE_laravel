
<div class="position-absolute start-0 z-2 top-0">
    <button id="close_m_c_list" class="btn btn-danger rounded-0 p-0 m-0"><i class="bi bi-x fs-3"></i></button>
</div>


<div id="chat_message_div" class="h-100 border text-center" style="background:rgb(80, 80, 80);display:none;">
    <div id="chat_message_scroll_style" class="overflow-auto" style="max-height: 85%;">
        <div class="d-block">
            @for ($i = 0; $i < 50; $i++)
            <div class="card my-2 border-danger">
                <div class="card-header border-bottom border-warning" style="background: #C496FE">
                    userName:
                </div>
                <div class="card-body" style="background: #ED96FE;">
                    salam,salam,salam,salam,salam,salam,salam,salam,salam,salam,salam,salam,salam,salam,salam,salam,salam,salam,salam,salam,salam,salam,salam,salam,salam,salam,salam,salam,
                </div>
            </div>
            @endfor
        </div>
    </div>
    <div style="height: 15%;">
        <div class=" h-100">
            <div class="form-floating" style="height: 68%">
                <textarea class="form-control h-100 rounded-0" placeholder="Leave a comment here" id="floatingTextarea" style="resize: none;"></textarea>
                <label for="floatingTextarea">Message</label>
            </div>
            <div style="height: 32%">
                <button class="btn btn-info w-100 h-100 rounded-0"><i class="bi bi-file-earmark-arrow-up fs-4"></i></button>
            </div>
        </div>
    </div>
</div>

<div id="members_list_div" class="w-100 h-100 border " style="background:rgb(80, 80, 80);display:none;">
    <div id="members_info_scroll_style" class="list-group overflow-auto rounded-0"  style="max-height: 100%;">
        <div class="dropdown">
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
            <ul class="dropdown-menu p-0 m-0 rounded" style="max-width: fit-content;">
                <div class="dropdown-item w-100  p-0 m-0">
                    <div class="row w-100 p-0 m-0">
                        <button class="col btn btn-light rounded-0 text-dark rounded-start" href="#"><i class="bi bi-ban fs-3"></i></button>
                        <button class="col btn btn-light rounded-0 text-info" href="#"><i class="bi bi-megaphone fs-3"></i></button>
                        <button class="col btn btn-light rounded-0 text-secondary" href="#"><i class="bi bi-info-circle fs-3"></i></button>
                        <button class="col btn btn-light rounded-0 text-danger rounded-end" href="#"><i class="bi bi-arrow-bar-right fs-3"></i></button>
                    </div>
                </div>
            </ul>
        </div>
        @for ($i = 0; $i < 50; $i++)
        <div class="dropdown">
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
            <ul class="dropdown-menu p-0 m-0 rounded" style="max-width: fit-content;">
                <div class="dropdown-item w-100  p-0 m-0">
                    <div class="row w-100 p-0 m-0">
                        <button class="col btn btn-light rounded-0 text-dark rounded-start" href="#"><i class="bi bi-ban fs-3"></i></button>
                        <button class="col btn btn-light rounded-0 text-info" href="#"><i class="bi bi-megaphone fs-3"></i></button>
                        <button class="col btn btn-light rounded-0 text-secondary" href="#"><i class="bi bi-info-circle fs-3"></i></button>
                        <button class="col btn btn-light rounded-0 text-warning " href="#"><i class="bi bi-flag  fs-3"></i></button>
                        <button class="col btn btn-light rounded-0 text-danger rounded-end" href="#"><i class="bi bi-arrow-bar-right fs-3"></i></button>
                    </div>
                </div>
            </ul>
        </div>
        @endfor
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