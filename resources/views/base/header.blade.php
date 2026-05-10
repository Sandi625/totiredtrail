<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link rel="shortcut icon" href="{{ asset('Images/icon.png') }}" type="image/x-icon" />
       <title>Blog | Vamos</title>
    <link rel="stylesheet" href="{{ asset('css/blog2.css') }}">
      <link rel="stylesheet" href="{{ asset('assetsFE/css/styleblog.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.7/dist/sweetalert2.all.min.js"></script>
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
            <li class="link">
                <b><a href="{{ route('home') }}" >Home</a></b>
            </li>
            {{-- <li class="link"><a href="{{ route('places.page') }}">Places</a></li>
            <li class="link"><a href="{{ route('allpackage.page') }}">Tour</a></li>
            <li class="link"><a href="{{ route('user.blog.index') }}"style="color: #f2870c">Blog</a></li>
            <li class="link"><a href="{{ route('user.gallery.images') }}">Gallery</a></li>

            <!-- 🔥 Tambahkan Login di sini -->
            <li class="link"><a href="{{ route('login') }}">Login</a></li> --}}
        </ul>

    <div class="hamburger">
        <div></div>
        <div></div>
        <div></div>
    </div>
</nav>


    <!-- <div class="pageName-container">
        <p class="page">./PLACES</p>
    <hr width="200%" color="#98a1c2">
    </div> -->
    <section class="header">
      <div class="header-content">
        <h1>
          The travel writing that will teleport you to
          <span class="textHighlight"> gorgeous destinations</span>
        </h1>
        <p>
          We have a passion for storytelling, a knack for putting itineraries
          together and a strong desire to have fun. Here are all our adventures,
          our travel tips and our guides.
        </p>
      </div>
      <a href="#blog" class="scrollContainer"
        ><button class="scrollButton">
          <img src="https://img.icons8.com/ios-filled/50/e48111/book.png" />
          <p>Read</p>
        </button></a
      >
      <div class="custom-shape-divider-bottom-1631284471">
        <svg
          data-name="Layer 1"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 1200 120"
          preserveAspectRatio="none"
        >
          <path
            d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
            class="shape-fill"
          ></path>
        </svg>
      </div>
    </section>
