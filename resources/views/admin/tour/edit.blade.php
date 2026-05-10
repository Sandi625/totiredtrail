@extends('layout.dashboard')

@section('title', 'Edit Tour')

@section('content')

<div class="card mt-3">
    <div class="card-header">
        <h5 class="mb-0">Edit Tour</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('tour.update', $tour->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- KATEGORI --}}
            <div class="mb-3">
                <label class="form-label">Kategori Tour</label>
                <select name="category_id" class="form-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $tour->category_id == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- JUDUL TOUR --}}
            <div class="mb-3">
                <label class="form-label">Judul Tour</label>
                <input type="text" name="title" class="form-control" id="titleInput"
                    value="{{ old('title', $tour->title) }}" required>
            </div>

            {{-- SLUG --}}
            <div class="mb-3">
                <label class="form-label">Slug</label>
                <input type="text" name="slug" class="form-control" id="slugInput"
                    value="{{ old('slug', $tour->slug) }}" readonly>
            </div>

            {{-- ROUTE NAME --}}
            <div class="mb-3">
                <label class="form-label">Route Name</label>
                <input type="text" name="route_name" class="form-control" id="routeNameInput"
                       value="{{ old('route_name', $tour->route_name) }}">
            </div>

            {{-- HARGA --}}
            <div class="mb-3">
                <label class="form-label">Harga Tour</label>
                <input type="number" name="price" class="form-control" value="{{ old('price', $tour->price) }}" required>
            </div>

            {{-- GAMBAR SAAT INI --}}
            <div class="mb-3">
                <label class="form-label">Gambar Saat Ini</label><br>
                @php
                    $images = is_array($tour->images) ? $tour->images : json_decode($tour->images, true);
                @endphp
                @if ($images && count($images) > 0)
                    <div class="d-flex flex-wrap gap-2">
                        @foreach ($images as $img)
                            @php $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION)); @endphp
                            @if (in_array($ext, ['jpg','jpeg','png','webp']))
                                <img src="{{ asset('uploads/tours/' . $img) }}" width="120" class="rounded border mb-2">
                            @elseif(in_array($ext, ['heic','heif']))
                                <span class="badge bg-secondary mb-2 me-2">{{ strtoupper($ext) }}</span>
                            @endif
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">Belum ada gambar</p>
                @endif
            </div>

            {{-- TAMBAH GAMBAR BARU --}}
            <div class="mb-3">
                <label class="form-label">Tambah Gambar Baru (Multiple)</label>
                <input type="file" name="images[]" class="form-control" multiple>
            </div>

            {{-- ITINERARY / HARI --}}
            <div class="mb-3">
                <label class="form-label">Itinerary / Hari</label>
                <div id="tour-days-container">
                    @php
                        $days = $tour->days()->orderBy('order')->get();
                    @endphp
                    @if ($days->count() > 0)
                        @foreach ($days as $index => $day)
                            <div class="tour-day mb-3 p-2 border rounded" data-day-id="{{ $day->id }}">
                                <input type="hidden" name="days[{{ $index }}][id]" value="{{ $day->id }}">
                                <input type="hidden" name="days[{{ $index }}][_destroy]" value="0">

                                <label>Judul Hari</label>
                                <input type="text" name="days[{{ $index }}][title]" class="form-control mb-2"
                                       value="{{ old("days.$index.title", $day->title) }}" required>

                                <label>Deskripsi Hari</label>
                                <textarea name="days[{{ $index }}][description]" class="form-control" rows="3" required>{{ old("days.$index.description", $day->description) }}</textarea>

                                <label>Gambar Hari</label>
                                <input type="file" name="days[{{ $index }}][image]" class="form-control mb-2">
                                @if ($day->image)
                                    <img src="{{ asset('uploads/tour_days/' . $day->image) }}" width="120" class="rounded border mb-2">
                                @endif

                                <label>Judul Gambar</label>
                                <input type="text" name="days[{{ $index }}][image_title]" class="form-control mb-2"
                                       value="{{ old("days.$index.image_title", $day->image_title) }}">

                                <label>Deskripsi Gambar</label>
                                <textarea name="days[{{ $index }}][image_description]" class="form-control mb-2" rows="2">{{ old("days.$index.image_description", $day->image_description) }}</textarea>

                                <button type="button" class="btn btn-sm btn-danger mt-2 remove-day-btn">Hapus Hari</button>
                            </div>
                        @endforeach
                    @else
                        <div class="tour-day mb-3 p-2 border rounded">
                            <label>Judul Hari</label>
                            <input type="text" name="days[0][title]" class="form-control mb-2" placeholder="Day 1 Title" required>
                            <label>Deskripsi Hari</label>
                            <textarea name="days[0][description]" class="form-control" rows="3" placeholder="Deskripsi Day 1" required></textarea>
                            <button type="button" class="btn btn-sm btn-danger mt-2 remove-day-btn">Hapus Hari</button>
                        </div>
                    @endif
                </div>
                <button type="button" id="add-day-btn" class="btn btn-sm btn-secondary mt-2">Tambah Hari</button>
            </div>

            {{-- STATUS --}}
            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="1" {{ $tour->status == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ $tour->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>

            {{-- BUTTON --}}
            <button class="btn btn-primary">Update</button>
            <a href="{{ route('tour.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {

    // AUTO SLUG + AUTO ROUTE NAME
    const titleInput = document.getElementById("titleInput");
    const slugInput = document.getElementById("slugInput");
    const routeNameInput = document.getElementById("routeNameInput");

    titleInput.addEventListener("keyup", function () {
        let slug = this.value.toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/(^-|-$)+/g, '');
        slugInput.value = slug;
        routeNameInput.value = "tour." + slug;
    });

    // DINAMIS HARI (ITINERARY)
    let dayIndex = document.querySelectorAll('.tour-day').length;
    const container = document.getElementById("tour-days-container");
    const addBtn = document.getElementById("add-day-btn");

    addBtn.addEventListener("click", function () {
        const html = `
        <div class="tour-day mb-3 p-2 border rounded">
            <label>Judul Hari</label>
            <input type="text" name="days[${dayIndex}][title]" class="form-control mb-2" placeholder="Day ${dayIndex + 1} Title" required>
            <label>Deskripsi Hari</label>
            <textarea name="days[${dayIndex}][description]" class="form-control" rows="3" placeholder="Deskripsi Day ${dayIndex + 1}" required></textarea>
            <label>Gambar Hari</label>
            <input type="file" name="days[${dayIndex}][image]" class="form-control mb-2">
            <label>Judul Gambar</label>
            <input type="text" name="days[${dayIndex}][image_title]" class="form-control mb-2">
            <label>Deskripsi Gambar</label>
            <textarea name="days[${dayIndex}][image_description]" class="form-control mb-2" rows="2"></textarea>
            <button type="button" class="btn btn-sm btn-danger mt-2 remove-day-btn">Hapus Hari</button>
        </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        dayIndex++;
    });

    container.addEventListener("click", function (e) {
        if (e.target && e.target.classList.contains("remove-day-btn")) {
            let dayBox = e.target.closest('.tour-day');
            Swal.fire({
                title: 'Yakin ingin menghapus hari ini?',
                text: "Data hari akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    if (dayBox.dataset.dayId) {
                        let destroyInput = document.createElement('input');
                        destroyInput.type = 'hidden';
                        destroyInput.name = `days[${dayBox.dataset.dayId}][_destroy]`;
                        destroyInput.value = 1;
                        dayBox.appendChild(destroyInput);
                        dayBox.style.display = 'none';
                    } else {
                        dayBox.remove();
                    }
                    Swal.fire('Terhapus!', 'Hari berhasil dihapus.', 'success');
                }
            });
        }
    });

});
</script>

@if ($errors->any())
<script>
    let errorMessages = "";
    @foreach ($errors->all() as $error)
        errorMessages += "{{ $error }}\n";
    @endforeach
    Swal.fire({
        icon: 'error',
        title: 'Terjadi Kesalahan!',
        html: errorMessages.replace(/\n/g, "<br>"),
        confirmButtonText: 'OK'
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: "{{ session('error') }}",
        confirmButtonText: 'OK'
    });
</script>
@endif

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        confirmButtonText: 'OK'
    });
</script>
@endif
@endpush
