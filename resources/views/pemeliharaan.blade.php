@extends('layouts.app')

@section('title', 'PDAM TIRTA RAHARJA')

@section('content')

    <div class="container">
    <a href="/dashboard" class="btn btn-danger mt-3">Kembali</a>

        <h2 class="text-center">DATA PEMELIHARAAN MOBIL</h2>
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <td>Kondisi Fisik</td>
                            <td>Kondisi Bensin</td>
                            <td>Deskripsi</td>
                            <td>Merk Mobil</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pemeliharaans as $x)
                            <tr>
                                <td><img src="{{ asset('img/' . $x->kondisi_fisik) }}" alt="Kondisi Fisik" style="max-width: 100px; height: auto;"></td>
                                <td><img src="{{ asset('img/' . $x->bensin) }}" alt="Kondisi Bensin" style="max-width: 100px; height: auto;"></td>
                                <td>{{ $x->deskripsi }}</td>
                                <td>{{ $x->mobil->nama_mobil }}</td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
