@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tambah Barang</h1>

        <form action="{{ route('barang.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="nama_barang">Nama Barang:</label>
                <input type="text" name="nama_barang" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <textarea name="deskripsi" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="harga">Harga:</label>
                <input type="number" name="harga" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="quantity">Jumlah Barang:</label>
                <input type="number" name="quantity" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="category">Kategori Barang:</label>
                <input type="text" name="category" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="gambar">Gambar (Multiple):</label>
                <input type="file" name="gambar[]" class="form-control" multiple required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
