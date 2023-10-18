<!DOCTYPE html>
<html lang="en">
    @php
        use App\Models\Rooms;
        $server_path = 'http://'. $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] ."/mR";
        $user_hash_id = auth()->user()->UserName."_".auth()->user()->hashtag."_".auth()->id();
        $user_token = password_hash($user_hash_id,PASSWORD_DEFAULT);

        $members_get = (Rooms::where('room_uuid',$roomUUID)->get())[0]->Members;
        $members_get = explode(',',$members_get);
        $members_connected="";
        for ($i=0; $i < count($members_get); $i++) { 
            if ($members_get[$i] != auth()->id()) {
                if ($members_connected === "") {
                    $members_connected = $members_get[$i];
                }else {
                    $members_connected = $members_connected .",". $members_get[$i];
                }
            }
        }
        $am_i_host;
        if ($Permission === "HOST") {
            $am_i_host = "true";
        }else {
            $am_i_host = "false";
        }
    @endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script>
        const ROOM_INFO ={
            ROOM_UUID : "{{$roomUUID}}",
            ROOM_ID: "{{$roomID}}",
            ROOM_Permission: "{{$Permission}}",
        };
        const USER_INFO = {
            USER_NAME: "{{auth()->user()->UserName}}",
            USER_HASHTAG: "{{auth()->user()->hashtag}}",
            USER_ID: "{{auth()->id()}}",
            USER_TOKEN: "{{$user_token}}",
            IN_ROOM_NAME: "{{$my_custom_name}}",
            MY_UNIQUE_ID: ""+ "{{$roomUUID}}" +'_'+"{{auth()->user()->UserName}}"+'-'+(("{{auth()->user()->hashtag}}").split('#'))[1]+'-'+"{{auth()->id()}}",
            duplicate_detect: "{{$duplicate}}",
            MEMBERS_CONNECTED_DB: "{{$members_connected}}",
            AM_I_HOST: "{{$am_i_host}}"
        };
        const HOST_INFO = {
            HOST_NAME: "{{$HOST_userName}}",
            HOST_HASHTAG: "{{$HOST_hashtag}}",
            HOST_id: "{{$HOST_id}}",
            HOST_peer_id: ""+ "{{$roomUUID}}" +'_'+"{{$HOST_userName}}"+'-'+(("{{$HOST_hashtag}}").split('#'))[1]+'-'+"{{$HOST_id}}",
        };

        const path ='{{$server_path}}';

    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>{{$roomID}}</title>
</head>
<body>
    <div class=" vh-100 p-0 m-0" style="max-width: 100%;">
        <div class="row p-0 m-0 " style="width: 100%;">
            <div class="col p-0 vh-100" id="webcam_or_mic_in_use" style="max-width: 15%;">
                @include('meetingRoom.room_details.webcam_mic')
            </div>
            <div class="col p-0 m-0 vh-100 position-relative  bg-dark" id="host_video_whiteboard" style="max-width: 60%;">
                @include('meetingRoom.room_details.host_whiteboard_video')
            </div>
            <div class="col p-0 m-0 position-relative vh-100 " id="M_C_list"  style="max-width: 20%;">
                @include('meetingRoom.room_details.m_c_list')
            </div>
        </div>
        <div id="sidebar" style="max-width: 5%;">
            @include('meetingRoom.room_details.sidebar')
        </div>
    </div>


</body>
<script src="{{ asset('jquery.js') }}"></script>
<script src="/js/meetingRoom/room_detail/master_page_resize.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"defer></script>
<script defer src="https://unpkg.com/peerjs@1.5.0/dist/peerjs.min.js"></script>
<script src="/js/meetingRoom/meetingRoom_make_connection.js" defer></script>
</html>