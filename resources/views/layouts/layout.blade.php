


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ Session::token() }}"> 
    <link rel="icon" href="{{asset('./imgs/home/icon_naranji.png')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>{{$title}}</title>
</head>

<body style="background-color: rgb(95, 95, 95)">

    <div id="model_controller_friends"></div>
    @include('layouts.header_nav')
    <div id="header" class="z-3">
        @yield('header')
    </div>

    <div id="main" class="z-0">
        <div>
            @yield('content')
        </div>
    </div>
    <div id="footer" class="z-3">
        <footer>
            <ul class="nav justify-content-center w-100">
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Features</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Pricing</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">FAQs</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">About</a></li>
            </ul>
            <div class="row align-items-center p-0 m-0">
                <div class="col border-bottom"></div>
                <div class="col-1 fw-bold text-center "><i class="bi bi-airplane-fill" style="font-size:70px;"></i></div>
                <div class="col border-bottom"></div>
            </div>
            <p class="text-center text-body-secondary">© 2023 Company, Inc</p>
        </footer>
    </div>
    <div id="react_example"></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous" defer></script>
    <script src="{{ asset('jquery.js') }}" defer></script>
    <script >

        var all_imgs = document.querySelectorAll('img');
        var all_videos = document.querySelectorAll('video');
        for (let i = 0; i < all_imgs.length; i++) {
            all_imgs[i].addEventListener("unload",()=>{
                all_imgs[i].style.filter="blur(30px)"

            })
            console.log(all_imgs[i] , "detect");
        }
        for (let y = 0; y < all_videos.length; y++) {
            
        }
            
    </script>
    <script src="/js/script.js" defer></script>
</body>
</html>