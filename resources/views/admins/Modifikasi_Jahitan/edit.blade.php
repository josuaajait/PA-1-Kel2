<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit Data Modifikasi Jahitan: {{ $modifikasiJahitan->nama }}</title>
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
                    <h1 class="h3 mb-3">Edit Data Modifikasi Jahitan</h1>
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Form Edit: {{ $modifikasiJahitan->nama }}</h5>
                                </div>
                                <div class="card-body">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    {{-- Form mengarah ke route update dengan method PUT --}}
                                    <form action="{{ route('admins.modifikasi-jahitan.update', $modifikasiJahitan->id) }}" method="POST">
                                        @csrf
                                        @method('PUT') {{-- Method Spoofing untuk Update --}}

                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Modifikasi <span class="text-danger">*</span></label>
                                            {{-- Isi value dengan data lama atau data dari database --}}
                                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $modifikasiJahitan->nama) }}" required>
                                            @error('nama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="jenis_pakaian" class="form-label">Jenis Pakaian <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('jenis_pakaian') is-invalid @enderror" id="jenis_pakaian" name="jenis_pakaian" value="{{ old('jenis_pakaian', $modifikasiJahitan->jenis_pakaian) }}" required>
                                            @error('jenis_pakaian')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="catatan" class="form-label">Catatan</label>
                                            <textarea class="form-control @error('catatan') is-invalid @enderror" id="catatan" name="catatan" rows="4">{{ old('catatan', $modifikasiJahitan->catatan) }}</textarea>
                                            @error('catatan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-primary">Update Data</button>
                                        <a href="{{ route('admins.modifikasi-jahitan.index') }}" class="btn btn-secondary">Batal</a>
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
