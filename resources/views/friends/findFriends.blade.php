@extends('layouts.layout')
@php
    $title = 'FindFrined';
@endphp
@section('content')


<div class="card mx-auto my-4" style="width: 40rem;background-color:darkkhaki;">
    <div class="card-header input-group ">
        <form action="/findFriends" class="input-group p-0 m-0" method="get">

            <input type="text" placeholder="Username" autocomplete="off" id="username" name="username" style="width: 70%;"  class="form-control border border-primary" value="{{ isset($_GET['username']) ? $_GET['username'] : '' }}">
            <input type="text" maxlength="5" placeholder="Hashtag"  autocomplete="off" id="hashtag"    style="width: 20%;" name="hashtag" class="form-control border border-primary" value="{{ isset($_GET['hashtag']) ? $_GET['hashtag'] : '' }}">
            <button type="submit" class="btn btn-outline-success my-1" id="findFriend"  disabled><i class="bi bi-search"></i></button>
        </form>
        <small class="badge bg-info rounded-1 text-black mx-auto">example#0000</small>
    </div>
    @php
        if (isset($message)) {
            echo $message;
        }
    @endphp

</div>
<script src="/js/header/findfriend.js"></script>
@endsection


