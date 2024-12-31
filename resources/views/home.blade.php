@extends('layouts.app')

@section('title', 'PDAM TIRTA RAHARJA')

@section('content')


<div class="container">
    <div class="py-5 text-center bg-image img-fluid">
        <img src="/img/car0.png" class="img-fluid" alt="Mobil Image">
        <div class="text-black"><h1>PENGEMBALIAN MOBIL</h1></div>
    </div>

    <div class="card">
    @if ($peminjamans->isEmpty())
        <div class="card-header" role="alert">
            Tidak ada peminjaman yang sedang berlangsung.
        </div>
    @else
        <div class="row position-relative">
            @foreach ($peminjamans as $peminjaman)
                <div class="col-md-6 p-4">
                    <div class="mb-2 position-relative top-50 start-50 translate-middle">
                        <div class="text-center"> 
                            <img src="{{ asset('img/' . $peminjaman->mobil->gambar) }}" class="card-img-top img-fluid pt-3" alt="{{ $peminjaman->mobil->nama_mobil }}">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $peminjaman->mobil->nama_mobil }}</h5>
                            <p class="card-text">Nama Peminjam : {{ $peminjaman->user->username }}</p>
                            <p class="card-text">Tanggal Pinjam: {{ $peminjaman->tanggal_peminjaman }}</p>
                            <p class="card-text">Tujuan: {{ $peminjaman->tujuan }}</p>

                            @if (Auth::check() && Auth::user()->id === $peminjaman->user_id)
                                <button type="button" class="btn btn-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#mobilModal"
                                    data-id="{{ $peminjaman->mobil_id }}"
                                    data-nama="{{ $peminjaman->mobil->nama_mobil }}"
                                    data-plat="{{ $peminjaman->mobil->plat_nomor }}"
                                    >
                                    <i class="fa-solid fa-car"></i>  Kembalikan
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
    <!-- Modal -->
    <div class="modal fade" id="mobilModal" tabindex="-1" aria-labelledby="mobilModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mobilModalLabel">Form Peminjaman Mobil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                @foreach ($peminjamans as $peminjaman)
                    <form id="formPeminjaman" method="POST" action="{{  route('mobil.kembali', $peminjaman->id) }}" enctype="multipart/form-data">
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
                                <label for="kondisiMobil" class="form-label"><i class="fa-solid fa-camera"></i>  Kondisi Terakhir (Foto)</label>
                                <div class="custom-file-upload">
                                    <input class="form-control" type="file" id="kondisi_fisik" name="kondisi_fisik" accept="image/*">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="kondisiBensin" class="form-label"><i class="fa-solid fa-gas-pump"></i> Bensin (Foto)</label>
                                <div class="custom-file-upload">
                                    <input class="form-control" type="file" id="bensin" name="bensin" accept="image/*">
                                </div>
                            </div>

                        <div class="mb-3">
                            <label for="deskripsiKondisi" class="form-label">Deskripsi Kondisi (optional)</label>
                            <textarea class="form-control" rows="3" id="deskripsiKondisi" name="deskripsiKondisi"></textarea>
                            <input type="text" id="location" name="location">
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                            <input type="hidden" id="mobil_id" name="mobil_id" value="">
                        </div>
                        <button type="submit" name="submit" id="submit" class="btn btn-primary">Kembalikan Mobil</button>
                    </form>
                @endforeach
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

        const lokasi = document.getElementById('location');

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(success, ErrorCall);
            } else {
                alert("Mohon Aktifkan Lokasi Anda");
            }

            function success(position) {
                lokasi.value = position.coords.latitude + ',' + position.coords.longitude;
            }

            function ErrorCall(error) {
            alert("Mohon Aktifkan Lokasi Anda");
            }
    </script>
@endsection
