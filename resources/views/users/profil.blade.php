@extends('layout.main')

@section('content')
<br><br><br><br>
<div class="container mt-5">
    <h2>Profil Pengguna</h2>
    <div class="card p-4">
        <p><strong>Nama:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Role:</strong> {{ $user->role }}</p>
    </div>
</div>
@endsection
