<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="{{URL::asset('img/firman-taylor-logo-modified.png')}}" rel="icon">
    <title>Laporan Pemasukan</title>
    <link href="{{URL::asset('admincss/app.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        @include('layout.adminsidebar')
        <div class="main">
            @include('layout.adminnavbar')
            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3"><strong>Laporan</strong> Pemasukan</h1>

                    {{-- Bagian Ringkasan --}}
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Total Seluruh Pemasukan</h5>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="dollar-sign"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</h1>
                                </div>
                            </div>
                        </div>
                         <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Pemasukan Bulan Ini</h5>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">Rp {{ number_format($pemasukanBulanIni, 0, ',', '.') }}</h1>
                                </div>
                            </div>
                        </div>
                         <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Total Transaksi</h5>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="check-circle"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{ $totalTransaksi }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Bagian Tabel Rincian dengan gaya baru --}}
                    <div class="card">
                        <div class="card-header">
                             <h5 class="card-title mb-0">Rincian Pemasukan</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Sumber</th>
                                        <th>Keterangan</th>
                                        <th>Nama Pelanggan</th>
                                        <th class="text-end">Jumlah Masuk</th>
                                        <th class="text-end">Sisa Pembayaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pemasukans as $pemasukan)
                                    <tr>
                                        {{-- Penomoran yang benar untuk pagination --}}
                                        <td>{{ ($pemasukans->currentPage() - 1) * $pemasukans->perPage() + $loop->iteration }}</td>
                                        <td>{{ \Carbon\Carbon::parse($pemasukan['tanggal'])->format('d M Y, H:i') }}</td>
                                        <td>
                                            @if (str_contains($pemasukan['keterangan'], 'Uang Muka'))
                                                <span class="badge bg-warning">{{ $pemasukan['sumber'] }}</span>
                                            @elseif (str_contains($pemasukan['keterangan'], 'Pelunasan'))
                                                 <span class="badge bg-primary">{{ $pemasukan['sumber'] }}</span>
                                            @else
                                                <span class="badge bg-success">{{ $pemasukan['sumber'] }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $pemasukan['keterangan'] }}</td>
                                        <td>{{ $pemasukan['nama_pelanggan'] }}</td>
                                        <td class="text-end text-success fw-bold">Rp {{ number_format($pemasukan['jumlah'], 0, ',', '.') }}</td>
                                        <td class="text-end">
                                            @if ($pemasukan['sisa_pembayaran'] > 0)
                                                <span class="text-danger">Rp {{ number_format($pemasukan['sisa_pembayaran'], 0, ',', '.') }}</span>
                                            @else
                                                <span class="badge bg-info">Lunas</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Belum ada pemasukan yang tercatat.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-center mt-4">
                                {{ $pemasukans->links('vendor.pagination.bootstrap-4') }}
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
