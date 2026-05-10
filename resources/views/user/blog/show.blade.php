@include('base2.header')

<section class="blog" style="margin-top: 120px; display:flex; gap:30px;">

    {{-- Main Blog Content --}}
    <div class="blogWrapper" style="flex:3;">

        {{-- Blog description --}}
        <p class="para one" id="para">
          {!! nl2br(e($blog->description)) !!}
        </p>

        {{-- Loop each child day / itinerary --}}
        @foreach($blog->days as $index => $day)
            {{-- Day Title & Description --}}
            <div class="para two">
                <h2>{{ $index + 1 }}. {{ $day->title }}</h2>
                <hr />
                {!! nl2br(e($day->description)) !!}
            </div>

            {{-- Day Image --}}
            @if($day->image)
            <div class="imageContainer">
                <img src="{{ asset('uploads/blog_days/' . $day->image) }}" alt="{{ $day->image_title ?? $day->title }}" />
                <div class="imgDescription">
                    <h4 class="imageTitle">{{ $day->image_title ?? $day->title }}</h4>
                    <p class="imageDescription">{{ $day->image_description ?? Str::limit(strip_tags($day->description), 120) }}</p>
                </div>
            </div>
            @endif
        @endforeach

        {{-- Closing thank you section --}}
        <div class="para two">
            <hr />
            Thank you for reading!
        </div>
    </div>
 <div class="contentContainer">
        <p class="contentHeader">Other Tour Packages</p>
        <ol>
            @forelse ($allTours ?? [] as $item)
                <li>
                    <a href="{{ route('tour.detail', $item->slug) }}">
                        {{ $item->title }}
                    </a>
                </li>
            @empty
                <li class="text-muted">Belum ada paket tour lain</li>
            @endforelse
        </ol>
    </div>


</section>

<section class="anotherTour">
    <div class="container">
        <h2>Our Tour Packages</h2>

      <div class="tourCard">
    <h3> Tour</h3>
    {{-- <ul>
        @foreach ($allTours as $item)
            @if ($item->route_name && Route::has($item->route_name))
                <li>
                    <a href="{{ route($item->route_name) }}">
                        {{ $item->title }}
                    </a>
                </li>
            @endif
        @endforeach
    </ul> --}}
</div>


    </div>
</section>

@include('base2.footer')
