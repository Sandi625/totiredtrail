@extends('partials.header')

<section class="bookingForm"
    style="max-width:600px;
           margin:140px auto 40px auto;
           padding:25px;
           background:#fff;
           border-radius:10px;">

    <h2 style="text-align:center; color:#f2870c; margin-bottom:20px;">
        Booking: {{ $tour->title }}
    </h2>

    <form id="bookingForm">
        @csrf

        <label>Name:</label>
        <input type="text" id="name" required style="width:100%; margin-bottom:15px; padding:8px;">

        <label>Email:</label>
        <input type="email" id="email" required style="width:100%; margin-bottom:15px; padding:8px;">

        <label>Phone:</label>
        <input type="text" id="phone" required style="width:100%; margin-bottom:15px; padding:8px;">

        <label>Participants:</label>
        <input type="number" id="participants" min="1" value="1"
               required style="width:100%; margin-bottom:15px; padding:8px;">

        <label>Travel Date:</label>
        <input type="date" id="travel_date" required style="width:100%; margin-bottom:15px; padding:8px;">

        <label>Message (Optional):</label>
        <textarea id="message" rows="4" style="width:100%; margin-bottom:20px; padding:8px;"></textarea>

        <div style="text-align:center; display:flex; flex-direction:column; gap:10px;">

            <!-- WHATSAPP BUTTON -->
            <button type="submit"
                style="padding:10px 25px; background:#25D366; color:#fff;
                       border:none; border-radius:6px; cursor:pointer;">
                📝 Book via WhatsApp
            </button>

            <!-- EMAIL BUTTON -->
            <button type="button" id="emailButton"
                style="padding:10px 25px; background:#f2870c; color:#fff;
                       border:none; border-radius:6px; cursor:pointer;">
                📧 Book via Email
            </button>

        </div>
    </form>
</section>

@include('partials.footer')

<script>
document.getElementById('bookingForm').addEventListener('submit', function(e) {
    e.preventDefault();

    let name = document.getElementById('name').value.trim();
    let email = document.getElementById('email').value.trim();
    let phone = document.getElementById('phone').value.trim();
    let participants = document.getElementById('participants').value;
    let date = document.getElementById('travel_date').value;
    let message = document.getElementById('message').value.trim() || "-";

    if (!name || !email || !phone || !date) {
        alert("Please fill in all required fields.");
        return;
    }

    let waNumber = "628133088586";

    let text =
`Hello, I would like to book a tour.

Tour: {{ $tour->title }}
Name: ${name}
Email: ${email}
Phone: ${phone}
Participants: ${participants}
Travel Date: ${date}
Message: ${message}`;

    let encoded = encodeURIComponent(text);
    window.location.href = `https://wa.me/${waNumber}?text=${encoded}`;
});


// ===========================
// SEND VIA EMAIL BUTTON
// ===========================
document.getElementById('emailButton').addEventListener('click', function() {

    let name = document.getElementById('name').value.trim();
    let email = document.getElementById('email').value.trim();
    let phone = document.getElementById('phone').value.trim();
    let participants = document.getElementById('participants').value;
    let date = document.getElementById('travel_date').value;
    let message = document.getElementById('message').value.trim() || "-";

    if (!name || !email || !phone || !date) {
        alert("Please fill in all required fields before sending an email.");
        return;
    }

    let adminEmail = "vamosadventure.idn@gmail.com";

    let subject = encodeURIComponent(`Tour Booking Request: {{ $tour->title }} - ${name}`);

    let body =
`Hello Admin,

I would like to book a tour.

Tour: {{ $tour->title }}
Name: ${name}
Email: ${email}
Phone: ${phone}
Participants: ${participants}
Travel Date: ${date}
Message: ${message}

Thank you.`;

    let encodedBody = encodeURIComponent(body);

    window.location.href = `mailto:${adminEmail}?subject=${subject}&body=${encodedBody}`;
});
</script>
