@extends('layout.main')

@section('content')
<div class="container">
    <h2>Detail Ukuran</h2>
    <form action="{{ route('') }}" method="POST">
        @csrf

        <!-- Hidden Fields to Carry Forward Previous Data -->
        <input type="hidden" name="name" value="{{ request('name') }}">
        <input type="hidden" name="phone" value="{{ request('phone') }}">
        <input type="hidden" name="address" value="{{ request('address') }}">
        <input type="hidden" name="jenis" value="{{ request('jenis') }}">
        <input type="hidden" name="bahan" value="{{ request('bahan') }}">
        <input type="hidden" name="warna" value="{{ request('warna') }}">
        <input type="hidden" name="modifikasi" value="{{ request('modifikasi') }}">

        @php
            $jenis = request('jenis');
        @endphp

        @if ($jenis === 'Kemeja')
            <div class="mb-3">
                <label class="form-label">Lingkar Leher</label>
                <input type="number" name="lingkar_leher" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Lebar Bahu</label>
                <input type="number" name="lebar_bahu" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Lingkar Dada</label>
                <input type="number" name="lingkar_dada" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Lingkar Pinggang</label>
                <input type="number" name="lingkar_pinggang" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Panjang Lengan</label>
                <input type="number" name="panjang_lengan" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Panjang Kemeja</label>
                <input type="number" name="panjang_kemeja" class="form-control" required>
            </div>
        @elseif ($jenis === 'Gaun' || $jenis === 'Kebaya')
            <div class="mb-3">
                <label class="form-label">Lingkar Dada</label>
                <input type="number" name="lingkar_dada" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Lingkar Pinggang</label>
                <input type="number" name="lingkar_pinggang" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Lingkar Pinggul</label>
                <input type="number" name="lingkar_pinggul" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Lebar Bahu</label>
                <input type="number" name="lebar_bahu" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Panjang Tangan</label>
                <input type="number" name="panjang_tangan" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Lingkar Lengan Atas</label>
                <input type="number" name="lingkar_lengan_atas" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Panjang Bada</label>
                <input type="number" name="panjang_bada" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Panjang Badan</label>
                <input type="number" name="panjang_badan" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Panjang Gaun</label>
                <input type="number" name="panjang_gaun" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Lingkar Leher</label>
                <input type="number" name="lingkar_leher" class="form-control" required>
            </div>
        @endif

        <div class="d-grid">
            <button type="submit" class="btn btn-success">Submit Order</button>
        </div>
    </form>
</div>
@endsection
