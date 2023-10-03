<div class="align-items-center d-flex w-100 ">
    <div id="host_video_div" class="bg-info position-relative w-100 ">
        <video src="" class="w-100 mh-50" ></video>
        <div id="bottom_of_host_video_div" class="position-absolute bottom-0 start-50 translate-middle-x w-100 rounded-0 rounded-top" style="box-shadow: 8px 0px 50px 3px black; background:rgba(36, 36, 36, 0.511);opacity:0;">
            <div class="row w-100 text-center m-0 p-0">
                <div class="col row">
                    <div class="col m-auto mx-0" style="max-width: 10%;">
                        <button class="btn p-0 m-0"> <i class="bi bi-volume-up-fill fs-4"></i> </button>
                        
                    </div>
                    <div class="col-3 align-items-center d-flex mx-0">
                        <input type="range" class="form-range" min="0" max="100" value="100"  id="customRange2">
                    </div>
                </div>
                <div class="col text-end">
                    <button class="btn m-0 p-0"> <i class="bi bi-fullscreen fs-4"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div id="white_board_div" class="bg-light position-relative border w-100 border-4 border-success" style="height: 50%;display:none;">
        <video src="" class="w-100"></video>
        <div id="bottom_of_white_board_div" class="position-absolute bottom-0 start-50 translate-middle-x w-100 rounded-0 rounded-top" style="box-shadow: 8px 0px 50px 3px black; background:rgba(36, 36, 36, 0.511);opacity:0;">
            <div class="row w-100 text-center m-0 p-0">
                <div class="col text-end">
                    <button class="btn m-0 p-0"> <i class="bi bi-fullscreen fs-4"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row position-absolute bottom-0 start-50 translate-middle-x rounded w-50"  style="background: rgb(0, 147, 167)">
    <button class="btn col"><i class="bi bi-camera-video fs-4"></i></button>
    <button class="btn col"><i class="bi bi-mic fs-4"></i></button>
    <button class="btn col"><i class="bi bi-hand-index fs-4"></i></button>


</div>
<script src="/js/meetingRoom/room_detail/host_whiteboard_video.js"></script>