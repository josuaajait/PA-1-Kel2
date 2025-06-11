<!DOCTYPE html>
<html lang="en">
<head>
    {{-- (Salin semua bagian <head> dari layout utama Anda) --}}
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
                                    <h1 class="mt-1 mb-3">Rp {{ number_format($totalPemasukan, 2, ',', '.') }}</h1>
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
                                    <h1 class="mt-1 mb-3">Rp {{ number_format($pemasukanBulanIni, 2, ',', '.') }}</h1>
                                </div>
                            </div>
                        </div>
                         <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Transaksi Selesai</h5>
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

                    {{-- Bagian Tabel Rincian --}}
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Rincian Pemasukan</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover my-0">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Sumber</th>
                                                    <th>Keterangan</th>
                                                    <th>Nama Pelanggan</th>
                                                    <th class="text-end">Jumlah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($pemasukans as $pemasukan)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($pemasukan['tanggal'])->format('d M Y, H:i') }}</td>
                                                    <td><span class="badge bg-success">{{ $pemasukan['sumber'] }}</span></td>
                                                    <td>{{ $pemasukan['keterangan'] }}</td>
                                                    <td>{{ $pemasukan['nama_pelanggan'] }}</td>
                                                    <td class="text-end">Rp {{ number_format($pemasukan['jumlah'], 2, ',', '.') }}</td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">Belum ada pemasukan yang tercatat.</td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mt-3">
                                        {{ $pemasukans->links('vendor.pagination.bootstrap-4') }}
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