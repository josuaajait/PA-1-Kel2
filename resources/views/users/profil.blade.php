@include('layout.header')
<body class="index-page">
  <main class="main">

    <br><br><br><br>
<div class="container mt-5">
    <h2>Profil Pengguna</h2>
    <div class="card p-4">
        <p><strong>Nama:</strong> {{ $user->nama }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Telepon:</strong> {{ $user->no_hp }}</p>
        <p><strong>Role:</strong> {{ $user->role }}</p>
    </div>

    <div class="mt-4">
        <a href="{{ route('user.profil.editProfil') }}" class="btn btn-warning">Edit Profil</a>
        <a href="{{ route('home') }}" class="btn btn-secondary">Kembali ke Beranda</a>
</div>
<br>

  </main>


  @include('layout.script')
</body>
</html>

|

