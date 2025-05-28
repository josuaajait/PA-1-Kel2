@extends('layout.main')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header text-white text-center">
                    <h3>Form Pemesanan</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.pemesanan-produk.store') }}" method="POST">
                    @csrf

                    <!-- Nama -->
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Pemesan</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                            id="nama" name="nama" value="{{ old('nama') }}" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                            id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nomor Telepon -->
                    <div class="mb-3">
                        <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control @error('nomor_telepon') is-invalid @enderror" 
                            id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon') }}" required>
                        @error('nomor_telepon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Alamat -->
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Produk -->
                    <div class="mb-3">
                        <label for="produk_id" class="form-label">Pilih Produk</label>
                        <select class="form-select @error('produk_id') is-invalid @enderror" 
                                id="produk_id" name="produk_id" required>
                            <option selected disabled>Pilih Produk...</option>
                            @foreach($produks as $produk)
                                <option value="{{ $produk->id }}">{{ $produk->nama }} - Rp{{ number_format($produk->harga, 0, ',', '.') }}</option>
                            @endforeach
                        </select>
                        @error('produk_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Jumlah -->
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" class="form-control @error('jumlah') is-invalid @enderror" 
                            id="jumlah" name="jumlah" min="1" value="{{ old('jumlah', 1) }}" required>
                        @error('jumlah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i> Submit Pemesanan
                        </button>
                        <a href="{{ route('user.produk.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
