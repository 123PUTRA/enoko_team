@extends('layouts.navbar')

@section('content')
    <div class="container">
        <h2>Hasil Pencarian</h2>

        <div class="row">
            @forelse($barangs as $barang)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('uploads/' . $barang->gambar_path) }}" class="card-img-top" alt="Image" style="object-fit: cover; height: 200px;">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ route('store.detail', ['storeId' => $barang->store->id]) }}">{{ $barang->store->name }}</a>
                            </h5>
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
            @empty
                <div class="col-md-12">
                    <p>Tidak ada hasil pencarian.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
