@extends('layout.dashboard')
@section('title', 'Gallery')
<style>
    .pagination .page-link {
        padding: 0.75rem 1rem;
        font-size: 1.125rem;
        border-radius: 0.5rem;
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
                <h3 class="page-title">Gallery</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-12 order-1 order-lg-2 mb-4 mb-lg-0">
                <div class="card">

                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">Data Gallery</h3>

                        <a href="{{ route('gallery.create') }}" class="btn btn-sm btn-primary">
                            <i class="ti ti-plus"></i> Tambah Gallery
                        </a>
                    </div>

                    <div class="card-datatable table-responsive table-main">
                        <table class="table border-top nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Gambar</th>
                                    <th>Video Lokal</th>
                                    <th>Video YT</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($gallery as $key => $item)
                                    <tr>
                                        <td>{{ ($gallery->currentPage() - 1) * $gallery->perPage() + $loop->index + 1 }}
                                        </td>

                                        <td>{{ $item->judul }}</td>

                                        {{-- Gambar --}}
                                        <td>
                                            @if ($item->gambar)
                                                <img src="{{ asset('storage/' . $item->gambar) }}" width="60"
                                                    class="rounded">
                                            @else
                                                <span class="text-muted">Tidak ada</span>
                                            @endif
                                        </td>

                                        {{-- Video Lokal --}}
                                        <td>
                                            @if ($item->video_local)
                                                <video width="120" controls>
                                                    <source src="{{ asset('storage/' . $item->video_local) }}">
                                                </video>
                                            @else
                                                <span class="text-muted">Tidak ada</span>
                                            @endif
                                        </td>

                                        {{-- Video YouTube --}}
                                        <td>
                                            @if ($item->video_yt)
                                                <a href="{{ $item->video_yt }}" target="_blank" class="btn btn-sm btn-info">
                                                    <i class="ti ti-brand-youtube"></i> Lihat
                                                </a>
                                            @else
                                                <span class="text-muted">Tidak ada</span>
                                            @endif
                                        </td>

                                        {{-- Status --}}
                                        <td>
                                            @if ($item->status == 1)
                                                <span class="badge bg-success">Aktif</span>
                                            @else
                                                <span class="badge bg-danger">Nonaktif</span>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{ route('gallery.edit', $item->id) }}"
                                                class="btn btn-sm btn-warning mb-1">
                                                <i class="ti ti-pencil"></i>
                                            </a>

                                            <form action="{{ route('gallery.destroy', $item->id) }}" method="POST"
                                                class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')

                                                <button type="button" class="btn btn-sm btn-danger btn-delete">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                        <div class="mt-3 px-3 d-flex justify-content-center">
                            {{ $gallery->links('pagination::bootstrap-5') }}
                        </div>




                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // =================================================
            // SWEETALERT KONFIRMASI HAPUS
            // =================================================
            document.querySelectorAll('.btn-delete').forEach(button => {
                button.addEventListener('click', function() {
                    let form = this.closest('.delete-form');

                    Swal.fire({
                        title: 'Hapus item gallery ini?',
                        text: "Data akan dihapus permanen!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            // =================================================
            // NOTIFIKASI SUCCESS
            // =================================================
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: @json(session('success')),
                    confirmButtonText: 'OK'
                });
            @endif

            // =================================================
            // NOTIFIKASI ERROR
            // =================================================
            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: @json(session('error')),
                    confirmButtonText: 'OK'
                });
            @endif

        });
    </script>
@endpush
