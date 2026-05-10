@extends('layout.dashboard')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Edit Data Gallery</h4>
        <a href="{{ route('gallery.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Judul --}}
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="judul"
                           class="form-control @error('judul') is-invalid @enderror"
                           value="{{ old('judul', $gallery->judul) }}">
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"
                              rows="3">{{ old('deskripsi', $gallery->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Gambar Lama --}}
                <div class="mb-3">
                    <label class="form-label">Gambar Saat Ini</label><br>
                    @if ($gallery->gambar)
                        <img src="{{ asset('storage/'.$gallery->gambar) }}" width="180" class="img-thumbnail mb-2">
                    @else
                        <p class="text-muted">Belum ada gambar</p>
                    @endif
                </div>

                {{-- Upload Gambar Baru --}}
                <div class="mb-3">
                    <label class="form-label">Gambar Baru (opsional)</label>
                    <input type="file" name="gambar" id="gambarInput"
                           class="form-control @error('gambar') is-invalid @enderror"
                           accept="image/*">

                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    {{-- Preview --}}
                    <img id="previewGambar" src="#" style="display:none; max-width: 200px;"
                         class="img-thumbnail mt-2">
                </div>

                {{-- Video Lama --}}
                <div class="mb-3">
                    <label class="form-label">Video Saat Ini</label><br>

                    @php
                        $isYoutube = $gallery->video_yt !== null;
                    @endphp

                    @if ($gallery->video_local)
                        <video width="300" controls>
                            <source src="{{ asset('storage/'.$gallery->video_local) }}">
                        </video>
                    @elseif ($gallery->video_yt)
                        @php
                            // Extract YouTube ID
                            $ytID = null;
                            if (str_contains($gallery->video_yt, 'v=')) {
                                $ytID = \Str::after($gallery->video_yt, 'v=');
                            } elseif (str_contains($gallery->video_yt, 'youtu.be/')) {
                                $ytID = \Str::after($gallery->video_yt, 'youtu.be/');
                            }
                        @endphp

                        @if ($ytID)
                            <iframe width="280" height="160"
                                    src="https://www.youtube.com/embed/{{ $ytID }}"
                                    frameborder="0" allowfullscreen></iframe>
                        @endif
                    @else
                        <p class="text-muted">Belum ada video</p>
                    @endif
                </div>

                {{-- Upload Video Lokal Baru --}}
                <div class="mb-3">
                    <label class="form-label">Video Lokal Baru (opsional)</label>
                    <input type="file" name="video_local"
                           class="form-control @error('video_local') is-invalid @enderror"
                           accept="video/mp4,video/mov,video/avi,video/mkv">

                    @error('video_local')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- URL YouTube Baru --}}
                <div class="mb-3">
                    <label class="form-label">URL YouTube Baru (opsional)</label>
                    <input type="text" name="video_yt"
                           class="form-control @error('video_yt') is-invalid @enderror"
                           placeholder="https://www.youtube.com/watch?v=xxxxxx"
                           value="{{ old('video_yt') }}">

                    @error('video_yt')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror">
                        <option value="1" {{ $gallery->status == 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ $gallery->status == 0 ? 'selected' : '' }}>Non Aktif</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <hr>

                <button type="submit" class="btn btn-primary">Update</button>

            </form>

        </div>
    </div>

</div>

{{-- Script Preview Gambar --}}
<script>
    document.getElementById('gambarInput').addEventListener('change', function(event) {
        let reader = new FileReader();
        reader.onload = function(){
            let output = document.getElementById('previewGambar');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    });
</script>

@endsection
