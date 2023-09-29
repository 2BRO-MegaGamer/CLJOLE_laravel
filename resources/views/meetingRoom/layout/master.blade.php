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

    <title>{{$roomID}}</title>
</head>
<body>
    @yield('MR_room')
</body>
<script src="{{ asset('jquery.js') }}"></script>
<script defer src="https://unpkg.com/peerjs@1.5.0/dist/peerjs.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"defer></script>
<script src="/js/meetingRoom/meetingRoom_make_connection.js" defer></script>
</html>