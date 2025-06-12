<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Modifikasi Jahitan & Produk</title>
    <link href="{{ URL::asset('admincss/app.css') }}" rel="stylesheet" />
  <link href="{{URL::asset('img/firman-taylor-logo-modified.png')}}" rel="icon"> 
</head>
<body>
    <div class="wrapper">
        @include('layout.adminsidebar')
        <div class="main">
            @include('layout.adminnavbar')
            <main class="content">
                <div class="container-fluid mt-4">

                    <h2>Pemesanan Produk</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jenis Pakaian</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pemesananProduk as $index => $pemesanan)
                                @foreach ($pemesanan->produks as $produk)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $pemesanan->nama }}</td> <!-- nama pemesan -->
                                        <td>{{ $pemesanan->jenis_pakaian?? '-' }}</td> <!-- nama produk -->
                                        <td>{{ $pemesanan->status ?? '-' }}</td>
                                        <td>
                                            <a href="{{ route('admins.modifikasi-jahitan.create') }}?type=produk&id={{ $pemesanan->pemesanan_produk_id }}" class="btn btn-primary btn-sm">Modifikasi</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                    <br><br>
                    <h2>Pemesanan Jahitan</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jenis Pakaian</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($pemesananJahitans as $index => $jahitan)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $jahitan->nama }}</td>
                                    <td>{{ $jahitan->jenis_pakaian }}</td>
                                    <td>{{ $jahitan->status ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('admins.modifikasi-jahitan.create') }}?type=jahitan&id={{ $jahitan->pemesanan_jahitan_id }}" class="btn btn-primary btn-sm">Modifikasi</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br><br>
                    <h2>Daftar Pengajuan Modifikasi</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jenis Pakaian</th>
                                <th>Catatan</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($daftarModifikasiJahitan as $index => $modifikasi)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $modifikasi->nama }}</td>
                                    <td>{{ $modifikasi->jenis_pakaian }}</td>
                                    <td>{{ $modifikasi->catatan }}</td>
                                    <td>{{ $modifikasi->created_at->format('d-m-Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admins.modifikasi-jahitan.show', $modifikasi->modifikasi_jahitan_id) }}" class="btn btn-info btn-sm">Detail</a>
                                        <a href="{{ route('admins.modifikasi-jahitan.edit', $modifikasi->modifikasi_jahitan_id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('admins.modifikasi-jahitan.destroy', $modifikasi->modifikasi_jahitan_id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pengajuan ini?')">Hapus</button>
                                        </form>
                                        @php
                                            // Cek apakah ini pemesanan produk atau pemesanan jahitan
                                            $isProduk = !is_null($modifikasi->pemesanan_produk_id);
                                            $isJahitan = !is_null($modifikasi->pemesanan_jahitan_id);

                                            $pemesanan = $isProduk ? $modifikasi->pemesananProduk : ($isJahitan ? $modifikasi->pemesananJahitan : null);

                                            // Ambil nomor telepon sesuai jenis pemesanan
                                            $nohpRaw = $isProduk ? ($pemesanan->nomor_telepon ?? '') : ($pemesanan->no_hp ?? '');
                                            $nohp = preg_replace('/[^0-9]/', '', $nohpRaw);

                                            if (Str::startsWith($nohp, '0')) {
                                                $nohp = '62' . substr($nohp, 1);
                                            } elseif (Str::startsWith($nohp, '620')) {
                                                $nohp = '62' . substr($nohp, 3);
                                            } elseif (!Str::startsWith($nohp, '62')) {
                                                $nohp = '62' . $nohp;
                                            }

                                            $nama = $pemesanan->nama ?? '-';

                                            // Buat pesan sesuai jenis pemesanan
                                            if ($isProduk) {
                                                $produk = $pemesanan->produk->name ?? 'produk';
                                                $pesan = urlencode("Halo $nama, terima kasih telah membeli $produk kami. Silakan ambil ke tempat. Semoga puas dan ditunggu pembeliannya kembali!");
                                            } elseif ($isJahitan) {
                                                $jenis = $modifikasi->jenis_pakaian ?? 'pakaian';
                                                $pesan = urlencode("Halo $nama, pesanan modifikasi jahitan Anda untuk jenis pakaian \"$jenis\" sudah selesai. Silakan ambil ke tempat. Terima kasih telah menggunakan layanan kami.");
                                            } else {
                                                $pesan = urlencode("Halo $nama, informasi pesanan Anda sudah tersedia.");
                                            }
                                        @endphp

                                        <a href="https://wa.me/{{ $nohp }}?text={{ $pesan }}" class="btn btn-success btn-sm" target="_blank">
                                            Kirim Pesan
                                        </a>


                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada pengajuan modifikasi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- Tampilkan pagination jika datanya banyak --}}
                    <div class="d-flex justify-content-center">
                        {{ $daftarModifikasiJahitan->links() }}
                    </div>

                </div>
            </main>
            @include('layout.adminfooter')
        </div>
    </div>
    @include('layout.adminscript')
</body>
</html>
