<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="{{ asset('assetsFE/css/detailtour.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assetsFE/css/detailtour2.css') }}"> --}}

    <link rel="shortcut icon" href="{{ asset('Images/icon.png') }}" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


    <title>Vamos Tour</title>
</head>

<body>

    <nav>
        <a href="#" class="brand-logo">Vamos</a>
        <ul class="links">
            <li class="link">
                {{-- <b><a href="{{ route('home') }}" >Home</a></b> --}}
            </li>
            {{-- <li class="link"><a href="{{ route('places.page') }}">Places</a></li> --}}
            {{-- <li class="link"><a href="{{ route('allpackage.page') }}"style="color: #f2870c">Tour</a></li>
            <li class="link"><a href="{{ route('user.blog.index') }}">Blog</a></li>
            <li class="link"><a href="{{ route('user.gallery.images') }}">Gallery</a></li>

            <li class="link"><a href="{{ route('login') }}">Login</a></li> --}}
        </ul>

        <div class="hamburger">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </nav>

    <a href="#header">
        <div class="toTop">
            <img src="https://img.icons8.com/metro/26/eb9431/left-up2.png" />
        </div>
    </a>



    <script>
        var swiper = new Swiper(".mySwiper", {
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            effect: "slide",
        });
    </script>

    <style>
        .swiper {
            width: 100%;
            height: 100vh;
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
        }

        .swiper-slide {
            width: 100%;
            height: 100%;
        }
    </style>
