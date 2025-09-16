<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sistem Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">Sistem Akademik</a>

            <div class="navbar-nav ms-auto d-flex align-items-center gap-2">
                @if(session('logged_in'))
                    <!-- Nama User -->
                    <span class="navbar-text me-2">{{ session('full_name') }} ({{ session('role') }})</span>

                    <!-- Menu Mahasiswa -->
                    @if(session('role') === 'mahasiswa')
                        <a class="nav-link me-2" href="{{ route('mahasiswa.enroll') }}">Enroll</a>
                        <a class="nav-link me-2" href="{{ route('mahasiswa.view-courses') }}">Lihat Mata Kuliah</a>
                    @endif

                    <!-- Menu Admin -->
                    @if(session('role') == 'admin')
                        <a class="nav-link me-2" href="{{ route('admin.courses') }}">Kelola Mata Kuliah</a>
                        <a class="nav-link me-2" href="{{ route('admin.students') }}">Kelola Mahasiswa</a>
                    @endif

                    <!-- Logout Button -->
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                @endif
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>