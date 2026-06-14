{{-- <section class="anotherTour">
    <div class="container">
        <h2>Another Tour Packages</h2>

      <div class="tourCard">
    <h3>Another Tour</h3>
    <ul>
        @foreach ($allTours as $item)
            @if ($item->route_name && Route::has($item->route_name))
                <li>
                    <a href="{{ route($item->route_name) }}">
                        {{ $item->title }}
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</div>


    </div>
</section> --}}

 <section class="googleMap" style="padding: 50px 0; background: var(--bg-color);">
    <div class="container" style="max-width: 1200px; margin: auto; text-align: center;">
        <h2 style="font-size: 28px; margin-bottom: 20px; color: var(--text-color);">
            Find Us on Google Maps
        </h2>

        <div style="border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d213.06705472191862!2d114.25716774859937!3d-8.205640861862353!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd14f6d1d6614bb%3A0xf9c55b4687931297!2sIJEN%20CRATER%20TOUR%20INDONESIA!5e1!3m2!1sid!2sid!4v1781412143748!5m2!1sid!2sid"
                width="100%"
                height="450"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>

    {{-- <a href="{{ route('allpackage.page') }}" class="backButton">
        <abbr title="Back">
            <img class="buttonn" src="https://img.icons8.com/material-outlined/48/142361/back--v1.png" />
        </abbr>
    </a> --}}
</section>


<footer>
    <div class="footerDetails">

        <div class="footerDescription">
            <h1 class="footerTitle">to tired trail</h1>
            <p class="footerPara">
                Discover New Destinations. See breath-taking places and experience them from your device online.
                <br><br>
                Our travel writing captures the one thing we always strive to create – incredible travel experiences.
                <br><br>
                We have a passion for storytelling, a knack for putting itineraries
                together and a strong desire to have fun.
            </p>
        </div>

      <div class="footerContact">
    <h1 class="contactTitle">Contact Me Click The icon</h1>

    <p class="contactPara">
        If you want to make any inquiries about the website, you can contact
        me through below options
    </p>

    <div class="contactOptions">

        <!-- Instagram -->
        <a href="https://www.instagram.com/vamosadventure.idn/"
           target="_blank"
           rel="noopener"
           class="contactOption"
           aria-label="Visit our Instagram">
            <abbr title="Instagram">
                <img src="https://img.icons8.com/ios-glyphs/60/ffffff/instagram-new.png" alt="Instagram Icon">
            </abbr>
        </a>

        <!-- WhatsApp -->
        <a href="https://wa.me/628133088586"
           target="_blank"
           rel="noopener"
           class="contactOption"
           aria-label="Chat via WhatsApp">
            <abbr title="WhatsApp">
                <img src="https://img.icons8.com/material-outlined/48/ffffff/whatsapp--v1.png" alt="WhatsApp Icon">
            </abbr>
        </a>

        <!-- Phone -->
        <div class="contactOption call" aria-label="Call us">
            <abbr title="Call">
                <img src="https://img.icons8.com/ios/48/ffffff/phone.png" alt="Phone Icon">
            </abbr>
        </div>

        <!-- Email -->
        <a href="mailto:vamosadventure.idn@gmail.com"
           class="contactOption"
           aria-label="Send Email">
            <abbr title="Email">
                <img src="https://img.icons8.com/ios/50/ffffff/gmail-new.png" alt="Email Icon">
            </abbr>
        </a>

        <div class="contactOption discord"></div>
    </div>

    <!--  LIST TAMBAHAN (ICON TIDAK DISENTUH) -->
 <ul class="contactInfo">
  <li>
    <span>Instagram :</span>
    <a href="https://www.instagram.com/vamosadventure.idn/" target="_blank" rel="noopener">
      @totoriedtrail
    </a>
  </li>

  <li>
    <span>Phone :</span>
    <a href="https://wa.me/628133088586" target="_blank" rel="noopener">
      +62 813-3088-8586
    </a>
  </li>



  <li>
    <span>Email :</span>
    <a href="mailto:vamosadventure.idn@gmail.com">
      email@.com
    </a>
  </li>
</ul>



</div>

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
                <span>to tired trail</span>
            </p>
        </div>
    </div>
</footer>

    <script src="{{ asset('app.js') }}"></script>

