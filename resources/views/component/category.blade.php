@extends('layouts.navbar')

@section('content')
    <h2>Barang dengan Kategori {{ $category }}</h2>

    <div class="row">
        @foreach($barangs as $barang)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('uploads/' . $barang->gambar_path) }}" class="card-img-top" alt="Image" style="object-fit: cover; height: 200px;">
                    <h5 class="card-title">
                        <a href="{{ route('store.detail', ['storeId' => $barang->store->id]) }}">{{ $barang->store->name }}</a>
                    </h5>
                    <div class="card-body">
                        <h5 class="card-title">{{ $barang->nama_barang }}</h5>
                        <p class="card-text">{{ $barang->deskripsi }}</p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Harga: {{ $barang->harga }}</li>
                            <li class="list-group-item">Quantity: {{ $barang->quantity }}</li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('barang.addToCart', $barang->id) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                        </form>
                        <a href="{{ route('cart.show') }}" class="btn btn-warning">Beli</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
