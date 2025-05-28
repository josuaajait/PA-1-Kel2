@include('layout.header')
@include('layout.navbar')

<style>
    #header.scrolled {
        background-color: #fff !important;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pemesananJahitans as $p)
                        <tr>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->jenis_pakaian }}</td>
                            <td>{{ ucfirst($p->status) }}</td>
                            <td>{{ $p->created_at->format('d M Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $pemesananJahitans->links() }}
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pemesananProduks as $p)
                        <tr>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->jenis_pakaian }}</td>
                            <td>{{ ucfirst($p->status) }}</td>
                            <td>{{ $p->created_at->format('d M Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $pemesananProduks->links() }}
            </div>
        @else
            <p class="text-muted">Belum ada pemesanan produk.</p>
        @endif
    </div>
</section>

@include('layout.script')
@include('layout.footer')
