@extends('layout.dashboard')
@section('title', 'Edit Category')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">

    <div class="card mt-3">
        <div class="card-header">
            <h5 class="mb-0">Edit Category</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Category</label>
                    <input type="text"
                           name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $category->name) }}"
                           placeholder="Contoh: Bromo - Ijen">

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button class="btn btn-warning">Update</button>

                <a href="{{ route('categories.index') }}"
                   class="btn btn-secondary">
                   Kembali
                </a>

            </form>

        </div>
    </div>

</div>

@endsection
