@extends('layout.dashboard')

@section('title', 'Tambah Blog')

@section('content')
<div class="card mt-3">
    <div class="card-header">
        <h5 class="mb-0">Tambah Blog</h5>
    </div>

    <div class="card-body">
        <form id="blogForm" action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- JUDUL BLOG --}}
            <div class="mb-3">
                <label class="form-label">Judul Blog</label>
                <input type="text" name="title" class="form-control" id="titleInput" required>
            </div>

            {{-- SLUG --}}
            <div class="mb-3">
                <label class="form-label">Slug (otomatis)</label>
                <input type="text" name="slug" class="form-control" id="slugInput" readonly>
            </div>
<div class="mb-3">
    <label class="form-label">Route Name (Otomatis)</label>
    <input type="text" class="form-control" id="routeNameInputDisplay" readonly>
    <input type="hidden" name="route_name" id="routeNameInput">
</div>

            {{-- GAMBAR --}}
            <div class="mb-3">
                <label class="form-label">Gambar</label>
                <input type="file" name="image" class="form-control">
            </div>

            {{-- DESKRIPSI --}}
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" rows="5" placeholder="Isi konten blog..." required></textarea>
            </div>

            {{-- ITINERARY / HARI --}}
            <div class="mb-3">
                <label class="form-label">Itinerary / Hari</label>
                <div id="blog-days-container">
                    <div class="blog-day mb-3 p-3 border rounded border-success bg-light">
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
                    <option value="1" selected>Aktif</option>
                    <option value="0">Tidak Aktif</option>
                </select>
            </div>

            {{-- BUTTON --}}
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('blogs.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {

    // ========== AUTO SLUG & AUTO ROUTE NAME ==========
    const titleInput = document.getElementById("titleInput");
    const slugInput = document.getElementById("slugInput");
    const routeNameInput = document.getElementById("routeNameInput");       // hidden
    const routeNameDisplay = document.getElementById("routeNameInputDisplay"); // optional visible

    titleInput.addEventListener("keyup", function () {
        let slug = this.value.toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/(^-|-$)+/g, '');
        slugInput.value = slug;

        // otomatis route_name seperti slug
        let routeName = "blog." + slug;
        routeNameInput.value = routeName;
        if(routeNameDisplay) routeNameDisplay.value = routeName;
    });

    // ========== ITINERARY DINAMIS ==========
    let container = document.getElementById("blog-days-container");
    let addBtn = document.getElementById("add-day-btn");
    let dayIndex = 1;

    // Tambah Hari Baru
    addBtn.addEventListener("click", function() {
        let html = `
        <div class="blog-day mb-3 p-3 border rounded border-success bg-light">
            <label>Judul Hari</label>
            <input type="text" name="days[${dayIndex}][title]" class="form-control mb-2" placeholder="Day ${dayIndex + 1} Title">

            <label>Deskripsi Hari</label>
            <textarea name="days[${dayIndex}][description]" class="form-control mb-2" rows="3" placeholder="Deskripsi Day ${dayIndex + 1}"></textarea>

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

    // Hapus Hari
    container.addEventListener("click", function(e) {
        if (e.target && e.target.classList.contains("remove-day-btn")) {
            e.target.closest(".blog-day").remove();
        }
    });

    // ========== AJAX SUBMIT ==========
    const form = document.getElementById('blogForm');
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // reset border merah
        form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));

        let formData = new FormData(this);

        fetch("{{ route('blogs.store') }}", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.errors) {
                let errorMessages = "";
                for (const key in data.errors) {
                    data.errors[key].forEach(msg => {
                        errorMessages += `• ${msg}\n`;
                        const input = form.querySelector(`[name="${key}"]`);
                        if (input) input.classList.add('is-invalid');
                    });
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan!',
                    html: `<pre style="text-align:left;">${errorMessages}</pre>`
                });
            } else if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.success,
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = "{{ route('blogs.index') }}";
                });
            }
        })
        .catch(err => {
            console.error(err);
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Terjadi kesalahan pada server. Cek console untuk detail.'
            });
        });
    });

});
</script>
@endpush

