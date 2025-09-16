@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h3>Halo, {{ session('full_name') }}!</h3>
        <p><strong>Role:</strong> Mahasiswa</p>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <h4>Mata Kuliah Tersedia</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Mata Kuliah</th>
                    <th>Kredit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                    <tr>
                        <td>{{ $course->course_name }}</td>
                        <td>{{ $course->credits }} SKS</td>
                        <td>
                            @if(!$enrolledCourses->contains('course_id', $course->course_id))
                                <form action="{{ route('mahasiswa.enroll.process') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{ $course->course_id }}">
                                    <button type="submit" class="btn btn-sm btn-primary">Daftar</button>
                                </form>
                            @else
                                <span class="badge bg-success">Terdaftar</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h4 class="mt-4">Mata Kuliah Terdaftar</h4>
        <ul>
            @forelse($enrolledCourses as $c)
                <li>{{ $c->course_name }} ({{ $c->pivot->enroll_date }})</li>
            @empty
                <li>Tidak ada mata kuliah terdaftar.</li>
            @endforelse
        </ul>
    </div>
@endsection