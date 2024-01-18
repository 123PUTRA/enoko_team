@extends('layouts.navbar')

@section('content')
    <div class="container">
        <h1>Detail Toko</h1>

        <div class="card">
            <div class="card-body">
                <img src="{{ asset($store->image_path) }}" class="card-img-top" alt="Image" style="object-fit: cover; height: 200px;">
                <h2 class="card-title">{{ $store->name }}</h2>
                <p class="card-text">Category UMKM: {{ $store->category }}</p>
                <p class="card-text">Deskripsi Toko: {{ $store->description }}</p>
            </div>
        </div>

        <h2 class="mt-4">Barang-barang:</h2>
        <div class="row">
            @foreach($barangs as $barang)
                <div class="col-md-4 mb-4">
                    <img src="{{ asset('uploads/' . $barang->gambar_path) }}" class="card-img-top" alt="Image" style="object-fit: cover; height: 200px;">
                    <div class="card">
                      <div class="card-body">
                            <h5 class="card-title">{{ $barang->nama_barang }}</h5>
                            <p class="card-text">Deskripsi: {{ $barang->deskripsi }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
