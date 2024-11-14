@extends('layouts.app')

@section('title', 'PDAM TIRTA RAHARJA')

@section('content')

<div class="container-fluid">
    
    <div class="row mt-5">
        
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body"> Mobil Tersedia : {{ $totalMobil }}</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="/mobil">View Details</a>
                    <div class="small text-white">
                        <svg class="svg-inline--fa fa-angle-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512">
                            <path fill="currentColor" d="M246.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L178.7 256 41.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning mb-4">
                <div class="card-body">Peminjaman : {{ $totalPeminjam }}</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="/peminjaman">View Details</a>
                    <div class="small text-white">
                        <svg class="svg-inline--fa fa-angle-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512">
                            <path fill="currentColor" d="M246.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L178.7 256 41.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">0 Permintaan</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="/permintaan">View Details</a>
                    <div class="small text-white">
                        <svg class="svg-inline--fa fa-angle-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512">
                            <path fill="currentColor" d="M246.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L178.7 256 41.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">0 Pemeliharaan</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white " href="/pemeliharaan">View Details</a>
                    <div class="small text-white">
                        <svg class="svg-inline--fa fa-angle-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512">
                            <path fill="currentColor" d="M246.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L178.7 256 41.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-xl-8 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2>Log Peminjaman</h2>
                </div>
                <div class="card-body">
               
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Mobil</th>
                                <th scope="col">Plat Nomor</th>
                                <th scope="col">Nama Peminjam</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peminjamans as $x)
                                <tr>
                                    <td>{{ $x->mobil->nama_mobil ?? 'N/A' }}</td> <!-- Displaying mobil name -->
                                    <td>{{ $x->mobil->plat_nomor ?? 'N/A' }}</td> <!-- Displaying plat nomor -->
                                    <td>{{ $x->user->username ?? 'N/A' }}</td> <!-- Displaying user name -->
                                    <td>{{ $x->status }}</td> 
                                </tr>
                            @endforeach
                        </tbody>           
                    </table>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2>Laporan</h2>
                </div>
                <div class="card-body">
                    <!-- Report content can be added here -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection