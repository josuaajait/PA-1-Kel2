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
				@if(session('success'))
					<div class="alert alert-success">
						{{ session('success') }}
					</div>
				@endif

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
										@if ($errors->any())
											<div class="alert alert-danger">
												<ul class="mb-0">
													@foreach ($errors->all() as $error)
														<li>{{ $error }}</li>
													@endforeach
												</ul>
											</div>
										@endif

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

										<h5 class="mt-4 mb-3">Ukuran (Cm)</h5>

										<div class="mb-3 ukuran-field" data-jenis="kemeja,gaun,kebaya">
											<label for="lingkar_dada" class="form-label">Lingkar Dada</label>
											<input type="number" step="0.1" name="lingkar_dada" id="lingkar_dada" class="form-control" value="{{ old('lingkar_dada') }}">
										</div>

										<div class="mb-3">
											<label for="lingkar_pinggang" class="form-label">Lingkar Pinggang</label>
											<input type="number" step="0.1" name="lingkar_pinggang" class="form-control">
										</div>

										<div class="mb-3">
											<label for="lingkar_pinggul" class="form-label">Lingkar Pinggul</label>
											<input type="number" step="0.1" name="lingkar_pinggul" class="form-control">
										</div>

										<div class="mb-3 ukuran-field" data-jenis="gaun,kebaya">
											<label for="panjang_baju" class="form-label">Panjang Baju</label>
											<input type="number" step="0.1" name="panjang_baju" id="panjang_baju" class="form-control" value="{{ old('panjang_baju') }}">
										</div>	

										<div class="mb-3">
											<label for="panjang_lengan" class="form-label">Panjang Lengan</label>
											<input type="number" step="0.1" name="panjang_lengan" class="form-control">
										</div>

										<div class="mb-3">
											<label for="lebar_bahu" class="form-label">Lebar Bahu</label>
											<input type="number" step="0.1" name="lebar_bahu" class="form-control">
										</div>

										<div class="mb-3">
											<label for="lingkar_lengan" class="form-label">Lingkar Lengan</label>
											<input type="number" step="0.1" name="lingkar_lengan" class="form-control">
										</div>

										<div class="mb-3">
											<label for="lingkar_pergelangan" class="form-label">Lingkar Pergelangan</label>
											<input type="number" step="0.1" name="lingkar_pergelangan" class="form-control">
										</div>

										<div class="mb-3">
											<label for="tinggi_badan" class="form-label">Tinggi Badan</label>
											<input type="number" step="0.1" name="tinggi_badan" class="form-control">
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

	<script>
	function updateUkuranTemplate() {
		const selectedJenis = document.getElementById("jenis_pakaian").value;
		const ukuranFields = document.querySelectorAll(".ukuran-field");

		ukuranFields.forEach(field => {
			const jenisList = field.dataset.jenis.split(',');
			if (jenisList.includes(selectedJenis)) {
				field.style.display = 'block';
			} else {
				field.style.display = 'none';
				const input = field.querySelector("input");
				if (input) input.value = ''; // reset nilai jika disembunyikan
			}
		});
	}

	// Panggil saat halaman dimuat
	document.addEventListener("DOMContentLoaded", () => {
		updateUkuranTemplate(); // inisialisasi
		document.getElementById("jenis_pakaian").addEventListener("change", updateUkuranTemplate);
	});
	</script>

</body>

</html>
