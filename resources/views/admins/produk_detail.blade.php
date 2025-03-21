@extends('layout.admin') {{-- This ensures the layout is applied --}}

@section('title', 'Detail Produk')

@section('content')
<div class="container">
    <h1>Detail Produk</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $produk->name }}</h5>
            <p class="card-text"><strong>Description:</strong> {{ $produk->description }}</p>
            <p class="card-text"><strong>Price:</strong> ${{ $produk->price }}</p>
            <img src="{{ asset('storage/' . $produk->image) }}" class="img-fluid" style="max-width: 300px;" alt="{{ $produk->name }}">
        </div>
    </div>

    <a href="{{ route('admins.produk.index') }}" class="btn btn-secondary mt-3">Back to Products</a>
</div>
@endsection
