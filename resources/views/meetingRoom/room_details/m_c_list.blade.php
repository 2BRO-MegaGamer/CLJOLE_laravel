<div id="m_c_list_scroll_style" class="w-100 overflow-auto border text-center" style="max-height: 85%;background:rgb(80, 80, 80);">
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
            <button class="btn btn-info w-100 h-100 rounded-0"><i class="bi bi-mic fs-4"></i></button>
        </div>
    </div>
</div>

<style>
#m_c_list_scroll_style::-webkit-scrollbar {
    width: 5px;
}

#m_c_list_scroll_style::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
}

#m_c_list_scroll_style::-webkit-scrollbar-thumb {
    background-color: darkgrey;
    outline: 1px solid slategrey;
}
</style>