@extends('layout.dashboard')

@section('title', 'Detail Blog')

@section('content')

<div class="card mt-3">
    <div class="card-header">
        <h5 class="mb-0">Detail Blog: {{ $blog->title }}</h5>
    </div>

    <div class="card-body">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th width="200">Judul Blog</th>
                    <td>{{ $blog->title }}</td>
                </tr>

                <tr>
                    <th>Slug</th>
                    <td>{{ $blog->slug }}</td>
                </tr>

                <tr>
                    <th>Route Name</th>
                    <td>{{ $blog->route_name }}</td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>
                        @if($blog->status)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-danger">Tidak Aktif</span>
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>Deskripsi</th>
                    <td>{!! nl2br(e($blog->description)) !!}</td>
                </tr>

                <tr>
                    <th>Gambar Utama</th>
                    <td>
                        @if($blog->image)
                            <img src="{{ asset('uploads/blogs/' . $blog->image) }}"
                                 width="250"
                                 class="rounded border">
                        @else
                            <span class="text-muted">Tidak ada gambar</span>
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>Itinerary / Hari</th>
                    <td>
                        @if($blog->days && count($blog->days) > 0)
                            <table class="table table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Judul Hari</th>
                                        <th>Deskripsi Hari</th>
                                        <th>Gambar</th>
                                        <th>Judul Gambar</th>
                                        <th>Deskripsi Gambar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($blog->days as $index => $day)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $day->title }}</td>
                                            <td>{!! nl2br(e($day->description)) !!}</td>
                                            <td>
                                                @if($day->image)
                                                    <img src="{{ asset('uploads/blog_days/' . $day->image) }}"
                                                         width="120"
                                                         class="rounded border">
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>{{ $day->image_title ?? '-' }}</td>
                                            <td>{{ $day->image_description ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <span class="text-muted">Belum ada itinerary</span>
                        @endif
                    </td>
                </tr>

            </tbody>
        </table>

        <a href="{{ route('blogs.index') }}" class="btn btn-secondary mt-2">Kembali</a>
    </div>
</div>

@endsection
