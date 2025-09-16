@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Edit Data Mahasiswa</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.students.update', $student) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="full_name" class="form-label">Nama Lengkap *</label>
            <input type="text" name="full_name" id="full_name" class="form-control" value="{{ old('full_name', $student->user->full_name) }}" required>
            @error('full_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="username" class="form-label">Username *</label>
            <input type="text" name="username" id="username" class="form-control" value="{{ old('username', $student->user->username) }}" required>
            @error('username')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email *</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $student->user->email) }}" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password (biarkan kosong jika tidak ingin diubah)</label>
            <input type="password" name="password" id="password" class="form-control">
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>

        <div class="mb-3">
            <label for="entry_year" class="form-label">Tahun Masuk *</label>
            <input type="number" name="entry_year" id="entry_year" class="form-control" value="{{ old('entry_year', $student->entry_year) }}" min="2000" max="{{ date('Y') }}" required>
            @error('entry_year')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Perbarui Data</button>
        <a href="{{ route('admin.students') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection