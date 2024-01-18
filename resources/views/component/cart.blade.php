@extends('layouts.navbar') 

@section('content')
    <h2>Shopping Cart</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(count($cart) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $index => $item)
                    <tr>
                        <td>{{ isset($item['nama_barang']) ? $item['nama_barang'] : $item['barang']['nama_barang'] }}</td>
                        <td>Rp{{ isset($item['harga']) ? $item['harga'] : $item['barang']['harga'] }}</td>
                        <td>
                            <form action="{{ route('cart.update', $item->id) }}" method="post">
                                @csrf
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1">
                                <button type="submit">Update</button>
                            </form>
                        </td>
                        <td>Rp{{ isset($item['harga']) ? $item['harga'] * $item['quantity'] : $item['barang']['harga'] * $item['quantity'] }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $item->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div>
            <p>Total Belanja: Rp{{ $total }}</p>
            <form action="{{ route('cart.checkout') }}" method="post">
                @csrf
                <button type="submit">Beli</button>
            </form>
        </div>
    @else
        <p>Keranjang belanja Anda kosong.</p>
    @endif
@endsection


