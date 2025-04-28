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
					<a href="{{ route('pemesanan-jahitan.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>
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
													<th>Aksi</th>
												</tr>
											</thead>
											<tbody>
												@foreach($pemesananJahit as $pemesanan)
													<tr>
														<td>{{ $loop->iteration }}</td>
														<td>{{ $pemesanan->name }}</td>
														<td>{{ $pemesanan->phone }}</td>
														<td>{{ $pemesanan->address }}</td>
														<td>{{ $pemesanan->jenis }}</td>
														<td>{{ $pemesanan->bahan }}</td>
														<td>{{ $pemesanan->warna }}</td>
														<td>{{ $pemesanan->ukuran }}</td>
														<td>
															<div class="d-flex gap-1">
																<a href="{{ route('pemesanan-jahitan.show', $pemesanan->id) }}" class="btn btn-info btn-sm">Detail</a>
																<a href="{{ route('pemesanan-jahitan.edit', $pemesanan->id) }}" class="btn btn-warning btn-sm">Edit</a>
																<form action="{{ route('pemesanan-jahitan.destroy', $pemesanan->id) }}" method="POST">
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
											{{ $pemesananJahit->links() }}
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
