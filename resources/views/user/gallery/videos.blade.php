@include('base4.header')

<div id="gallery" class="container-fluid">

    @forelse ($videos as $item)

        <div class="image">

            {{-- Video Lokal --}}
            @if ($item->video_local)
                <video class="img-responsive" controls>
                    <source src="{{ asset('storage/' . $item->video_local) }}">
                    Browser Anda tidak mendukung video.
                </video>
            @endif

            {{-- Video YouTube --}}
            @if ($item->video_yt)
                @php
                    $url = $item->video_yt;
                    $ytId = null;

                    if (str_contains($url, 'v=')) {
                        $ytId = \Str::after($url, 'v=');
                        if (str_contains($ytId, '&')) {
                            $ytId = \Str::before($ytId, '&');
                        }
                    } elseif (str_contains($url, 'youtu.be/')) {
                        $ytId = \Str::after($url, 'youtu.be/');
                        if (str_contains($ytId, '?')) {
                            $ytId = \Str::before($ytId, '?');
                        }
                    }
                @endphp

                @if ($ytId)
                    <iframe
                        src="https://www.youtube.com/embed/{{ $ytId }}"
                        class="img-responsive"
                        frameborder="0"
                        allowfullscreen>
                    </iframe>
                @else
                    <p class="text-muted">URL YouTube tidak valid.</p>
                @endif
            @endif

            {{-- <div class="details">
                {{ $item->judul }}
            </div> --}}

        </div>

    @empty
        <p class="text-center py-5">Belum ada video.</p>
    @endforelse


    {{-- SHAPE DIVIDER --}}
    <div class="custom-shape-divider-bottom-1631607238">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path
                d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39
                   -57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8
                   C1132.19,118.92,1055.71,111.31,985.66,92.83Z"
                class="shape-fill"></path>
        </svg>
    </div>

</div>

@include('base4.footer')
