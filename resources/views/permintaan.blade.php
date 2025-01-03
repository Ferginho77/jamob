@extends('layouts.app')

@section('title', 'Peminjaman | PDAM TIRTA RAHARJA')

@section('content')

<div class="container">
    <a href="/dashboard" class="btn btn-danger mt-3"><i class="fa-solid fa-arrow-left"></i>  Kembali</a>
    <button type="button" class="btn btn-success mt-3"
        data-bs-toggle="modal"
        data-bs-target="#Permintaan"
        ><i class="fa-solid fa-plus"></i>  Buat Data Permintaan</button>
        <div class="modal fade" id="Permintaan" tabindex="-1" aria-labelledby="PermintaanLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="PermintaanLabel">Form Permintaan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    <div class="modal-body">
                        <form  action="{{  route('create.permintaan') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="">Nama Peminjam</label>
                                <select class="form-control" name="user_id" id="">
                                    @foreach($users as $x)
                                    <option value="{{ $x->id }}">{{ $x->username }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="mb-3">
                                <label  class="form-label">Pilih Mobil</label>
                                <select class="form-control"  name="mobil_id">
                                    <option value="">-- Pilih Mobil --</option>
                                    @foreach ($mobils as $mobil)
                                        @if ($mobil->status == 'Ada')
                                            <option value="{{ $mobil->id }}">{{ $mobil->nama_mobil }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="">Nomor SPPD</label>
                                <input type="text" name="nomor_sppd" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="">Tanggal Peminjaman</label>
                                <input class="form-control" type="date" name="tanggal_peminjaman" id="">
                            </div>
                            <div class="mb-3">
                                <label for="">Deskripsi Kegiatan</label>
                                <input class="form-control" type="text" name="deskripsi">
                            </div>
                            <div class="mb-3">
                                <label for="">Tujuan</label>
                                <input type="text" name="tujuan" class="form-control">
                            </div>
                            <button type="submit" name="submit" class="btn btn-success">Kirim Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <div class="pb-5 text-center bg-image img-fluid">
        <div class="text-black mt-3">
            <h1>DAFTAR PERMINTAAN PEMINJAMAN KENDARAAN</h1>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>Nama Peminjam</td>
                        <td>Nomor SPPD Peminjam</td>
                        <td>Tanggal Peminjaman</td>
                        <td style="width:30%">Deskripsi Kegiatan</td>
                        <td>Tujuan</td>
                        <td>Terima/Tolak Permintaan</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($permintaans as $x)
                        <tr>
                            <td>{{ $x->user ? $x->user->username : 'User tidak ditemukan' }}</td>
                            <td>{{ $x->nomor_sppd }}</td>
                            <td>{{ $x->tanggal_peminjaman }}</td>
                            <td>{{ $x->deskripsi }}</td>
                            <td>{{ $x->tujuan }}</td>
                            <td>
                                <!-- Tombol Check -->
                                <div style="display: flex; justify-content: center; align-items: center; height: 100%;">
                                <form action="{{ route('permintaan.approve', $x->id) }}" method="POST" style="display:inline; text-align:center; width: 100%;">
                                    @csrf
                                        <button type="submit" class="btn btn-success" onclick="return confirm('Apakah Data Sudah Sesuai?')" style="margin: 0 auto;">
                                            <i class="fa-solid fa-check"></i>
                                        </button>
                                </form>
                                <b>/</b>
                                <!-- Tombol Xmark -->
                                <form action="{{ route('permintaan.delete', $x->id) }}" method="POST" style="display:inline; text-align:center; width: 100%;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data?')">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </form>
                            </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>


            </table>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
            const Permintaan = document.getElementById('Permintaan');
        });
</script>
@endsection
