@extends('layout.dashboard')

@section('title', 'Edit Review')

@section('content')

    <div class="card mt-3">
        <div class="card-header">
            <h5 class="mb-0">Edit Review</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('review.update', $review->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- NAMA --}}
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control" value="{{ $review->name }}" required>
                </div>

                {{-- EMAIL --}}
                <div class="mb-3">
                    <label class="form-label">Email (Opsional)</label>
                    <input type="email" name="email" class="form-control" value="{{ $review->email }}">
                </div>

                {{-- FOTO LAMA --}}
                <div class="mb-3">
                    <label class="form-label">Foto Saat Ini</label><br>
                    @php
                        $photos = [];
                        if ($review->photo) {
                            $decoded = json_decode($review->photo);
                            if (is_array($decoded)) {
                                $photos = $decoded;
                            } else {
                                $photos = [$review->photo];
                            }
                        }
                    @endphp

                    @if (count($photos))
                        <div class="d-flex flex-wrap gap-2">
                            @foreach ($photos as $index => $photo)
                                <div style="position:relative;">
                                    <img src="{{ asset('uploads/reviews/' . $photo) }}" width="120" class="rounded mb-2">
                                    <label
                                        style="position:absolute; top:0; right:0; cursor:pointer; background:red; color:white; padding:0 5px; border-radius:50%;">
                                        <input type="checkbox" name="delete_photos[]" value="{{ $photo }}"
                                            style="display:none;">

                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <small class="text-muted">Centang × untuk menghapus foto lama</small>
                    @else
                        <p class="text-muted">Tidak ada foto</p>
                    @endif
                </div>

                {{-- UPLOAD FOTO BARU --}}
                <div class="mb-3">
                    <label class="form-label">Tambah Foto Baru (Opsional)</label>
                    <input type="file" name="photo[]" class="form-control" multiple>
                </div>

                {{-- RATING --}}
                <div class="mb-3">
                    <label class="form-label">Rating</label>
                    <select name="rating" class="form-control" required>
                        <option value="1" {{ $review->rating == 1 ? 'selected' : '' }}>1 - Sangat Buruk</option>
                        <option value="2" {{ $review->rating == 2 ? 'selected' : '' }}>2 - Buruk</option>
                        <option value="3" {{ $review->rating == 3 ? 'selected' : '' }}>3 - Cukup</option>
                        <option value="4" {{ $review->rating == 4 ? 'selected' : '' }}>4 - Baik</option>
                        <option value="5" {{ $review->rating == 5 ? 'selected' : '' }}>5 - Sangat Baik</option>
                    </select>
                </div>

                {{-- REVIEW TEXT --}}
                <div class="mb-3">
                    <label class="form-label">Review</label>
                    <textarea name="review_text" class="form-control" rows="5" required>{{ $review->review_text }}</textarea>
                </div>

                {{-- STATUS --}}
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="1" {{ $review->status == 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ $review->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>

                {{-- BUTTON --}}
                <button class="btn btn-primary">Update</button>
                <a href="{{ route('review.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>

@endsection
