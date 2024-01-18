@extends('layouts.app')

@section('content')

    <h2>Daftar Barang</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Nama Barang</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Quantity</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barangs as $barang)
                <tr>
                    <td>
                        <img src="{{ asset('uploads/' . $barang->gambar_path) }}" alt="Image" style="max-width: 50px; max-height: 50px;">
                    </td>
                    <td>{{ $barang->nama_barang }}</td>
                    <td>{{ $barang->deskripsi }}</td>
                    <td>{{ $barang->harga }}</td>
                    <td>{{ $barang->quantity }}</td>
                    <td>{{ $barang->category }}</td>
                    <td>
                        <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('barang.destroy', $barang->id) }}" method="post" style="display: inline;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
