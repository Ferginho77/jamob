@extends('layouts.app')

@section('title', 'PDAM TIRTA RAHARJA')

@section('content')

<div class="container">
    <div class="py-5 text-center bg-image img-fluid">
        <img src="/img/car0.png" class="img-fluid" alt="Mobil Image">
        <div class="text-black"><h1>PEMINJAMAN MOBIL</h1></div>
    </div>

    @foreach ($peminjamans as $peminjaman)
        @if (Auth::check() && Auth::user()->id === $peminjaman->user_id)
            <button type="button" class="btn btn-primary" 
                data-bs-toggle="modal" 
                data-bs-target="#mobilModal" 
                data-id="{{ $peminjaman->mobil_id }}"
                data-nama="{{ $peminjaman->mobil->nama_mobil }}" 
                data-plat="{{ $peminjaman->mobil->plat_nomor }}">
                Kembalikan
            </button>
        @endif
    @endforeach  

    <!-- Modal -->
    <div class="modal fade" id="mobilModal" tabindex="-1" aria-labelledby="mobilModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mobilModalLabel">Form Peminjaman Mobil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formPeminjaman" method="POST" action="{{ route('pengembalian.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_mobil" class="form-label">Nama Mobil</label>
                            <input type="text" class="form-control" id="nama_mobil" name="nama_mobil" value="" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="plat_nomor" class="form-label">Plat Nomor</label>
                            <input type="text" class="form-control" id="plat_nomor" name="plat_nomor" value="" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_pengembalian" class="form-label">Tanggal Pengembalian</label>
                            <input type="date" class="form-control" id="tanggal_pengembalian" name="tanggal_pengembalian" required>
                        </div>
                        <div class="mb-3">
                            <label for="kondisiMobil" class="form-label">Kondisi Terakhir (Foto)</label>
                            <input class="form-control" type="file" id="kondisiMobil" name="kondisiMobil" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="kondisiBensin" class="form-label">Bensin (Foto)</label>
                            <input class="form-control" type="file" id="kondisiBensin" name="kondisiBensin" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="deskripsiKondisi" class="form-label">Deskripsi Kondisi (optional)</label>
                            <textarea class="form-control" rows="3" id="deskripsiKondisi" name="deskripsiKondisi"></textarea>
                            <input type="text" name="user_id" value="{{ Auth::id() }}">
                            <input type="text" id="mobil_id" name="mobil_id" value="">
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Kembalikan Mobil</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mobilModal = document.getElementById('mobilModal');

            mobilModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const namaMobil = button.getAttribute('data-nama');
                const platNomor = button.getAttribute('data-plat');
                const mobilId = button.getAttribute('data-id');

                const modalNamaMobil = mobilModal.querySelector('#nama_mobil');
                const modalPlatNomor = mobilModal.querySelector('#plat_nomor');
                const modalMobilId = mobilModal.querySelector('#mobil_id');

                modalNamaMobil.value = namaMobil;
                modalPlatNomor.value = platNomor;
                modalMobilId.value = mobilId;
            });
        });
    </script>
@endsection