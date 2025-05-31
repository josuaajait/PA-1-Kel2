<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Data About Us</title>
    <link href="{{ URL::asset('admincss/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        @include('layout.adminsidebar')

        <div class="main">
            @include('layout.adminnavbar')

            <main class="content">
                <div class="container-fluid p-0">
                    <h1 class="h3 mb-3">Data About Us</h1>
                    <a href="{{ route('admins.about.create') }}" class="btn btn-primary mb-3">Tambah Data</a>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">List About Us</h5>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Deskripsi</th>
                                            <th>Sejarah</th>
                                            <th>Visi</th>
                                            <th>Misi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($aboutUs as $item)
                                            <tr>    
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ Str::limit($item->deskripsi, 50) }}</td>
                                                <td>{{ Str::limit($item->sejarah, 50) }}</td>
                                                <td>{{ Str::limit($item->visi, 50) }}</td>
                                                <td>{{ Str::limit($item->misi, 50) }}</td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        <a href="{{ route('admins.about.detail', ['id' => $item->about_us_id]) }}" class="btn btn-info btn-sm">Detail</a>
                                                        <a href="{{ route('admins.about.edit', ['id' => $item->about_us_id]) }}" class="btn btn-warning btn-sm">Edit</a>
                                                        <form action="{{ route('admins.about.destroy', ['id' => $item->about_us_id]) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus data ini?')">Hapus</button>
                                                        </form>
                                                
                                                        @if(!$item->is_active)
                                                            <form action="{{ route('admins.about.activate', ['id' => $item->about_us_id]) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                <button type="submit" class="btn btn-success btn-sm">Tampilkan ke User</button>
                                                            </form>
                                                        @else
                                                            <span class="badge bg-success align-self-center">Aktif</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="d-flex justify-content-center mt-4">
                                    {{ $aboutUs->links() }}
                                </div>
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
