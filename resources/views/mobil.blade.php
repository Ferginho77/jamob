@extends('layouts.app')

@section('title', 'Mobil Tersedia | PDAM TIRTA RAHARJA')

@section('content')
<div class="container">
<a href="/dashboard" class="btn btn-danger mt-3">Kembali</a>
    <div class="pb-5 text-center bg-image img-fluid">
        <div class="text-black"><h1>MOBIL TERSEDIA</h1></div>
    </div>
    <div class="row">
        @foreach ($mobils as $x)
            @if ($x->status == 'Ada')
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('img/' . $x->gambar) }}" class="card-img-top img-fluid pt-3" alt="Mobil Image">
                    <div class="card-body d-flex flex-column"> 
                        <h5 class="card-title">{{ $x->nama_mobil }}</h5>
                        <p class="card-text">{{ $x->plat_nomor }}</p>
                        <p class="card-text">Warna: {{ $x->warna }}</p>
                        <p class="card-text">Status:
                            <span class="text-success">{{ $x->status }}</span>
                        </p>
                    </div>
                </div>
            </div>
            @endif
        @endforeach
    </div>
</div>
@endsection
