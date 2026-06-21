<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link rel="shortcut icon" href="{{ asset('Images/icon.png') }}" type="image/x-icon" />
    <title>Tour Package |To tired trial </title>
    <link rel="stylesheet" href="{{ asset('assetsFE/css/blog.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.7/dist/sweetalert2.all.min.js"></script>
</head>

<body>


    <nav>
        <a href="#" class="brand-logo">To Tired Trail</a>
       <ul class="links">
            <li class="link">
                <b><a href="{{ route('home') }}" >Home</a></b>
            </li>
            {{-- <li class="link"><a href="{{ route('places.page') }}">Places</a></li> --}}
            <li class="link"><a href="{{ route('allpackage.page') }}">Tour</a></li>
            <li class="link"><a href="{{ route('user.blog.index') }}">Blog</a></li>
            <li class="link"><a href="{{ route('user.gallery.images') }}">Gallery</a></li>

            <!-- 🔥 Tambahkan Login di sini -->

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
      <a href="#blog" class="scrollContainer">
    <button class="scrollButton">
        <img src="https://img.icons8.com/ios-filled/50/000000/book.png" />
        <p>Hit Me</p>
    </button>
</a>
        <div class="custom-shape-divider-bottom-1631284471">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
                preserveAspectRatio="none">
                <path
                    d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                    class="shape-fill"></path>
            </svg>
        </div>
    </section>

 @php
    // jika $tours belum ada, set collection kosong supaya foreach tidak error
    $tours = $tours ?? collect();
@endphp

<section class="blogs">
    <div class="blogsContainer">

       @foreach($tours as $tour)
    <div class="blog" id="blog-{{ $tour->id }}">
        @php
            // Pastikan images selalu array
            $images = [];
            if (!empty($tour->images)) {
                $images = is_array($tour->images) ? $tour->images : json_decode($tour->images, true);
                if (!$images) { // fallback kalau bukan JSON
                    $images = [$tour->images];
                }
            }
            $firstImage = $images[0] ?? null;
        @endphp

        @if ($firstImage)
            <img src="{{ asset('uploads/tours/' . $firstImage) }}"
                 alt="{{ $tour->title }}" class="image" />
        @else
            <img src="{{ asset('assets/no-image.jpg') }}" class="image" />
        @endif

        <div class="content">
            <div class="details">
                <h2>{{ $tour->title }}</h2>
                <p class="text">
                    {{ \Illuminate\Support\Str::limit(strip_tags($tour->description), 200) }}
                </p>
                <button class="readMoreBtn"
                        onclick="window.location.href='{{ route('tour.detail', $tour->slug) }}'">
                    Read more
                </button>
            </div>

            <div class="buttons">
                <a href="{{ route('tour.detail', $tour->slug) }}">
                    <button class="viewButton">Details Trip</button>
                </a>
            </div>
        </div>

    </div>
@endforeach


    </div>
</section>




   <footer>
    <div class="footerDetails">
        <!-- Kolom 1 -->
        <div class="footerDescription">
            <h1 class="footerTitle">to tired trail</h1>
            <p class="footerPara">
                Discover New Destinations. See breath-taking places and experience
                them from your device online.
                <br /><br />
                Our travel writing captures the one thing we always strive to create
                – incredible travel experiences. From learning about the historical
                and political context of a destination to finding some really great
                hikes, each new place has something to discover.
                <br /><br />
                We have a passion for storytelling, a knack for putting itineraries
                together and a strong desire to have fun.
            </p>
        </div>


    <!-- Kolom 2 -->
    <div class="footerContact">
        <h1 class="contactTitle">Contact Me Click The icon</h1>

        <p class="contactPara">
            If you want to make any inquiries about the website, you can contact
            me through below options
        </p>

        <div class="contactOptions">

            <!-- Instagram -->
            <a href="https://www.instagram.com/thetootiredtrail/"
               target="_blank"
               rel="noopener"
               class="contactOption">
                <abbr title="Instagram">
                    <img src="https://img.icons8.com/ios-glyphs/60/ffffff/instagram-new.png" alt="Instagram Icon">
                </abbr>
            </a>

            <!-- WhatsApp -->
            <a href="https://wa.me/628133326201"
               target="_blank"
               rel="noopener"
               class="contactOption">
                <abbr title="WhatsApp">
                    <img src="https://img.icons8.com/material-outlined/48/ffffff/whatsapp--v1.png" alt="WhatsApp Icon">
                </abbr>
            </a>

            <!-- Phone -->
            {{-- <div class="contactOption call">
                <abbr title="Call">
                    <img src="https://img.icons8.com/ios/48/ffffff/phone.png" alt="Phone Icon">
                </abbr>
            </div> --}}

            <!-- Email -->
            <a href="mailto:thetootiredtrail@gmail.com"
               class="contactOption">
                <abbr title="Email">
                    <img src="https://img.icons8.com/ios/50/ffffff/gmail-new.png" alt="Email Icon">
                </abbr>
            </a>

            <!-- TripAdvisor -->
            <a href="https://www.tripadvisor.com/AttractionProductReview-g297694-d34058934-Mount_Ijen_Blue_Fire_Tour_Start_From_Bali-Denpasar_Bali.html"
               target="_blank"
               rel="noopener"
               class="contactOption">
                <abbr title="TripAdvisor">
                    <img src="https://img.icons8.com/ios-filled/50/ffffff/tripadvisor.png" alt="TripAdvisor Icon">
                </abbr>
            </a>

        </div>

        <ul class="contactInfo">
            <li>
                <span>Instagram :</span>
                <a href="https://www.instagram.com/thetootiredtrail/"
                   target="_blank"
                   rel="noopener">
                    @thetootiredtrail
                </a>
            </li>

            <li>
                <span>Phone :</span>
                <a href="https://wa.me/628133326201"
                   target="_blank"
                   rel="noopener">
                    +62 813-3326-201
                </a>
            </li>

            <li>
                <span>Email :</span>
                <a href="mailto:thetootiredtrail@gmail.com">
                    thetootiredtrail@gmail.com
                </a>
            </li>

            <li>
                <span>TripAdvisor :</span>
                <a href="https://www.tripadvisor.com/AttractionProductReview-g297694-d34058934-Mount_Ijen_Blue_Fire_Tour_Start_From_Bali-Denpasar_Bali.html"
                   target="_blank"
                   rel="noopener">
                    View Reviews
                </a>
            </li>
        </ul>

    </div>

    <!-- Kolom 3 -->
    <div class="footerPayment">
        <h1 class="paymentTitle">Payment Method</h1>
        <div class="paymentOptions">
            <img src="/Images/paypal.png" alt="PayPal" />
            <img src="/Images/wise.png" alt="Wise" />
            <img src="/Images/bri.png" alt="BRI" />
        </div>

        <h1 class="paymentTitle">Available At</h1>
        <div class="availableOptions">
            <img src="/Images/airbnb.png" alt="Airbnb" />
            <img src="/Images/getyourguide.png" alt="GetYourGuide" />
        </div>
    </div>

    <div class="footerCopyright">
        <p>
            This website is designed and developed by
            <span>Vamos Teams</span>
        </p>
    </div>
</div>


</footer>


    <script src="{{ asset('assetsFE/JS/blog.js') }}"></script>
    <script src="https://kit.fontawesome.com/775344b04d.js" crossorigin="anonymous"></script>
</body>

</html>
