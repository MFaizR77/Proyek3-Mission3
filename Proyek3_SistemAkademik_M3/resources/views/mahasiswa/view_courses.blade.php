@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h3>Halo, {{ session('full_name') }}!</h3>
        <p><strong>Role:</strong> Mahasiswa</p>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card mt-4">
            <div class="card-header">
                <h5>Mata Kuliah Terdaftar</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Mata Kuliah</th>
                                <th>Kredit</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($enrolledCourses as $c)
                                <tr>
                                    <td>{{ $c->course_name }}</td>
                                    <td>{{ $c->credits }} SKS</td>
                                    <td>{{ $c->pivot->enroll_date }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">Belum ada mata kuliah terdaftar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection