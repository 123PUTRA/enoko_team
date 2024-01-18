<!-- resources/views/store_form.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Form Pembukaan Toko</h1>

        <!-- Tampilkan pesan sukses atau error -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
@endsection
