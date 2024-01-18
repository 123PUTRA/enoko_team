@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Lokasi yang Sudah Disimpan:</h2>

        <p>Provinsi: {{ $selectedLocation->province }}</p>
        <p>Kabupaten/Kota: {{ $selectedLocation->city }}</p>
        <p>Kecamatan: {{ $selectedLocation->district }}</p>

        <a href="{{ route('show.location_form') }}" class="btn btn-primary">Ubah Lokasi</a>
    </div>
@endsection



