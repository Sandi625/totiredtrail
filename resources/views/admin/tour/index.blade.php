@extends('layout.dashboard')
@section('title', 'Tours')
<style>
    .pagination .page-link {
        padding: 0.75rem 1rem;
        /* lebih tinggi dan lebar */
        font-size: 1.125rem;
        /* sedikit lebih besar */
        border-radius: 0.5rem;
        /* tombol sedikit membulat */
    }

    .pagination .page-item.disabled .page-link {
        opacity: 0.5;
    }
</style>


@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="page-header row no-gutters py-2">
            <div class="col-12 col-sm-4 text-sm-left mb-0">
                <span class="text-uppercase page-subtitle">Data Master</span>
                <h3 class="page-title">Tours</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-12 order-1 order-lg-2 mb-4 mb-lg-0">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title mb-0">Data Tours</h3>

                        <a href="{{ route('tour.create') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus"></i>&nbsp; Tambah Tour
                        </a>
                    </div>

                    <div class="card-datatable table-responsive table-main">
                        <table class="table border-top nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Slug</th>
                                    <th>Route Name</th>
                                    <th>Harga</th>
                                    <th>Gambar</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tours as $key => $tour)
                                    <tr>
                                        <td>{{ $tours->firstItem() + $key }}</td> <!-- ⬅️ nomor urut per halaman -->
                                        <td>{{ $tour->title }}</td>

                                        {{-- Kategori --}}
                                        <td>{{ $tour->category ? $tour->category->name : '-' }}</td>

                                        <td>{{ $tour->slug }}</td>
                                        <td>{{ $tour->route_name ?? '-' }}</td>
                                        <td>Rp {{ number_format($tour->price, 0, ',', '.') }}</td>

                                       <td>
    @php
        $images = is_array($tour->images) ? $tour->images : json_decode($tour->images, true);
    @endphp

    @if (!empty($images))
        @foreach ($images as $img)
            @php $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION)); @endphp
            @if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp']))
                <img src="{{ asset('uploads/tours/' . $img) }}" width="60" class="rounded mb-1 me-1">
            @elseif(in_array($ext, ['heic', 'heif']))
                <span class="badge bg-secondary mb-1 me-1">{{ strtoupper($ext) }}</span>
            @endif
        @endforeach
    @else
        <span class="text-muted">Tidak ada</span>
    @endif
</td>


                                        <td>
                                            @if ($tour->status)
                                                <span class="badge bg-success">Aktif</span>
                                            @else
                                                <span class="badge bg-danger">Nonaktif</span>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{ route('tour.show', $tour->id) }}" class="btn btn-sm btn-info mb-1">
                                                <i class="ti ti-eye"></i>
                                            </a>

                                            <a href="{{ route('tour.edit', $tour->id) }}"
                                                class="btn btn-sm btn-warning mb-1">
                                                <i class="ti ti-pencil"></i>
                                            </a>

                                            <form action="{{ route('tour.destroy', $tour->id) }}" method="POST"
                                                class="d-inline" id="delete-form-{{ $tour->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger mb-1 btnDelete"
                                                    data-id="{{ $tour->id }}">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>


                        </table>
                        {{-- Pagination --}}
                        {{-- Pagination --}}
                        <div class="mt-3 px-3 d-flex justify-content-center">
                            {{ $tours->links('pagination::bootstrap-5') }}
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection

@push('scripts')
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: @json(session('success')),
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: @json(session('error')),
                confirmButtonText: 'OK'
            });
        </script>
    @endif


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.btnDelete');

            deleteButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    let id = this.getAttribute('data-id');

                    Swal.fire({
                        title: "Hapus Tour?",
                        text: "Tour yang sudah dihapus tidak dapat dikembalikan!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Ya, Hapus",
                        cancelButtonText: "Batal"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('delete-form-' + id).submit();
                        }
                    });
                });
            });
        });
    </script>
@endpush
