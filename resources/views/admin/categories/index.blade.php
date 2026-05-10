@extends('layout.dashboard')
@section('title', 'Categories')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">

    <div class="page-header row no-gutters py-2">
        <div class="col-12 col-sm-4 text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Data Master</span>
            <h3 class="page-title">Categories</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-12 order-1 order-lg-2 mb-4 mb-lg-0">

            <div class="card">

                <div class="card-header d-flex justify-content-between">
                    <h3 class="card-title mb-0">Data Categories</h3>

                    <a href="{{ route('categories.create') }}"
                       class="btn btn-sm btn-primary">
                        <i class="ti ti-plus"></i>&nbsp; Tambah Category
                    </a>
                </div>

                <div class="card-datatable table-responsive table-main">
                    <table class="table border-top nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Slug</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($categories as $key => $category)
                                <tr>
                                    <td>{{ $categories->firstItem() + $key }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>

                                    <td>
                                        <a href="{{ route('categories.edit', $category->id) }}"
                                           class="btn btn-sm btn-warning mb-1">
                                            <i class="ti ti-pencil"></i>
                                        </a>

                                     <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline delete-form">
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
                </div>

                <div class="mt-3 ms-3">
                    {{ $categories->links() }}
                </div>

            </div>

        </div>
    </div>

</div>

@endsection


@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {

    // =============== DELETE CONFIRM SWEETALERT ===============
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function (e) {
            let form = this.closest('.delete-form');

            Swal.fire({
                title: 'Yakin ingin menghapus kategori ini?',
                text: "Data kategori akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // =============== SWEETALERT SUCCESS MESSAGE ===============
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: @json(session('success')),
            confirmButtonText: 'OK'
        });
    @endif

    @if(session('error'))
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

