@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Buka Toko</h1>
        <form action="{{ route('store.open_store_submit') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="nama_toko">Nama Toko:</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="category_umkm">Category UMKM:</label>
                <select name="category" class="form-control" required>
                    <option value="menengah">UMKM Menengah</option>
                    <option value="kecil">UMKM Kecil</option>
                </select>
            </div>

            <div class="form-group">
                <label for="deskripsi_toko">Deskripsi Toko:</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="npwp">NPWP:</label>
                <input type="text" name="npwp" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="gambar_toko">Gambar Toko:</label>
                <input type="file" name="store_image" class="form-control-file" accept="image/*" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
