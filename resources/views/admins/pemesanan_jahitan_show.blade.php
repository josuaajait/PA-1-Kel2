@extends('layout.adminmain')

@section('content')
<div class="container mt-4">
    <h1>Detail Pemesanan Jahitan</h1>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <td>{{ $pemesananJahitan->id }}</td>
        </tr>
        <tr>
            <th>Nama</th>
            <td>{{ $pemesananJahitan->nama }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $pemesananJahitan->email }}</td>
        </tr>
        <tr>
            <th>Nomor Telepon</th>
            <td>{{ $pemesananJahitan->nomor_telepon }}</td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>{{ $pemesananJahitan->alamat }}</td>
        </tr>
        <tr>
            <th>Jenis Pakaian</th>
            <td>{{ $pemesananJahitan->jenis_pakaian }}</td>
        </tr>
        <tr>
            <th>Ukuran</th>
            <td>{{ $pemesananJahitan->ukuran }}</td>
        </tr>
        <tr>
            <th>Warna</th>
            <td>{{ $pemesananJahitan->warna }}</td>
        </tr>
        <tr>
            <th>Modifikasi</th>
            <td>{{ $pemesananJahitan->modifikasi }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $pemesananJahitan->status }}</td>
        </tr>
    </table>
    <a href="{{ route('pemesanan-jahitan.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
