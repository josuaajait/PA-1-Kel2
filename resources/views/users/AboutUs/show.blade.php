@extends('layout.main') {{-- atau sesuaikan layout yang digunakan user --}}

@section('content')
<br><br><br><br>
    <h1>Tentang Kami</h1>
    
    @if ($aboutUs)
        <section>
            <h2>Deskripsi</h2>
            <p>{{ $aboutUs->deskripsi }}</p>

            <h2>Sejarah</h2>
            <p>{{ $aboutUs->sejarah }}</p>

            <h2>Visi</h2>
            <p>{{ $aboutUs->visi }}</p>

            <h2>Misi</h2>
            <p>{{ $aboutUs->misi }}</p>
        </section>
    @else
        <p>Tidak ada informasi yang tersedia saat ini.</p>
    @endif
@endsection
