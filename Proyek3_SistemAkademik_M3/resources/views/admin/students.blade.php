@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Manajemen Mahasiswa</h3>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0">Daftar Mahasiswa</h5>
        <a href="{{ route('admin.students.create') }}" class="btn btn-success">Tambah Mahasiswa</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Username</th>
                <th>Email</th>
                <th>Tahun Masuk</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->user->full_name ?? '-' }}</td>
                    <td>{{ $student->user->username ?? '-' }}</td>
                    <td>{{ $student->user->email ?? '-' }}</td>
                    <td>{{ $student->entry_year }}</td>
                    <td>
                        <a href="{{ route('admin.students.edit', $student) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.students.delete', $student) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Hapus mahasiswa ini? Semua data terkait akan dihapus.')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($students->isEmpty())
        <div class="text-center text-muted py-4">
            Belum ada mahasiswa yang terdaftar.
        </div>
    @endif
</div>
@endsection