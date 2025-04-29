<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Detail Modifikasi Jahitan: {{ $modifikasiJahitan->nama }}</title>
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
                    <h1 class="h3 mb-3">Detail Modifikasi Jahitan</h1>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">{{ $modifikasiJahitan->nama }}</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th style="width: 25%;">ID</th>
                                                <td>{{ $modifikasiJahitan->id }}</td>
                                            </tr>
                                            <tr>
                                                <th>Nama Modifikasi</th>
                                                <td>{{ $modifikasiJahitan->nama }}</td>
                                            </tr>
                                             <tr>
                                                <th>Jenis Pakaian</th>
                                                <td>{{ $modifikasiJahitan->jenis_pakaian }}</td>
                                            </tr>
                                            <tr>
                                                <th>Catatan</th>
                                                {{-- Gunakan nl2br untuk menampilkan baris baru, e() untuk escaping --}}
                                                <td>{!! nl2br(e($modifikasiJahitan->catatan ?? '-')) !!}</td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Dibuat</th>
                                                <td>{{ $modifikasiJahitan->created_at->format('d F Y, H:i:s') }}</td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Diperbarui</th>
                                                <td>{{ $modifikasiJahitan->updated_at->format('d F Y, H:i:s') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="mt-3">
                                        <a href="{{ route('admins.modifikasi-jahitan.edit', $modifikasiJahitan->id) }}" class="btn btn-warning">Edit</a>
                                        <a href="{{ route('admins.modifikasi-jahitan.index') }}" class="btn btn-secondary">Kembali ke List</a>
                                        <form action="{{ route('admins.modifikasi-jahitan.destroy', $modifikasiJahitan->id) }}" method="POST" class="d-inline ms-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin hapus data ini?')">Hapus</button>
                                        </form>
                                    </div>
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
