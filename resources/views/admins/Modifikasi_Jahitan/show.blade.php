<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Data About Us</title>
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
    <h2>Detail Modifikasi Jahitan</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $modifikasi->nama }}</h5>
            <p><strong>Jenis Pakaian:</strong> {{ $modifikasi->jenis_pakaian }}</p>
            <p><strong>Catatan:</strong><br>{{ $modifikasi->catatan }}</p>
        </div>
    </div>

    <a href="{{ route('modifikasi-jahitan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
</main>
@include('layout.adminscript')
    
</body>

@include('layout.adminfooter')
</html>
