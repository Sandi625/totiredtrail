@extends('layout.dashboard')

@section('title', 'Detail Tour')

@section('content')

<div class="card mt-3">
    <div class="card-header">
        <h5 class="mb-0">Detail Tour: {{ $tour->title }}</h5>
    </div>

    <div class="card-body">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th width="200">Judul Tour</th>
                    <td>{{ $tour->title }}</td>
                </tr>

                <tr>
                    <th>Kategori</th>
                    <td>{{ $tour->category ? $tour->category->name : '-' }}</td>
                </tr>

                <tr>
                    <th>Slug</th>
                    <td>{{ $tour->slug }}</td>
                </tr>

                <tr>
                    <th>Route Name</th>
                    <td>{{ $tour->route_name ?? '-' }}</td>
                </tr>

                <tr>
                    <th>Harga</th>
                    <td>Rp {{ number_format($tour->price, 0, ',', '.') }}</td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>
                        @if($tour->status)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-danger">Tidak Aktif</span>
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>Deskripsi</th>
                    <td>{!! nl2br(e($tour->description)) !!}</td>
                </tr>

                <tr>
                    <th>Gambar Utama</th>
                    <td>
                        @php
                            // Pastikan images selalu array
                            $images = is_array($tour->images) ? $tour->images : json_decode($tour->images, true);
                        @endphp

                        @if($images && count($images) > 0)
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($images as $img)
                                    <img src="{{ asset('uploads/tours/' . $img) }}"
                                         width="150"
                                         class="rounded border mb-2">
                                @endforeach
                            </div>
                        @else
                            <span class="text-muted">Tidak ada gambar</span>
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>Itinerary / Hari</th>
                    <td>
                        @if($tour->days && $tour->days->count() > 0)
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
                                    @foreach($tour->days as $index => $day)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $day->title ?? '-' }}</td>
                                            <td>{!! nl2br(e($day->description)) !!}</td>
                                            <td>
                                                @if($day->image)
                                                    <img src="{{ asset('uploads/tour_days/' . $day->image) }}"
                                                         width="120"
                                                         class="rounded border mb-2">
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

        <a href="{{ route('tour.index') }}" class="btn btn-secondary mt-2">Kembali</a>
    </div>
</div>

@endsection
