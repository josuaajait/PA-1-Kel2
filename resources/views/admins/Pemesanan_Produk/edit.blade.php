<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Edit Pemesanan</title>
	<link href="{{ URL::asset('admincss/app.css') }}" rel="stylesheet">
</head>

<body>
	<div class="wrapper">

		@include('layout.adminsidebar')

		<div class="main">

			@include('layout.adminnavbar')

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Edit Pemesanan Produk</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-body">
									<form action="{{ route('admins.pemesanan-produk.update', $pemesananProduk->pemesanan_produk_id) }}" method="POST">
										@csrf
										@method('PUT')

										<div class="mb-3">
											<label class="form-label">Nama</label>
											<input type="text" name="nama" value="{{ old('nama', $pemesananProduk->nama) }}" class="form-control" required>
										</div>

										<div class="mb-3">
											<label class="form-label">Email</label>
											<input type="email" name="email" value="{{ old('email', $pemesananProduk->email) }}" class="form-control" required>
										</div>

										<div class="mb-3">
											<label class="form-label">Telepon</label>
											<input type="text" name="nomor_telepon" value="{{ old('nomor_telepon', $pemesananProduk->nomor_telepon) }}" class="form-control" required>
										</div>

										<div class="mb-3">
											<label class="form-label">Alamat</label>
											<textarea name="alamat" class="form-control" required>{{ old('alamat', $pemesananProduk->alamat) }}</textarea>
										</div>

										<div class="mb-3">
											<label class="form-label">Total Harga</label>
											<input type="number" name="total_harga" value="{{ old('total_harga', $pemesananProduk->total_harga) }}" class="form-control" readonly>
										</div>

										<div class="mb-3">
											<label class="form-label">Status</label>
											<select name="status" class="form-control" required>
												<option value="pending" {{ old('status', $pemesananProduk->status) == 'pending' ? 'selected' : '' }}>Pending</option>
												<option value="diproses" {{ old('status', $pemesananProduk->status) == 'diproses' ? 'selected' : '' }}>Diproses</option>
												<option value="dikirim" {{ old('status', $pemesananProduk->status) == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
												<option value="selesai" {{ old('status', $pemesananProduk->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
												<option value="batal" {{ old('status', $pemesananProduk->status) == 'batal' ? 'selected' : '' }}>Batal</option>
											</select>
										</div>

										<button type="submit" class="btn btn-success">Update</button>
										<a href="{{ route('admins.pemesanan-produk.index') }}" class="btn btn-secondary">Batal</a>
									</form>

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
