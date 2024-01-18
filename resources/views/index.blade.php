@extends('layouts.navbar')

@section('content')
<div class="container">
    <h1>Halaman Utama</h1>

           @if(session('success'))
            <script>
                alert("{{ session('success') }}");
            </script>
        @endif

    <div class="row">
        @forelse($barangs as $barang)
            <div class="col-md-4 mb-4">
                @include('component.card', ['store' => $barang->store, 'barang' => $barang])
            </div>
        @empty
            <p>Belum ada barang yang tersedia.</p>
        @endforelse
    </div>
</div>
@endsection

