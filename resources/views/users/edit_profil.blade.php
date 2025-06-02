@include('layout.header')
<body class="index-page">

  <main class="main">
<br><br><br><br>
    
<div class="container mt-5">
    <h2>Edit Profil</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('user.profil.updateProfil') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" name="nama" value="{{ old('nama', $user->nama) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="no_hp" class="form-label">No HP</label>
            <input type="text" class="form-control" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('user.profil') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
  </main>


  @include('layout.script')
</body>
</html>
