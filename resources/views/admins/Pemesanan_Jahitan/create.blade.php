<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Tambah Pemesanan Jahitan</title>
	<link href="{{ URL::asset('admincss/app.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
        <div class="wrapper">

		@include('layout.adminsidebar')

		<div class="main">

			@include('layout.adminnavbar')

			<main class="content">
				<div class="container-fluid mt-4">

					<h1 class="h3 mb-3">Tambah Pemesanan Jahitan</h1>

					<div class="row">
						<div class="col-12 col-lg-8">
							<div class="card">
								<div class="card-body">
									<form action="{{ route('admins.pemesanan-jahitan.store') }}" method="POST" enctype="multipart/form-data">
										@csrf

										<div class="mb-3">
											<label for="nama" class="form-label">Nama</label>
											<input type="text" name="nama" class="form-control" required>
										</div>

										<div class="mb-3">
											<label for="no_hp" class="form-label">No HP</label>
											<input type="text" name="no_hp" class="form-control" required>
										</div>

										<div class="mb-3">
											<label for="alamat" class="form-label">Alamat</label>
											<input name="alamat" class="form-control" required></input>
										</div>

										<!-- Form Pilihan -->
										<div class="mb-3">
										<label for="jenis_pakaian" class="form-label">Jenis Pakaian</label>
										<select id="jenis_pakaian" name="jenis_pakaian" class="form-control" onchange="updateUkuranTemplate()" required>
											<option value="">-- Pilih Jenis --</option>
											<option value="kemeja">Kemeja</option>
											<option value="gaun">Gaun</option>
											<option value="kebaya">Kebaya</option>
										</select>
										</div>

										<div class="mb-3">
											<label for="bahan" class="form-label">Bahan</label>
											<select name="bahan" class="form-control" required>
												<option value="">-- Pilih Bahan --</option>
												<option value="Brokat">Brokat</option>
												<option value="Renda">Renda</option>
												<option value="Katun">Katun</option>
												<option value="Linen">Linen</option>
												<option value="Flanel">Flanel</option>
											</select>
										</div>

										<div class="mb-3">
											<label for="warna" class="form-label">Warna</label>
											<input type="text" name="warna" class="form-control" required>
										</div>

										<!-- Textarea Otomatis -->
										<div class="mb-3">
										<label for="ukuran" class="form-label">Ukuran (Cm)</label>
										<textarea id="ukuran" name="ukuran" class="form-control" rows="10" required></textarea>
										</div>


										<div class="mb-3">
											<label for="referensi_gambar" class="form-label">Referensi Gambar (Opsional)</label>
											<input type="file" name="referensi_gambar" class="form-control">
										</div>
									
										<div class="mb-3">
											<label for="bukti_pembayaran_uang_muka" class="form-label">Bukti Pembayaran Uang Muka</label>
											<input type="file" name="bukti_pembayaran_uang_muka" class="form-control" required>
										</div>

										<div class="mb-3">
											<label for="bukti_pembayaran_lunas" class="form-label">Bukti Pembayaran Lunas (Opsional)</label>
											<input type="file" name="bukti_pembayaran_lunas" class="form-control">
										</div>
																				
										<button type="submit" class="btn btn-primary">Simpan</button>
										<a href="{{ route('admins.pemesanan-jahitan.index') }}" class="btn btn-secondary">Kembali</a>
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
    </div>
	@include('layout.adminscript')

</body>

</html>
