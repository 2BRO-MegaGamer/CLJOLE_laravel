<div class="bg-secondary  w-100 h-100">
    <div id="webcam_or_voice_scroll_style" class="overflow-auto " style="max-height: 100%;">
        <div class="card border-danger text-center mx-3" style="margin-bottom: 5px;">
            <div id="member_video_div" class="w-100 bg-dark">
                <video width="100%" src=""></video>
                <div id="bottom_of_member_webcam_div" class="position-absolute bottom-0 start-50 translate-middle-x w-100 rounded-0 rounded-top" style="box-shadow: 0px -10px 50px 3px rgb(255, 0, 0); background:rgba(36, 36, 36, 0.511);opacity:0;">
                    <div class="row w-100 text-center m-0 p-0">
                        <div class="col align-items-center d-flex w-100">
                            <input type="range" class="form-range" min="0" max="100" value="100"  id="customRange2">
                        </div>
                        <div class="col  text-end">
                            <button class="btn m-0 p-0 text-light"> <i class="bi bi-fullscreen "></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @for ($i = 0; $i < 40; $i++)
        <div class="card border-danger text-center mx-3 " style="margin-bottom: 5px;">
            <div class="card-header p-1 " style="background: rgb(255, 145, 0);">
                <div class="">
                    <div class="text-start">
                        USERNAME
                    </div>
                    <div class="text-end">
                        #0001
                    </div>
                </div>
            </div>
            <div class="card-body  p-0 m-0">
                <div class="position-relative border-top border-primary  rounded-bottom" style="background: rgb(255, 145, 0);">
                    <div class=" text-center">
                        <button class="btn p-0 m-0 text-success"><i class="bi bi-mic fs-4"></i></button>
                    </div>
                    <div class="position-absolute bottom-0 start-0">
                        <button class="btn p-0 m-0"><i class="bi bi-flag"></i></button>
                    </div>
                </div>
            </div>
        </div>
        @endfor
    </div>

</div>

<script src="/js/meetingRoom/room_detail/webcam_mic.js"></script>




<style>

#webcam_or_voice_scroll_style::-webkit-scrollbar {
    width: 5px;
}

#webcam_or_voice_scroll_style::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
}

#webcam_or_voice_scroll_style::-webkit-scrollbar-thumb {
    background-color: darkgrey;
    outline: 1px solid slategrey;
}
</style>
