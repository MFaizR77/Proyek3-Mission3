@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Tambah Mata Kuliah</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.courses.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="course_name" class="form-label">Nama Mata Kuliah</label>
            <input type="text" name="course_name" id="course_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="credits" class="form-label">Jumlah Kredit (1-5)</label>
            <input type="number" name="credits" id="credits" class="form-control" min="1" max="5" required>
        </div>

        <div class="mb-3">
            <label for="semester" class="form-label">Semester</label>
            <input type="text" name="semester" id="semester" class="form-control" placeholder="Contoh: Gasal 2024/2025">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" id="description" class="form-control" rows="4"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.courses') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection