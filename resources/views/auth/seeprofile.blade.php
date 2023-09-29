@extends('layouts.layout')

@section('content')
@php
  $title = 'Profile';
  use App\Http\Controllers\Profile;

  $profile=(new Profile)->profile_details();
  if ($profile["profile"]->prof_Img_name != null) {
    $prof_img = asset('storage/imgs/uploads/'. $profile["profile"]->prof_Img_name);
  }else{
    $prof_img = null;
  }
@endphp
<div id="profile_style_f_div" class="position-relative">
  <div  class="position-absolute start-50 translate-middle-x">
    <div class="card" id="profile_style_s_div" style="max-width: 500px;height:100%;background:{{ $profile['profile']->prof_Color }}">
      <div class="row g-0">
        <div>
          <img src="{{ ($profile["profile"]->prof_Img_name == null) ? 'https://cdn.icon-icons.com/icons2/3054/PNG/512/account_profile_user_icon_190494.png' : asset('storage/imgs/uploads/'. $profile["profile"]->prof_Img_name) }}"  class="img-fluid rounded-start" >
        </div>
        <div class="col-md-8 w-100">
          <div class="card-body">
            <h5 class="card-title">{{ $profile['UserName'] }} </h5>
            <p class="card-text">First Name: {{$profile['firstName']}} </p>
            <p class="card-text">Last Name: {{$profile['lastName']}}</p>
            <p class="card-text">{{$profile['profile']->prof_Bio}}</p>
            <p class="card-text"><small class="text-body-secondary">Updated at : {{ $profile['profile']->updated_at }}</small></p>
            <button class="btn btn-outline-info p-1 card-text position-absolute bottom-0 end-0" id="btn_change_bio" data-bs-toggle="modal" data-bs-target="#change_bio_prof"><i class="bi bi-pencil-square"></i></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById('profile_style_f_div').style.height = document.getElementById('profile_style_s_div').offsetHeight + "px";
</script>


@if (isset($Serrors) && $Serrors != "")
<div id="get-errors" class="badge bg-danger position-absolute start-50 translate-middle">
  <small >There is some error pls try again</small>

</div>
@endif





<div class="modal fade" id="change_bio_prof" tabindex="-1" aria-labelledby="change_bio_prof_Label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered ">
    <div class="modal-content " style="background-color: burlywood;">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="change_bio_prof_Label">profile image</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/seeprofile" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body ">
          <p>Do you want to change the details?</p>
          <div class="">
            <div class="mb-3">
              <label for="username_inchange" class="form-label">Username</label>
              <input type="text" name="newUsername" autocomplete="off" class="form-control " id="username_inchange" value="{{$profile['UserName']}}">
            </div>
            <div class="mb-3">
              <label for="username_inchange" class="form-label">First Name</label>
              <input type="text" name="newFirstname" autocomplete="off" class="form-control "  id="firstname_inchange" value="{{$profile['firstName']}}">
            </div>
            <div class="mb-3">
              <label for="username_inchange" class="form-label">Last Name</label>
              <input type="text" name="newLastname" autocomplete="off" class="form-control " id="lastname_inchange" value="{{$profile['lastName']}}">
            </div>
            <div class="mb-3">
              <label for="bio_inchange" class="form-label">bio</label>
              
              <textarea class="form-control" name="newBio" autocomplete="off" maxlength="570" id="bio_inchange" rows="5">{{ $profile["profile"]->prof_Bio }}</textarea>
            </div>
          </div>

        </div>
        <div class="modal-body">
          <p>Do you want to change the photo?</p>
                
            <div id="img_div">

              <img width="470px" height="480px" id="preview-selected-image"  src="{{ ($profile["profile"]->prof_Img_name == null) ? 'https://cdn.icon-icons.com/icons2/3054/PNG/512/account_profile_user_icon_190494.png' : asset('storage/imgs/uploads/'.$profile["profile"]->prof_Img_name) }}" />
  
            </div>
            <label for="file-upload">Upload Image</label>
            <input type="file" id="file-upload" accept="image/*" name="prof_Img" onchange="previewImage(event);" />
            
        </div>
        <div class="modal-footer p-0 m-0">
          <input type="color" class="form-control form-control-color mx-3 position-absolute start-0 bg-dark p-0 m-0" value="{{ $profile["profile"]->prof_Color }}" name="Color">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script src="/js/seeprofile.js"></script>
@endsection




