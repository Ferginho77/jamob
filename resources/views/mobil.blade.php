@extends('layouts.app')

@section('title', 'PDAM TIRTA RAHARJA')

@section('content')
<div class="container">
        <div class="py-5 text-center bg-image img-fluid">
            <div class="text-black"><h1>MOBIL TERSEDIA</h1></div>
        </div>
        <div class="row">
            @foreach ($mobils as $x)
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="{{ asset('img/' . $x->gambar) }}" class="card-img-top img-fluid pt-3" alt="Mobil Image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $x->nama_mobil }}</h5>
                            <p class="card-text">{{ $x->plat_nomor }}</p>
                            <p class="card-text">Warna: {{ $x->warna }}</p>
                            <p class="card-text">Status: {{ $x->status }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
@endsection