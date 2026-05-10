@include('base.header')

<section class="blogs">
  <div class="blogsContainer">
    @foreach($blogs as $blog)
      <div class="blog">
        <img
          src="{{ asset('uploads/blogs/' . $blog->image) }}"
          alt="{{ $blog->title }}"
          class="image"
        />
        <div class="content">
          <div class="details">
            <h2>{{ $blog->title }}</h2>
            {{-- Ambil description dari kolom database --}}
            <p>{{ Str::limit(strip_tags($blog->description), 300) }}</p>
          </div>
        <div class="buttons">
    <a href="{{ route('user.blog.show', $blog->slug) }}">
        <button class="viewButton">Read</button>
    </a>
<p class="date">
  {{ $blog->created_at->format('d M Y') }}
</p>
</div>

        </div>
      </div>
    @endforeach
  </div>

  <!-- SVG Shape bawah -->
  <div class="custom-shape-divider-bottom-1631607238">
    <svg
      data-name="Layer 1"
      xmlns="http://www.w3.org/2000/svg"
      viewBox="0 0 1200 120"
      preserveAspectRatio="none"
    >
      <path
        d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z"
        class="shape-fill"
      ></path>
    </svg>
  </div>
</section>

@include('base.footer')
