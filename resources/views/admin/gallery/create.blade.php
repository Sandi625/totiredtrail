@extends('layout.dashboard')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Tambah Data Gallery</h4>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Judul --}}
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                           value="{{ old('judul') }}">
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"
                              rows="3">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Gambar --}}
                <div class="mb-3">
                    <label class="form-label">Gambar (Opsional)</label>
                    <input type="file" name="gambar" id="gambarInput"
                           class="form-control @error('gambar') is-invalid @enderror" accept="image/*">

                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    {{-- Preview Gambar --}}
                    <div class="mt-2">
                        <img id="previewGambar" src="#" style="display:none; max-width: 200px;" class="img-thumbnail">
                    </div>
                </div>

                {{-- Video Lokal --}}
                <div class="mb-3">
                    <label class="form-label">Video Lokal (Opsional)</label>
                    <input type="file" name="video_local"
                           class="form-control @error('video_local') is-invalid @enderror"
                           accept="video/mp4,video/mov,video/avi,video/mkv">

                    @error('video_local')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Video YouTube --}}
                <div class="mb-3">
                    <label class="form-label">URL YouTube (Opsional)</label>
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
                        <option value="1" selected>Aktif</option>
                        <option value="0">Non Aktif</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <hr>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('gallery.index') }}" class="btn btn-secondary">Kembali</a>

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
