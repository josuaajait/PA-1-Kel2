<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Detail Pemesanan</title>
	<link href="{{ URL::asset('admincss/app.css') }}" rel="stylesheet">
</head>

<body>
	<div class="wrapper">

		@include('layout.adminsidebar')

		<div class="main">

			@include('layout.adminnavbar')

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Detail Pemesanan</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-body">
									<table class="table">
										<tr>
											<th>Nama</th>
											<td>{{ $pemesanan->name }}</td>
										</tr>
										<tr>
											<th>Telepon</th>
											<td>{{ $pemesanan->phone }}</td>
										</tr>
										<tr>
											<th>Alamat</th>
											<td>{{ $pemesanan->address }}</td>
										</tr>
										<tr>
											<th>Jenis</th>
											<td>{{ $pemesanan->jenis }}</td>
										</tr>
										<tr>
											<th>Bahan</th>
											<td>{{ $pemesanan->bahan }}</td>
										</tr>
										<tr>
											<th>Warna</th>
											<td>{{ $pemesanan->warna }}</td>
										</tr>
										<tr>
											<th>Ukuran</th>
											<td>{{ $pemesanan->ukuran }}</td>
										</tr>
									</table>
									<a href="{{ route('pemesanans.index') }}" class="btn btn-secondary mt-3">Kembali</a>
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
