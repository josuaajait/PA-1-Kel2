<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Detail About Us</title>
    <link href="{{ URL::asset('admincss/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        @include('layout.adminsidebar')

        <div class="main">
            @include('layout.adminnavbar')

            <main class="content">
                <div class="container mt-4">
                    <h2>Detail About Us</h2>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Informasi Lengkap</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <h5 class="font-weight-bold">Deskripsi</h5>
                                <p>{{ $aboutUs->deskripsi }}</p>
                            </div>

                            <div class="mb-3">
                                <h5 class="font-weight-bold">Sejarah</h5>
                                <p>{{ $aboutUs->sejarah }}</p>
                            </div>

                            <div class="mb-3">
                                <h5 class="font-weight-bold">Visi</h5>
                                <p>{{ $aboutUs->visi }}</p>
                            </div>

                            <div class="mb-3">
                                <h5 class="font-weight-bold">Misi</h5>
                                <p>{{ $aboutUs->misi }}</p>
                            </div>

                            <div class="d-flex gap-2">
                                <a href="{{ route('about.edit', $aboutUs->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('about.destroy', $aboutUs->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                </form>
                                <a href="{{ route('about.index') }}" class="btn btn-secondary btn-sm">Kembali ke Daftar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            @include('layout.adminfooter')
        </div>
    </div>

    @include('layout.adminscript')
</body>

</html>
