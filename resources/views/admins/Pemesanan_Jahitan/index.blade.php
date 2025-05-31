<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Data Pemesanan Jahitan</title>
	<link href="{{ URL::asset('admincss/app.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		
		@include('layout.adminsidebar')

		<div class="main">
			
			@include('layout.adminnavbar')

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Data Pemesanan Jahitan</h1>
					<a href="{{ route('admins.pemesanan-jahitan.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">List Pemesanan</h5>
								</div>
								<div class="card-body">
									@if(session('success'))
										<div class="alert alert-success">
											{{ session('success') }}
										</div>
									@endif

									<div class="table-responsive">
										<table class="table table-striped">
											<thead>
												<tr>
													<th>#</th>
													<th>Nama</th>
													<th>Telepon</th>
													<th>Alamat</th>
													<th>Jenis</th>
													<th>Bahan</th>
													<th>Warna</th>
													<th>Ukuran</th>
													<th>Status</th>
													<th>Referensi Gambar</th>
													<th>Bukti Pembayaran Uang Muka</th>
													<th>Bukti Pembayaran Lunas</th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tbody>
												@foreach($pemesananJahitan as $pemesanan)
													<tr>
														<td>{{ $loop->iteration }}</td>
														<td>{{ $pemesanan->nama }}</td>
														<td>{{ $pemesanan->no_hp }}</td>
														<td>{{ $pemesanan->alamat }}</td>
														<td>{{ $pemesanan->jenis_pakaian }}</td>
														<td>{{ $pemesanan->bahan }}</td>
														<td>{{ $pemesanan->warna }}</td>
													
														<td>
															<button type="button" class="btn btn-sm btn-primary" onclick="showUkuran{{ $pemesanan->pemesanan_jahitan_id }}()">
																Lihat Ukuran
															</button>

															<script>
																function showUkuran{{ $pemesanan->pemesanan_jahitan_id }}() {
																	Swal.fire({
																		title: 'Detail Ukuran',
																		html: `{!! nl2br(e($pemesanan->ukuran)) !!}`,
																		icon: 'info'
																	});
																}
															</script>
														</td>


														<td>
															@if($pemesanan->status == 'pending')
																<span class="badge bg-warning text-dark">Pending</span>
															@elseif($pemesanan->status == 'selesai')
																<span class="badge bg-success">Selesai</span>
															@else
																<span class="badge bg-secondary">Tidak Diketahui</span> <!-- Menangani status lain -->
															@endif
														</td>
														
														<td>
															@if($pemesanan->referensi_gambar)
																<a href="{{ asset('storage/' . $pemesanan->referensi_gambar) }}" target="_blank">
																	Lihat Gambar
																</a>
															@else
																-
															@endif
														</td>

														<td>
															@if($pemesanan->bukti_pembayaran_uang_muka)
																<a href="{{ asset('storage/' . $pemesanan->bukti_pembayaran_uang_muka) }}" target="_blank">
																	Lihat Bukti
																</a>
															@else
																-
															@endif
														</td>

														<td>
															@if($pemesanan->bukti_pembayaran_lunas)
																<a href="{{ asset('storage/' . $pemesanan->bukti_pembayaran_lunas) }}" target="_blank">
																	Lihat Bukti Lunas
																</a>
															@else
																-
															@endif
														</td>


														<td>
															<div class="d-flex gap-1">
																<a href="{{ route('admins.pemesanan-jahitan.show', $pemesanan->pemesanan_jahitan_id) }}" class="btn btn-info btn-sm">Detail</a>
																<a href="{{ route('admins.pemesanan-jahitan.edit', $pemesanan->pemesanan_jahitan_id) }}" class="btn btn-warning btn-sm">Edit</a>
																<form action="{{ route('admins.pemesanan-jahitan.destroy', $pemesanan->pemesanan_jahitan_id) }}" method="POST">
																	@csrf
																	@method('DELETE')
																	<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus data ini?')">Hapus</button>
																</form>
															</div>
														</td>
													</tr>
												@endforeach
											</tbody>
										</table>

										<!-- Pagination -->
										<div class="d-flex justify-content-center mt-4">
											{{ $pemesananJahitan->links() }}
										</div>

									</div>
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
