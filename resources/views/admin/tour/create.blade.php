@extends('layout.dashboard')

@section('title', 'Tambah Tour')

@section('content')

    <div class="card mt-3">
        <div class="card-header">
            <h5 class="mb-0">Tambah Tour</h5>
        </div>

        <div class="card-body">
            <form id="tourForm" action="{{ route('tour.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @csrf

                {{-- KATEGORI --}}
                <div class="mb-3">
                    <label class="form-label">Kategori Tour</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- JUDUL TOUR --}}
                <div class="mb-3">
                    <label class="form-label">Judul Tour</label>
                    <input type="text" name="title" class="form-control" id="titleInput" required>
                </div>

                {{-- SLUG --}}
                <div class="mb-3">
                    <label class="form-label">Slug (otomatis)</label>
                    <input type="text" name="slug" class="form-control" id="slugInput" readonly>
                </div>

               {{-- ROUTE NAME --}}
            <div class="mb-3">
                <label class="form-label">Route Name (otomatis dari judul — bisa diubah)</label>
                <input type="text" name="route_name" class="form-control" id="routeNameInput">
            </div>

                {{-- HARGA --}}
                <div class="mb-3">
                    <label class="form-label">Harga Tour</label>
                    <input type="number" name="price" class="form-control" required>
                </div>

                {{-- MULTIPLE IMAGE --}}
                <div class="mb-3">
                    <label class="form-label">Gambar (Multiple)</label>
                    <input type="file" name="images[]" class="form-control" multiple>
                </div>

             <div class="mb-3">
    <label class="form-label">Itinerary / Hari</label>
    <div id="tour-days-container">
        <div class="tour-day mb-3 p-3 border rounded border-success bg-light">
            <label>Judul Hari</label>
            <input type="text" name="days[0][title]" class="form-control mb-2" placeholder="Day 1 Title">

            <label>Deskripsi Hari</label>
            <textarea name="days[0][description]" class="form-control mb-2" rows="3" placeholder="Deskripsi Day 1"></textarea>

            <label>Gambar Hari</label>
            <input type="file" name="days[0][image]" class="form-control mb-2">

            <label>Judul Gambar</label>
            <input type="text" name="days[0][image_title]" class="form-control mb-2" placeholder="Judul Gambar Day 1">

            <label>Deskripsi Gambar</label>
            <textarea name="days[0][image_description]" class="form-control mb-2" rows="2" placeholder="Deskripsi Gambar Day 1"></textarea>

            <button type="button" class="btn btn-sm btn-danger mt-2 remove-day-btn">Hapus Hari</button>
        </div>
    </div>
    <button type="button" id="add-day-btn" class="btn btn-sm btn-success mt-2">Tambah Hari</button>
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
                <a href="{{ route('tour.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    // ======================================================
    // AUTO SLUG & AUTO ROUTE NAME
    // ======================================================
    const titleInput = document.getElementById("titleInput");
    const slugInput = document.getElementById("slugInput");
    const routeNameInput = document.getElementById("routeNameInput");

    let routeNameEdited = false; // agar auto tidak menimpa edit manual

    // Jika user mengetik manual route_name -> jangan auto overwrite lagi
    routeNameInput.addEventListener("input", function () {
        if (this.value.trim() !== "") {
            routeNameEdited = true;
        }
    });

    // Auto generate ketika title diketik
    titleInput.addEventListener("keyup", function() {
        let slug = this.value.toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/(^-|-$)+/g, '');

        slugInput.value = slug;

        // Auto route_name jika belum pernah diedit manual
        if (!routeNameEdited) {
            let autoRoute = this.value.toLowerCase()
                .replace(/[^a-z0-9]+/g, '_') // underscore untuk route name
                .replace(/(^_|_$)+/g, '');

            routeNameInput.value = autoRoute;
        }
    });


    // ======================================================
    // ITINERARY / HARI DINAMIS
    // ======================================================
    let container = document.getElementById("tour-days-container");
    let addBtn = document.getElementById("add-day-btn");
    let dayIndex = 1;

    addBtn.addEventListener("click", function() {
        let html = `
        <div class="tour-day mb-3 p-3 border rounded border-success bg-light">
            <label>Judul Hari</label>
            <input type="text" name="days[${dayIndex}][title]"
                class="form-control mb-2" placeholder="Day ${dayIndex + 1} Title" required>

            <label>Deskripsi Hari</label>
            <textarea name="days[${dayIndex}][description]"
                class="form-control mb-2" rows="3"
                placeholder="Deskripsi Day ${dayIndex + 1}" required></textarea>

            <label>Gambar Hari</label>
            <input type="file" name="days[${dayIndex}][image]" class="form-control mb-2">

            <label>Judul Gambar</label>
            <input type="text" name="days[${dayIndex}][image_title]" class="form-control mb-2" placeholder="Judul Gambar Day ${dayIndex + 1}">

            <label>Deskripsi Gambar</label>
            <textarea name="days[${dayIndex}][image_description]" class="form-control mb-2" rows="2" placeholder="Deskripsi Gambar Day ${dayIndex + 1}"></textarea>

            <button type="button" class="btn btn-sm btn-danger mt-2 remove-day-btn">Hapus Hari</button>
        </div>`;
        container.insertAdjacentHTML('beforeend', html);
        dayIndex++;
    });

    container.addEventListener("click", function(e) {
        if (e.target && e.target.classList.contains("remove-day-btn")) {
            e.target.closest(".tour-day").remove();
        }
    });


    // ======================================================
    // AJAX SUBMIT WITH SWEETALERT (CREATE TOUR)
    // ======================================================
    const form = document.getElementById("tourForm");

    form.addEventListener("submit", function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        fetch("{{ route('tour.store') }}", {
            method: "POST",
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.errors) {
                let errorHtml = '';
                Object.values(data.errors).forEach(errArr => {
                    errArr.forEach(err => {
                        errorHtml += `• ${err}<br>`;
                    });
                });

                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Menyimpan!',
                    html: errorHtml
                });
                return;
            }

            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Tour berhasil ditambahkan'
            }).then(() => {
                window.location.href = "{{ route('tour.index') }}";
            });
        })
        .catch(() => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Terjadi kesalahan!'
            });
        });
    });

});
</script>
@endpush


