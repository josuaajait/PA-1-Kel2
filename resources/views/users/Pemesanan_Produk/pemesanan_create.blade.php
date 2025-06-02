@extends('layout.main')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header text-white text-center">
                    <h3>Form Pemesanan Produk</h3>
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
                            @foreach($produks as $item)
                                <option value="{{ $item->produk_id }}" 
                                    {{ (old('produk_id') == $item->produk_id || (isset($produk) && $produk->produk_id == $item->produk_id)) ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('produk_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Ukuran -->
                    <div class="mb-3">
                        <label for="ukuran" class="form-label">Ukuran</label>
                        <input type="text" class="form-control" id="ukuran" name="ukuran" 
                        value="{{ old('ukuran', isset($produk) ? $produk->ukuran : '') }}" readonly>
                        @error('ukuran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Harga -->
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga (Rp)</label>
                       <input type="text" class="form-control @error('harga') is-invalid @enderror" 
                        id="harga" name="harga" 
                        value="{{ old('harga', isset($produk) ? $produk->harga : '') }}" readonly>
                        @error('harga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i> Kirim Pemesanan
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

<script>
    const produkData = @json($produks);

    document.getElementById('produk_id').addEventListener('change', function() {
        const selectedProdukId = this.value;
        const selectedProduk = produkData.find(p => p.produk_id == selectedProdukId);

        if(selectedProduk) {
            document.getElementById('ukuran').value = selectedProduk.ukuran;
            document.getElementById('harga').value = selectedProduk.harga;
        } else {
            document.getElementById('ukuran').value = '';
            document.getElementById('harga').value = '';
        }
    });
</script>
