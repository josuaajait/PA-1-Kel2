@include('layout.header')
@include('layout.navbar')

<br><br><br><br>
<section class="section">
  <div class="container">
    <h2 class="mb-4">Riwayat Pemesanan Anda</h2>

    <h4>Jahitan</h4>
    @if ($pemesananJahitans->isEmpty())
      <p>Tidak ada riwayat pemesanan jahitan.</p>
    @else
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Nama</th>
            <th>Jenis Pakaian</th>
            <th>Status</th>
            <th>Tanggal</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($pemesananJahitans as $pemesanan)
            <tr>
              <td>{{ $pemesanan->nama }}</td>
              <td>{{ $pemesanan->jenis_pakaian }}</td>
              <td>{{ $pemesanan->status }}</td>
              <td>{{ $pemesanan->created_at->format('d M Y') }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {{ $pemesananJahitans->links() }}
    @endif

    <h4 class="mt-5">Produk</h4>
    @if ($pemesananProduks->isEmpty())
      <p>Tidak ada riwayat pemesanan produk.</p>
    @else
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Nama</th>
            <th>Produk</th>
            <th>Status</th>
            <th>Tanggal</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($pemesananProduks as $pemesanan)
            <tr>
              <td>{{ $pemesanan->nama }}</td>
              <td>{{ $pemesanan->nama_produk }}</td>
              <td>{{ $pemesanan->status }}</td>
              <td>{{ $pemesanan->created_at->format('d M Y') }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {{ $pemesananProduks->links() }}
    @endif
  </div>
</section>

@include('layout.footer')
