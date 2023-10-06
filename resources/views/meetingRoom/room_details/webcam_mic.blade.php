<div class="bg-secondary  w-100 h-100">
    <div id="webcam_or_voice_scroll_style" class="overflow-auto " style="max-height: 100%;">
        <div id="div_voice_chat_for_host" class="card border-danger text-center mx-3 " style="margin-bottom: 5px;">
            <div class="card-header p-1 " style="background: rgb(255, 145, 0);">
                <div class="text-start">
                    `+ userName +`
                </div>
                <div class="text-end">
                    `+ hashtag +`
                </div>
                <div class="opacity-0 d-none" style="background: rgba(0, 0, 0, 0);">
                    <video id="`+fr_peer+`_voice_chat" width="0px" ></video>
                </div>
            </div>
            <div class="card-body  p-0 m-0">
                <div class="position-relative border-top border-primary  rounded-bottom" style="background: rgb(255, 145, 0);">
                    <div class=" text-center">
                        <button class="btn p-0 m-0 text-danger"><i class="bi bi-mic-mute fs-4"></i></button>
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
