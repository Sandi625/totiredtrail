<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,height=device-height,  initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assetsFE/css/galerry.css') }}">

   <link rel="shortcut icon" href="{{ asset('Images/icon.png') }}" type="image/x-icon" />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.7/dist/sweetalert2.all.min.js"></script>
    <title>Gallery | Vamos</title>

</head>

<body>

    <div class="loaderr">
        <div class="loader-inner">
            <div class="loader-line-wrap">
                <div class="loader-line"></div>
            </div>
            <div class="loader-line-wrap">
                <div class="loader-line"></div>
            </div>
            <div class="loader-line-wrap">
                <div class="loader-line"></div>
            </div>
            <div class="loader-line-wrap">
                <div class="loader-line"></div>
            </div>
            <div class="loader-line-wrap">
                <div class="loader-line"></div>
            </div>
        </div>
    </div>

    <nav>
        <a href="#" class="brand-logo">Vamos</a>
      <ul class="links">
            {{-- <li class="link">
                <b><a href="{{ route('home') }}" >Home</a></b>
            </li>
            <li class="link"><a href="{{ route('places.page') }}">Places</a></li>
            <li class="link"><a href="{{ route('allpackage.page') }}">Tour</a></li>
            <li class="link"><a href="{{ route('user.blog.index') }}">Blog</a></li>
            <li class="link"><a href="{{ route('user.gallery.images') }}"style="color: #f2870c">Gallery</a></li>

            <!-- 🔥 Tambahkan Login di sini -->
            <li class="link"><a href="{{ route('login') }}">Login</a></li> --}}
        </ul>

        <div class="hamburger">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </nav>

    <section class="header">
        <div class="header-content">
            <h1>Enjoy the <span class="textHighlight">breath-taking sceneries</span> we captured around the world</h1>
            <p>Travel photography blogs and vlogs are great sources of inspiration, both for travelling around the world
                and the photography that comes with it. They can provide useful tips and destination ideas as well.

            </p>
        </div>
       <div style="display: flex; justify-content: center; gap: 20px; margin-top: 20px;">
    <!-- Tombol Images -->
    <a href="{{ route('user.gallery.images') }}" class="scrollButton">
        <img src="https://img.icons8.com/material-sharp/24/e48111/camera--v2.png" />
        <p>View Photos</p>
    </a>

    <!-- Tombol Videos -->
    <a href="{{ route('user.gallery.videos') }}" class="scrollButton">
        <img src="https://img.icons8.com/material-sharp/24/e48111/video.png" />
        <p>View Videos</p>
    </a>
</div>


     <div class="custom-shape-divider-bottom-1631284277" style="display:none;">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
        preserveAspectRatio="none">
        <path
            d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z"
            class="shape-fill"></path>
    </svg>
</div>

    </section>
