<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Data Modifikasi Jahitan</title> <!-- Judul diubah -->
    <link href="{{ URL::asset('admincss/app.css') }}" rel="stylesheet"> {{-- Sesuaikan path CSS --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        @include('layout.adminsidebar') {{-- Sesuaikan path layout --}}
        <div class="main">
            @include('layout.adminnavbar') {{-- Sesuaikan path layout --}}
            <main class="content">
                <div class="container-fluid p-0">
                    <h1 class="h3 mb-3">Data Modifikasi Jahitan</h1> <!-- Judul diubah -->
                    {{-- Link ke halaman tambah --}}
                    <a href="{{ route('admins.modifikasi-jahitan.create') }}" class="btn btn-primary mb-3">Tambah Data</a>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">List Modifikasi Jahitan</h5> <!-- Judul diubah -->
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
                                                    <th>Nama Modifikasi</th>
                                                    <th>Jenis Pakaian</th>
                                                    <th>Catatan</th>
                                                    <th>Tgl Dibuat</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- Loop data --}}
                                                @forelse($daftarModifikasiJahitan as $modifikasi) {{-- Ganti variabel loop --}}
                                                    <tr>
                                                        {{-- Nomor urut pagination --}}
                                                        <td>{{ ($daftarModifikasiJahitan->currentPage() - 1) * $daftarModifikasiJahitan->perPage() + $loop->iteration }}</td>
                                                        <td>{{ $modifikasi->nama }}</td>
                                                        <td>{{ $modifikasi->jenis_pakaian }}</td>
                                                        <td>{{ Str::limit($modifikasi->catatan, 70) }}</td> {{-- Batasi panjang catatan --}}
                                                        <td>{{ $modifikasi->created_at->format('d M Y') }}</td>
                                                        <td>
                                                            <div class="d-flex gap-1">
                                                                {{-- Link ke detail, edit, dan form hapus --}}
                                                                <a href="{{ route('admins.modifikasi-jahitan.show', $modifikasi->id) }}" class="btn btn-info btn-sm">Detail</a>
                                                                <a href="{{ route('admins.modifikasi-jahitan.edit', $modifikasi->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                                <form action="{{ route('admins.modifikasi-jahitan.destroy', $modifikasi->id) }}" method="POST" style="display: inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus data ini?')">Hapus</button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="6" class="text-center">Belum ada data modifikasi jahitan.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                        <!-- Pagination Links -->
                                        <div class="d-flex justify-content-center mt-4">
                                            {{ $daftarModifikasiJahitan->links() }} {{-- Tampilkan link pagination --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            @include('layout.adminfooter') {{-- Sesuaikan path layout --}}
        </div>
    </div>
    @include('layout.adminscript') {{-- Sesuaikan path layout --}}
</body>
</html>
