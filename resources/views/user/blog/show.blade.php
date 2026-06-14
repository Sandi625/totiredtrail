@include('base2.header')

<section class="blog" style="margin-top: 120px; display:flex; gap:30px;">

    {{-- Main Blog Content --}}
    <div class="blogWrapper" style="flex:3;">

        {{-- Blog Description --}}
        <p class="para one" id="para">
            {!! nl2br(e($blog->description)) !!}
        </p>

        {{-- Blog Days / Itinerary --}}
        @foreach($blog->days as $index => $day)

            <div class="para two">

                <h2>
                    {{ $index + 1 }}. {{ $day->title }}
                </h2>

                <hr />

                {!! nl2br(e($day->description)) !!}

            </div>

            {{-- Day Image --}}
            @if($day->image)

                <div class="imageContainer">

                    <img
                        src="{{ asset('uploads/blog_days/' . $day->image) }}"
                        alt="{{ $day->image_title ?? $day->title }}"
                    />

                    <div class="imgDescription">

                        <h4 class="imageTitle">
                            {{ $day->image_title ?? $day->title }}
                        </h4>

                        <p class="imageDescription">
                            {{ $day->image_description ?? \Illuminate\Support\Str::limit(strip_tags($day->description), 120) }}
                        </p>

                    </div>

                </div>

            @endif

        @endforeach

        {{-- Closing --}}
        <div class="para two">
            <hr />
            Thank you for reading!
        </div>

    </div>

    {{-- Sidebar --}}
    <div class="contentContainer">

        <p class="contentHeader">
            Other Tour Packages
        </p>

        <ol>

            @forelse ($otherTours as $item)

                <li>
                    <a href="{{ route('tour.detail', $item->slug) }}">
                        {{ $item->title }}
                    </a>
                </li>

            @empty

                <li class="text-muted">
                    Belum ada paket tour lain
                </li>

            @endforelse

        </ol>

    </div>

</section>

{{-- Another Tour Section --}}
<section class="anotherTour">

    <div class="container">

        <h2>Our Tour Packages</h2>

        <div class="tourCard">

            <h3>Tour</h3>

            <ul>

                @forelse ($otherTours as $item)

                    <li>
                        <a href="{{ route('tour.detail', $item->slug) }}">
                            {{ $item->title }}
                        </a>
                    </li>

                @empty

                    <li>
                        Belum ada paket tour lain
                    </li>

                @endforelse

            </ul>

        </div>

    </div>

</section>

@include('base2.footer')
