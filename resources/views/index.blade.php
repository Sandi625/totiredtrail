<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--=============== FAVICON ===============-->
    <link rel="shortcut icon" href="assetsFE/img/favicon.png" type="image/x-icon">

    <!--=============== REMIXICONS ===============-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">

    <!--=============== SWIPER CSS ===============-->
    <link rel="stylesheet" href="{{ asset('assetsFE/css/swiper-bundle.min.css') }}">
    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="{{ asset('assetsFE/css/styles.css') }}">

    <title>Totired Trail</title>
</head>

<body>
    <!--==================== HEADER ====================-->
    <header class="header" id="header">
        <div class="nav container">
            <a href="#" class="nav__logo">
                <img src="/assetsFE/img/logo.svg" alt="image">
                <span>Totired Trail</span>
            </a>

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li>
                        <a href="#home" class="nav__link active-link">Home</a>
                    </li>
                    <li>
                        <a href="#destination" class="nav__link">Destination</a>
                    </li>
                    <li>
                        <a href="#testimonials" class="nav__link">Testimonials</a>
                    </li>
                    <li>
                       <a href="{{ route('user.gallery.images') }}" class="nav__link">Gallery</a>
                    </li>
                    <li>
                        <a href="#join" class="nav__link">Contact</a>
                    </li>
                </ul>

                <!-- Close Button -->
                <div class="nav__close" id="nav-close">
                    <i class="ri-close-large-line"></i>
                </div>
            </div>

            <div class="nav__buttons">
                <!-- Theme button -->
                <i class="ri-moon-fill nav__theme" id="theme-button"></i>

                <!-- Toggle button -->
                <div class="nav__toggle" id="nav-toggle">
                    <i class="ri-apps-2-fill nav__theme"></i>
                </div>
            </div>
        </div>
    </header>

    <!--==================== MAIN ====================-->
    <main class="main">
        <!--==================== HOME ====================-->
        <section class="home section" id="home">
            <img src="assetsFE/img/home-bg.png" class="home__bg" alt="image">
            <div class="home__blur"></div>

            <div class="home__container container grid">
                <div class="home__data">
                    <h1 class="home__title">Travel <br> Around <br> The World</h1>

                    <p class="home__description">
                        Explore the best beautiful tourist spots in
                        the countries and see the world on all your
                        amazing adventures.
                    </p>

                    <a href="#destination" class="button button__opa-30">
                        Explore The World
                        <i class="ri-arrow-right-long-fill"></i>
                    </a>
                </div>

                <div class="home__swiper swiper">
                    <div class="swiper-wrapper">
                        <article class="home__article swiper-slide">
                            <img src="assetsFE/img/home-img-1.png" alt="image" class="home__img">
                        </article>

                        <article class="home__article swiper-slide">
                            <img src="assetsFE/img/home-img-2.png" alt="image" class="home__img">
                        </article>

                        <article class="home__article swiper-slide">
                            <img src="assetsFE/img/home-img-3.png" alt="image" class="home__img">
                        </article>

                        <article class="home__article swiper-slide">
                            <img src="assetsFE/img/home-img-4.png" alt="image" class="home__img">
                        </article>
                    </div>

                    <!-- Navigation buttons -->
                    <div class="swiper-button-prev">
                        <i class="ri-arrow-left-long-fill"></i>
                    </div>

                    <div class="swiper-button-next">
                        <i class="ri-arrow-right-long-fill"></i>
                    </div>
                </div>
            </div>
        </section>
        <section class="destination section" id="destination">
            <h2 class="section__title">Find Your Best <br> Destination</h2>

            @forelse($categories as $category)

                @if ($category->tours->count())
                    {{-- 🔥 CATEGORY TITLE --}}
                    <h3 class="destination__category-title">
                        {{ strtoupper($category->name) }} TOUR
                    </h3>

                    <div class="destination__container container grid">

                        @foreach ($category->tours as $tour)
                            @php
                                $images = is_array($tour->images) ? $tour->images : json_decode($tour->images, true);

                                $images = is_array($images) ? $images : [];
                                $image = $images[0] ?? 'default.png';
                            @endphp

                            <a href="{{ route('tour.detail', $tour->slug) }}" class="destination__link">
                                <article class="destination__card">

                                    <img src="{{ asset('uploads/tours/' . $image) }}" alt="{{ $tour->title }}"
                                        class="destination__img">

                                    <div class="destination__data">


                                        {{-- TITLE --}}
                                        <h2 class="destination__title">
                                            {{ strtoupper($tour->title) }}
                                        </h2>

                                        {{-- LOCATION --}}
                                        <p class="destination__country">
                                            <i class="ri-map-pin-2-fill"></i>
                                            <span>{{ $tour->route_name ?? 'Indonesia' }}</span>
                                        </p>

                                        {{-- BUTTON --}}
                                        <span class="destination__button">
                                            Detail <i class="ri-arrow-right-line"></i>
                                        </span>

                                    </div>

                                </article>

                            </a>
                        @endforeach

                    </div>
                @endif

            @empty
                <p style="text-align:center;">Belum ada data tour</p>
            @endforelse

        </section>

   <!--==================== TESTIMONIAL ====================-->
<section class="testimonial section" id="testimonials">
    <h2 class="section__title">
        What Are <br> They Saying?
    </h2>

    <div class="testimonial__container">

        <div class="testimonial__swiper swiper">

            <div class="swiper-wrapper">

                @foreach($reviews as $review)

                @php
                    $photos = [];

                    if ($review->photo) {
                        $decoded = json_decode($review->photo, true);

                        if (is_array($decoded) && count($decoded) > 0) {
                            $photos = $decoded;
                        } else {
                            $photos = [$review->photo];
                        }
                    }

                    $firstPhoto = count($photos) ? $photos[0] : null;
                @endphp

                <div class="swiper-slide">

                    <!-- CARD -->
                    <article
                        class="testimonial__card review-modal-trigger"

                        data-name="{{ $review->name }}"
                        data-rating="{{ $review->rating }}"
                        data-review="{{ $review->review_text }}"
                        data-photo="{{ $firstPhoto
                            ? asset('uploads/reviews/' . $firstPhoto)
                            : 'https://ui-avatars.com/api/?name=' . urlencode($review->name) . '&background=random' }}"
                    >

                        <div>

                            <h2 class="testimonial__title">
                                {{ $review->name }}
                            </h2>

                            <!-- LIMIT TEXT -->
                            <p class="testimonial__description">
                                {{ \Illuminate\Support\Str::limit($review->review_text, 120) }}
                            </p>

                            @if(strlen($review->review_text) > 120)
                                <span class="testimonial__readmore">
                                    Read More
                                </span>
                            @endif

                        </div>

                        <div class="testimonial__profile">

                            <img
                                src="{{ $firstPhoto
                                    ? asset('uploads/reviews/' . $firstPhoto)
                                    : 'https://ui-avatars.com/api/?name=' . urlencode($review->name) . '&background=random' }}"
                                alt="review-image"
                            >

                            <div class="testimonial__info">

                                <h3>{{ $review->name }}</h3>

                                <p>
                                    ⭐ {{ $review->rating }}/5
                                </p>

                            </div>

                        </div>

                    </article>

                </div>
                @endforeach

            </div>

            <!-- Navigation -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

        </div>

    </div>
</section>

<!--==================== REVIEW MODAL ====================-->
<div class="review-modal" id="reviewModal">

    <div class="review-modal__overlay"></div>

    <div class="review-modal__content">

        <button class="review-modal__close" id="reviewModalClose">
            <i class="ri-close-line"></i>
        </button>

        <img
            src=""
            alt="review-image"
            class="review-modal__img"
            id="reviewModalImg"
        >

        <h2 class="review-modal__name" id="reviewModalName"></h2>

        <p class="review-modal__rating" id="reviewModalRating"></p>

        <p class="review-modal__text" id="reviewModalText"></p>

    </div>

</div>



        <section class="hero-premium section" id="home">
            <div class="hero-premium__bg"></div>

            <div class="join__container container grid">
                <div class="hero-premium__top">
                    <span class="hero-premium__subtitle">Journey Beyond Expectations</span>
                    <h1 class="hero-premium__heading">Explore Indonesia Hidden Paradise</h1>
                    <p class="hero-premium__text">
                        Discover handcrafted private adventures to the most iconic and hidden destinations across
                        Indonesia.
                    </p>
                </div>

                <div class="hero-premium__swiper swiper">
                    <div class="swiper-wrapper">

                        @forelse($blogs as $blog)
                            <div class="swiper-slide hero-premium__slide">
                                <a href="{{ route('user.blog.show', $blog->slug) }}" class="hero-premium__link">
                                    <div class="hero-premium__card">

                                        <img src="{{ asset('uploads/blogs/' . ($blog->image ?? 'default.png')) }}"
                                            class="hero-premium__img" alt="{{ $blog->title }}">

                                        <div class="hero-premium__overlay"></div>

                                        <div class="hero-premium__content">
                                            <span class="hero-premium__category">Travel Journal</span>

                                            <h2 class="hero-premium__title">
                                                {{ strtoupper(\Illuminate\Support\Str::limit($blog->title, 28)) }}
                                            </h2>

                                            <p class="hero-premium__location">
                                                <i class="ri-calendar-line"></i>
                                                {{ $blog->created_at->format('d M Y') }}
                                            </p>

                                            <span class="hero-premium__button">
                                                Read Blog <i class="ri-arrow-right-line"></i>
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        @empty
                            <div class="hero-premium__empty">
                                <span class="hero-premium__empty-subtitle">Travel Stories Are On The Way</span>
                                <h2 class="hero-premium__empty-title">No Blog Articles Published Yet</h2>
                                <p class="hero-premium__empty-text">
                                    Our latest travel journals, destination guides, and adventure inspirations
                                    will be available here very soon. Stay tuned for beautiful stories from the road.
                                </p>
                            </div>
                        @endforelse

                    </div>

                    @if ($blogs->count() > 0)
                        <div class="swiper-button-prev hero-premium-prev">
                            <i class="ri-arrow-left-line"></i>
                        </div>
                        <div class="swiper-button-next hero-premium-next">
                            <i class="ri-arrow-right-line"></i>
                        </div>
                    @endif
                </div>
            </div>
        </section>
        <!--==================== GALLERY ====================-->
      <section class="gallery section" id="gallery">
    <h2 class="section__title">Gallery</h2>

    <div class="gallery__container container grid">

        <a href="{{ route('user.gallery.images') }}">
            <article class="gallery__card">
                <img src="assetsFE/img/gallery-img-1.png" alt="image" class="gallery__img">
                <div class="gallery__shadow"></div>

                <div class="gallery__data">
                    <h3 class="gallery__subtitle">Nusa</h3>
                    <h2 class="gallery__title">Indonesia</h2>
                </div>
            </article>
        </a>

        <a href="{{ route('user.gallery.images') }}">
            <article class="gallery__card">
                <img src="assetsFE/img/gallery-img-2.png" alt="image" class="gallery__img">
                <div class="gallery__shadow"></div>

                <div class="gallery__data">
                    <h3 class="gallery__subtitle">Cook</h3>
                    <h2 class="gallery__title">Nueva Zelanda</h2>
                </div>
            </article>
        </a>

        <a href="{{ route('user.gallery.images') }}">
            <article class="gallery__card">
                <img src="assetsFE/img/gallery-img-3.png" alt="image" class="gallery__img">
                <div class="gallery__shadow"></div>

                <div class="gallery__data">
                    <h3 class="gallery__subtitle">Bora Bora</h3>
                    <h2 class="gallery__title">Polinesia</h2>
                </div>
            </article>
        </a>

        <a href="{{ route('user.gallery.images') }}">
            <article class="gallery__card">
                <img src="assetsFE/img/gallery-img-4.png" alt="image" class="gallery__img">
                <div class="gallery__shadow"></div>

                <div class="gallery__data">
                    <h3 class="gallery__subtitle">Santorini</h3>
                    <h2 class="gallery__title">Grecia</h2>
                </div>
            </article>
        </a>

    </div>
</section>

        <!--==================== JOIN ====================-->
        <section class="join section" id="join">
            <div class="join__container container grid">
                <div class="join__data">
                    <h2 class="section__title">Your Journey <br> Starts Here</h2>
                    <p class="join__description">
                        Get up to date with the latest travel
                        and information from us.
                    </p>

                    <form action="" class="join__form">
                        <input type="email" placeholder="Enter your email" class="join__input">
                        <button class="join__button button">
                            Join our newsletter
                            <i class="ri-arrow-right-line"></i>
                        </button>
                    </form>
                </div>

                <img src="assetsFE/img/join-img.png" alt="image" class="join__img">
            </div>
        </section>
    </main>

    <!--==================== FOOTER ====================-->
    <footer class="footer">
        <div class="footer__container container grid">
            <a href="#" class="footer__logo">
                <img src="assetsFE/img/logo.svg" alt="image">
                <span>GoTravel</span>
            </a>

            <div class="footer__content grid">
                <div>
                    <h3 class="footer__title">About</h3>

                    <ul class="footer__links">
                        <li>
                            <a href="#" class="footer__link">About Us</a>
                        </li>

                        <li>
                            <a href="#" class="footer__link">Features</a>
                        </li>

                        <li>
                            <a href="#" class="footer__link">News & Blogs</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="footer__title">Contact</h3>

                    <ul class="footer__links">
                        <li>
                            <a href="#" class="footer__link">Call Center</a>
                        </li>

                        <li>
                            <a href="#" class="footer__link">Support</a>
                        </li>

                        <li>
                            <a href="#" class="footer__link">Contact Us</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="footer__title">Support</h3>

                    <ul class="footer__links">
                        <li>
                            <a href="#" class="footer__link">Privacy Policy</a>
                        </li>

                        <li>
                            <a href="#" class="footer__link">Terms & Services</a>
                        </li>

                        <li>
                            <a href="#" class="footer__link">Payments</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="footer__title">Social</h3>

                    <div class="footer__social">
                        <a href="https://www.facebook.com/" target="_blank" class="footer__social-link">
                            <i class="ri-facebook-circle-fill"></i>
                        </a>
                        <a href="https://www.instagram.com/" target="_blank" class="footer__social-link">
                            <i class="ri-instagram-fill"></i>
                        </a>
                        <a href="https://twitter.com/" target="_blank" class="footer__social-link">
                            <i class="ri-twitter-x-fill"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <span class="footer__copy">
            &#169; All Rights Reserved By Bedimcode
        </span>
    </footer>

    <!--========== SCROLL UP ==========-->
    <a href="#" class="scrollup" id="scroll-up">
        <i class="ri-arrow-up-line"></i>
    </a>

    <!--=============== SCROLLREVEAL ===============-->
    <script src="{{ asset('assetsFE/js/scrollreveal.min.js') }}"></script>

    <!--=============== SWIPER JS ===============-->
    <script src="{{ asset('assetsFE/js/swiper-bundle.min.js') }}"></script>

    <!--=============== MAIN JS ===============-->
    <script src="{{ asset('assetsFE/js/main.js') }}"></script>
</body>

</html>
