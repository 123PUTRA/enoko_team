@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Dashboard Toko</h1>

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

        <h2>Informasi Toko:</h2>
        @if($store)
        <p>Nama Toko: {{ $store->name }}</p>
        <p>Kategori: {{ $store->category }}</p>
        <p>Deskripsi: {{ $store->description }}</p>
        <p>NPWP: {{ $store->npwp }}</p>

        <!-- Menampilkan informasi alamat -->
        @if($store->address)
            <h2>Informasi Alamat:</h2>
            <p>Provinsi: {{ $store->address->provinsi->name }}</p>
            <p>Kabupaten: {{ $store->address->kabupaten->name }}</p>
            <p>Kecamatan: {{ $store->address->kecamatan->name }}</p>
        @else
            <p>Alamat belum lengkap. <a href="{{ route('location.form') }}">Lengkapi Alamat</a></p>
        @endif

        <a href="{{ route('barang.create') }}" class="btn btn-primary">Tambah Barang</a>
        <a href="{{ route('barang.index') }}" class="btn btn-info">Lihat Semua Barang</a>
    @endif

    </div>
@endsection
