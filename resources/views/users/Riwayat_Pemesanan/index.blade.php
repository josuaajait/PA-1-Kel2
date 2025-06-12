@include('layout.header')
@include('layout.navbar')

<style>
    #header.scrolled {
        background-color: #fff !important;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .pagination {
        display: flex !important;
        flex-wrap: wrap;
        list-style: none !important;
        padding-left: 0 !important;
        justify-content: center; /* or flex-start/space-between etc */
        margin-top: 1rem;
    }

    .page-item {
        margin: 0 0.25rem;
    }

    .page-link {
        display: block;
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        color: #007bff;
        text-decoration: none;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
    }

    .page-item.active .page-link {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }

    .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
        background-color: #fff;
        border-color: #dee2e6;
    }
</style>

<br><br><br><br>

<section id="riwayat" class="section light-background">
    <div class="container" data-aos="fade-up">
        <h2 class="mb-4">Riwayat Pemesanan Anda</h2>
        {{-- PEMESANAN JAHITAN --}}
        <h4>Pemesanan Jahitan</h4>
        @if($pemesananJahitans->count())
            <div class="table-responsive mb-5">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Jenis Pakaian</th>
                            <th>Status</th>
                            <th>Tanggal Pesan</th>
                            <th>Waktu Pengerjaan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pemesananJahitans as $p)
                        <tr>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->jenis_pakaian }}</td>
                            <td>{{ ucfirst($p->status) }}</td>
                            <td>{{ $p->created_at->format('d M Y') }}</td>
                            <td>
                                @php
                                    $jenis = strtolower(trim($p->jenis_pakaian)); // pastikan lowercase dan bersih dari spasi
                                @endphp

                                @if($p->status === 'selesai')
                                    @switch($jenis)
                                        @case('kemeja')
                                            1-3 hari
                                            @break
                                        @case('gaun')
                                            3-7 hari
                                            @break
                                        @case('kebaya')
                                            7-14 hari
                                            @break
                                        @default
                                            -
                                    @endswitch
                                @else
                                    Estimasi: 
                                    @switch($jenis)
                                        @case('kemeja')
                                            1-3 hari
                                            @break
                                        @case('gaun')
                                            3-7 hari
                                            @break
                                        @case('kebaya')
                                            7-14 hari
                                            @break
                                        @default
                                            -
                                    @endswitch
                                @endif


                            <td>
                                @if($p->status === 'selesai')
                                    <a href="{{ route('user.testimoni.create') }}" class="btn btn-primary">Ulas</a>
                                @else
                                    <span class="text-muted">Belum selesai</span>
                                @endif

                            </td>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $pemesananJahitans->links('vendor.pagination.bootstrap-4') }}
            </div>
        @else
            <p class="text-muted">Belum ada pemesanan jahitan.</p>
        @endif

        {{-- PEMESANAN PRODUK --}}
        <h4>Pemesanan Produk</h4>
        @if($pemesananProduks->count())
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Jenis Pakaian</th>
                            <th>Status</th>
                            <th>Tanggal Pesan</th>
                            <th>Tanggal Diambil</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pemesananProduks as $p)
                            <tr>
                                <td>{{ $p->nama }}</td>
                                <td>{{ $p->jenis_pakaian }}</td>
                                <td>{{ ucfirst($p->status) }}</td>
                                <td>{{ $p->created_at->format('d M Y') }}</td>
                                <td>
                                    @if($p->status === 'selesai' && $p->tanggal_diambil)
                                        {{ \Carbon\Carbon::parse($p->tanggal_diambil)->format('d M Y H:i') }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($p->status === 'selesai')
                                        <a href="{{ route('user.testimoni.create') }}" class="btn btn-primary">Ulas</a>
                                    @else
                                        <span class="text-muted">Belum selesai</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>


                </table>

                {{ $pemesananProduks->links('vendor.pagination.bootstrap-4') }}
            </div>
        @else
            <p class="text-muted">Belum ada pemesanan produk.</p>
        @endif


        <h4>Pemesanan Modifikasi</h4>
        @if($pemesananModifikasis->count())
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Jenis Pakaian</th>
                            <th>Catatan</th>
                            <th>Tanggal Pesan</th>
                            <th>Waktu Pengerjaan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pemesananModifikasis as $p)
                        <tr>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->jenis_pakaian }}</td>
                            <td>{{ $p->catatan }}</td>
                            <td>{{ $p->created_at->format('d M Y') }}</td>
                            <td>
                                @php
                                    $jenis = strtolower(trim($p->jenis_pakaian)); // pastikan lowercase dan bebas spasi
                                @endphp

                                @if($p->status === 'selesai')
                                    @switch($jenis)
                                        @case('kemeja')
                                            1-3 hari
                                            @break
                                        @case('gaun')
                                            3-7 hari
                                            @break
                                        @case('kebaya')
                                            7-14 hari
                                            @break
                                        @case('rok')
                                            2-4 hari
                                            @break
                                        @default
                                            -
                                    @endswitch
                                @else
                                    Estimasi:
                                    @switch($jenis)
                                        @case('kemeja')
                                            1-3 hari
                                            @break
                                        @case('gaun')
                                            3-7 hari
                                            @break
                                        @case('kebaya')
                                            7-14 hari
                                            @break
                                        @case('rok')
                                            2-4 hari
                                            @break
                                        @default
                                            -
                                    @endswitch
                                @endif
                            </td>
                            <td>
                                @if($p->status === 'selesai')
                                    <a href="{{ route('user.testimoni.create') }}" class="btn btn-primary">Ulas</a>
                                @else
                                    <span class="text-muted">Belum selesai</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>
                {{ $pemesananModifikasis->links('vendor.pagination.bootstrap-4') }}
            </div>
        @else
            <p class="text-muted">Belum ada pemesanan modifikasi.</p>
        @endif

    </div>
</section>

@include('layout.script')
@include('layout.footer')
