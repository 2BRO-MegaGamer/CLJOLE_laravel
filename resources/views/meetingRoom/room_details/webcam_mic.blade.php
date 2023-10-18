<div class="bg-secondary  w-100 h-100">
    <div id="webcam_or_voice_scroll_style" class="overflow-auto " style="max-height: 100%;">
        <div id="div_voice_video_for_host_card" class="card border-danger text-center mx-3 " style="margin-bottom: 5px;">
            <div class="card-header p-1" style="background: rgb(255, 145, 0);">
                <div class="text-start " id="HOST_userName_div_voice"></div>
                <div class="text-end  opacity-75" id="HOST_hashtag_div_voice"></div>
                <div class="opacity-0 d-none" style="background: rgba(0, 0, 0, 0);">
                    <audio id="HOST_voice_chat_audio_tag" width="0px" muted></audio>
                </div>
            </div>
            <div class="w-100  position-relative d-none">
                <div class="h-100">
                    <div class="position-absolute text-start w-75 top-0 start-0">
                        <div class="opacity-75 text text-truncate" id="HOST_userName_div_video"></div>
                    </div>
                    <div class="position-absolute text-end w-25 top-0 end-0">
                        <div class="opacity-75" id="HOST_hashtag_div_video"></div>
                    </div>
                    <video id="HOST_video_tag" class="w-100 h-100" style="background: rgba(0, 0, 0, 0);"></video>
                </div>
            </div>
            <div class="card-body  p-0 m-0">
                <div class="position-relative border-top border-primary  rounded-bottom" style="background: rgb(255, 145, 0);">
                    <div class=" text-center">
                        <button onclick="mute_this_person(this,'HOST_voice_chat_video')" class="btn p-0 m-0 text-danger" disabled><i class="bi bi-mic-mute fs-4"></i></button>
                    </div>
                    <div class="position-absolute bottom-0 start-0">
                        <button class="btn p-0 m-0"><i class="bi bi-flag"></i></button>
                    </div>
                </div>
            </div>
        </div>
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
