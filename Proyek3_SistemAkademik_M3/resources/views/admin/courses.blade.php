@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Halaman Admin - Manajemen Mata Kuliah</h3>
    <a href="{{ route('admin.courses.create') }}" class="btn btn-primary mb-3">Tambah Mata Kuliah</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Kredit</th>
                <th>Semester</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
                <tr>
                    <td>{{ $course->course_name }}</td>
                    <td>{{ $course->credits }}</td>
                    <td>{{ $course->semester }}</td>
                    <td>{{ Str::limit($course->description, 50) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection