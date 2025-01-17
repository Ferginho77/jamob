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
                    <a class="small text-black stretched-link" href="/peminjaman">View Details</a>
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
                <div class="card-body">Permintaan : {{ $totalPermintaan }}</div>
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
                <div class="card-body">Pemeliharaan : {{ $totalPemeliharaan }}</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="/pemeliharaan">View Details</a>
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
        <div class="col-xl-8 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Log Pengembalian</h2>
                </div>
                <div class="card-body">
                <div id="table-container" class="table-responsive table-scroll" style="max-height: 550px;">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Mobil</th>
                                <th scope="col">Plat Nomor</th>
                                <th scope="col">Nama Peminjam</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Jam Dikembalikan</th>
                                <th scope="col">Kordinat Pengembalian</th>
                                <th scope="col">Kondisi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengembalians as $x)
                                <tr>
                                    <td>{{ $x->nama_mobil }}</td>
                                    <td>{{ $x->plat_nomor }}</td>
                                    <td>{{ $x->user->username }}</td>
                                    <td>{{ $x->deskripsi }}</td>
                                    <td>{{ $x->created_at }}</td>
                                    <td><a href="https://www.google.com/maps?q={{ $x->location }}" target="_blank">Lihat Lokasi <i class="fa-solid fa-location-dot"></i></a></td>
                                    <td>
                                        <button type="button" class="btn btn-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#kondisiModal"
                                            data-bensin="{{ asset('img/' . $x->bensin) }}"
                                            data-fisik="{{ asset('img/' . $x->kondisi_fisik ) }}"
                                            url-fisik="{{ $x->kondisi_fisik }}"
                                            url-bensin="{{ $x->bensin }}"
                                            url-deskripsi="{{ $x->deskripsi }}"
                                            data-id="{{ $x->mobil_id }}"
                                            data-status="{{ $x->mobil->status }}">
                                            Cek Kondisi
                                            <i class="fa-solid fa-folder-open"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

<div class="modal fade" id="kondisiModal" tabindex="-1" aria-labelledby="mobilModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mobilModalLabel">Foto Mobil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_pemeliharaan" action="{{ route('pemeliharaan') }}" method="POST">
                    @csrf
                    <input type="hidden" id="mobil_id" name="mobil_id" value="">

                    <h4>Kondisi Fisik</h4>
                    <img id="kondisi_fisik" src="" alt="Fisik" style="max-width: 100%; height: auto;">
                    <input type="hidden" id="url_fisik" name="kondisi_fisik" value="">

                    <h4>Kondisi Bensin</h4>
                    <img id="bensin" src="" alt="Bensin" style="max-width: 100%; height: auto;">
                    <input type="hidden" id="url_bensin" name="bensin" value="">
                    <input type="hidden" id="deskripsi" name="deskripsi" value="">
                </form>
            </div>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const kondisiModal = document.getElementById('kondisiModal');

    kondisiModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const kondisi = button.getAttribute('data-fisik');
        const bensin = button.getAttribute('data-bensin');
        const mobilId = button.getAttribute('data-id');
        const deskripsi = button.getAttribute('url-deskripsi');
        const kondisi_fisik = button.getAttribute('url-fisik');
        const url_bensin = button.getAttribute('url-bensin');
        const status = button.getAttribute('data-status');

        const modalKondisiFisik = kondisiModal.querySelector('#kondisi_fisik');
        const modalBensin = kondisiModal.querySelector('#bensin');
        const modalMobilId = kondisiModal.querySelector('#mobil_id');
        const modalUrlFisik = kondisiModal.querySelector('#url_fisik');
        const modalUrlBensin = kondisiModal.querySelector('#url_bensin');
        const modalDeskripsi = kondisiModal.querySelector('#deskripsi'); 

        modalKondisiFisik.src = kondisi;
        modalBensin.src = bensin;
        modalUrlFisik.value = kondisi_fisik;
        modalUrlBensin.value = url_bensin;
        modalMobilId.value = mobilId;
        
       
        modalDeskripsi.innerText = deskripsi; 

        const pemeliharaanButton = document.getElementById('pemeliharaan');

        if (status === 'Rusak') {
            pemeliharaanButton.disabled = true;
            pemeliharaanButton.innerText = "Mobil Sedang Di Perbaiki";
        } else {
            pemeliharaanButton.disabled = false;
        }
    });


});

</script>

@endsection
