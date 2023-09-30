<!DOCTYPE html>
<html lang="en">
    @php
        $server_path = 'http://'. $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] ."/mR";
        $user_hash_id = auth()->user()->UserName."_".auth()->user()->hashtag."_".auth()->id();
        $user_token = password_hash($user_hash_id,PASSWORD_DEFAULT);
    @endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script>
        const ROOM_UUID = "{{$roomUUID}}"
        const ROOM_ID = "{{$roomID}}"
        const USER_NAME = "{{auth()->user()->UserName}}"
        const USER_HAHSTAG = "{{auth()->user()->hashtag}}"
        const USER_ID = "{{auth()->id()}}"
        const USER_TOKEN = "{{$user_token}}"
        const IN_ROOM_NAME = "{{$my_custom_name}}"
        const ROOM_Permission = "{{$Permission}}"
        const MY_UNIQUE_ID = ""+ ROOM_UUID+'_'+USER_NAME+'-'+(USER_HAHSTAG.split('#'))[1]+'-'+USER_ID;
        const path = '{{$server_path}}';
        const duplicate_detect = "{{$duplicate}}";
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>{{$roomID}}</title>
</head>
<body>
    <div class="row w-100 vh-100 p-0 m-0" style="width: 100%;">
        <div class="col p-0" id="webcam_or_mic_in_use" style="max-width: 15%;">
            @include('meetingRoom.room_details.webcam_mic')
        </div>
        <div class="col p-0 m-0 vh-100" id="host_video_whiteboard" style="max-width: 50%;">
            @include('meetingRoom.room_details.host_whiteboard_video')
        </div>
        <div class="col p-0 m-0 vh-100" id="M_C_list" style="max-width: 30%;">
            @include('meetingRoom.room_details.m_c_list')
        </div>
        <div class="col" id="sidebar" style="max-width: 5%;">
            @include('meetingRoom.room_details.sidebar')
        </div>
    </div>

</body>
<script src="{{ asset('jquery.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"defer></script>
{{-- <script defer src="https://unpkg.com/peerjs@1.5.0/dist/peerjs.min.js"></script>
<script src="/js/meetingRoom/meetingRoom_make_connection.js" defer></script> --}}
</html>