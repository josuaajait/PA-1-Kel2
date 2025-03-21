@extends('layout.admin')

@section('content')
<div class="container mt-4">
    <h2>Pemesanan Produk</h2>
    
    <!-- Check if there are any orders -->
    @if ($orders->isEmpty())
        <p class="text-muted">Belum ada pemesanan produk.</p>
    @else
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pelanggan</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->product->name }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge bg-{{ $order->status == 'Pending' ? 'warning' : 'success' }}">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('pemesanan.show', $order->id) }}" class="btn btn-info btn-sm">Detail</a>
                            <form action="{{ route('pemesanan.destroy', $order->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus pesanan ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
