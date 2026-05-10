@extends('layout.dashboard')
@section('title', 'Blog')
<style>
    .pagination .page-link {
        padding: 0.75rem 1rem;
        /* tinggi & lebar tombol */
        font-size: 1.125rem;
        /* font lebih jelas */
        border-radius: 0.5rem;
        /* tombol membulat */
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
                <h3 class="page-title">Blog</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-12 order-1 order-lg-2 mb-4 mb-lg-0">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">Data Blog</h3>

                        <a href="{{ route('blogs.create') }}" class="btn btn-sm btn-primary">
                            <i class="ti ti-plus"></i> Tambah Blog
                        </a>
                    </div>

                    <div class="card-datatable table-responsive table-main">
                        <table class="table border-top nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Slug</th>
                                    <th>Route</th>
                                    <th>Gambar</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($blogs as $key => $blog)
                                    <tr>
                                        <td>{{ ($blogs->currentPage() - 1) * $blogs->perPage() + $key + 1 }}</td>
                                        <td>{{ $blog->title }}</td>
                                        <td>{{ $blog->slug }}</td>
                                        <td>{{ $blog->route_name }}</td>

                                        <td>
                                            @if ($blog->image)
                                                <img src="{{ asset('uploads/blogs/' . $blog->image) }}" width="60"
                                                    class="rounded">
                                            @else
                                                <span class="text-muted">Tidak ada</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($blog->status)
                                                <span class="badge bg-success">Aktif</span>
                                            @else
                                                <span class="badge bg-danger">Nonaktif</span>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-sm btn-info mb-1">
                                                <i class="ti ti-eye"></i>
                                            </a>

                                            <a href="{{ route('blogs.edit', $blog->id) }}"
                                                class="btn btn-sm btn-warning mb-1">
                                                <i class="ti ti-pencil"></i>
                                            </a>

                                            <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST"
                                                class="d-inline" id="delete-form-{{ $blog->id }}">

                                                @csrf
                                                @method('DELETE')

                                                <button type="button" class="btn btn-sm btn-danger mb-1 btnDeleteBlog"
                                                    data-id="{{ $blog->id }}">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </form>

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                        <div class="mt-3 px-3 d-flex justify-content-center">
                            {{ $blogs->links('pagination::bootstrap-5') }}
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
            const deleteButtons = document.querySelectorAll('.btnDeleteBlog');

            deleteButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    let id = this.getAttribute('data-id');

                    Swal.fire({
                        title: "Hapus Blog?",
                        text: "Blog yang sudah dihapus tidak dapat dikembalikan!",
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
