@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Halo, {{ session('full_name') }}!</h3>
    <p><strong>Role:</strong> Admin</p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Daftar Mata Kuliah (untuk referensi admin) -->
    <h4 class="mt-4">Daftar Mata Kuliah</h4>
    <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th>Nama Mata Kuliah</th>
                <th>Kredit</th>
                <th>Semester</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
                <tr>
                    <td>{{ $course->course_name }}</td>
                    <td>{{ $course->credits }} SKS</td>
                    <td>{{ $course->semester ?? '-' }}</td>
                    <td>{{ Str::limit($course->description, 50) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Link Akses Ke Fitur Admin -->
    <div class="mt-5">
        <h4>Akses Cepat</h4>
        <div class="row">
            <div class="col-md-6 mb-3">
                <a href="{{ route('admin.courses') }}" class="btn btn-primary w-100">Kelola Mata Kuliah</a>
            </div>
            <div class="col-md-6 mb-3">
                <a href="{{ route('admin.students') }}" class="btn btn-success w-100">Kelola Mahasiswa</a>
            </div>
        </div>
    </div>

    <!-- Catatan untuk admin -->
    <div class="mt-4 p-3 bg-light border rounded">
        <small>
            <strong>Catatan:</strong> Gunakan menu di atas untuk mengelola mata kuliah dan mahasiswa. 
            Anda dapat menambah, mengedit, atau menghapus data sesuai kebutuhan.
        </small>
    </div>
</div>
@endsection