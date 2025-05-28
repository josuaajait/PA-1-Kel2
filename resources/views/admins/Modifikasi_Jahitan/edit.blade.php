
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
    <h2>Edit Modifikasi Jahitan</h2>
    <form action="{{ route('modifikasi-jahitan.update', $modifikasi->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $modifikasi->nama }}" required>
        </div>
        <div class="mb-3">
            <label>Jenis Pakaian</label>
            <input type="text" name="jenis_pakaian" class="form-control" value="{{ $modifikasi->jenis_pakaian }}" required>
        </div>
        <div class="mb-3">
            <label>Catatan</label>
            <textarea name="catatan" class="form-control" rows="4" required>{{ $modifikasi->catatan }}</textarea>
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('modifikasi-jahitan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</main>
@include('layout.adminscript')
    
</body>

@include('layout.adminfooter')
</html>
