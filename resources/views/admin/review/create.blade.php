@extends('layout.dashboard')

@section('title', 'Tambah Review')

@section('content')

    <div class="card mt-3">
        <div class="card-header">
            <h5 class="mb-0">Tambah Review</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('review.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- NAMA --}}
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                {{-- EMAIL --}}
                <div class="mb-3">
                    <label class="form-label">Email (Opsional)</label>
                    <input type="email" name="email" class="form-control">
                </div>

                {{-- FOTO --}}
                <div class="mb-3">
                    <label class="form-label">Foto (Opsional)</label>
                    <input type="file" name="photo[]" class="form-control" multiple>
                </div>


                {{-- RATING --}}
                <div class="mb-3">
                    <label class="form-label">Rating</label>
                    <select name="rating" class="form-control" required>
                        <option value="">-- Pilih Rating --</option>
                        <option value="1">1 - Sangat Buruk</option>
                        <option value="2">2 - Buruk</option>
                        <option value="3">3 - Cukup</option>
                        <option value="4">4 - Baik</option>
                        <option value="5">5 - Sangat Baik</option>
                    </select>
                </div>

                {{-- REVIEW TEXT --}}
                <div class="mb-3">
                    <label class="form-label">Review</label>
                    <textarea name="review_text" class="form-control" rows="5" required></textarea>
                </div>

                {{-- STATUS --}}
                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                </div>

                {{-- BUTTON --}}
                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('review.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>

@endsection
