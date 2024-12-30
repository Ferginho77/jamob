@extends('layouts.app')

@section('title', 'Peminjaman | PDAM TIRTA RAHARJA')

@section('content')

<div class="container">
<a href="/dashboard" class="btn btn-danger mt-3">Kembali</a>

<h2 class="text-center">DAFTAR PERMINTAAN PEMINJAMAN MOBIL</h2>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                
                            </tr>
                        </thead>        
                    </table>
                </div>
            </div>
        </div>
</div>

@endsection