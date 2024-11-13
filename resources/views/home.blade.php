@extends('layouts.app')

@section('title', 'PDAM TIRTA RAHARJA')

@section('content')

    <div class="container">
        <div class="py-5 text-center bg-image img-fluid">
            <img src="/img/car0.png" class="img-fluid" alt="Mobil Image">
            <div class="text-black"><h1>PEMINJAMAN MOBIL</h1></div>
        </div>

        <div class="container mb-3">
            <div class="row">
                <div class="col text-center">
                    <button id="pilihHariBtn" class="btn btn-primary px-5 mb-5">Pilih Hari</button>
                </div>
            </div>
            <form action="" method="get">
                <div id="hariPilihan" class="row" style="display: none;">
                    <div class="col text-center">
                        <button type="submit" name="tanggal_pinjam" value="senin" class="btn btn-secondary px-5">Senin</button>
                    </div>
                    <div class="col text-center">
                        <button type="submit" name="tanggal_pinjam" value="selasa" class="btn btn-secondary px-5">Selasa</button>
                    </div>
                    <div class="col text-center">
                        <button type="submit" name="tanggal_pinjam" value="rabu" class="btn btn-secondary px-5">Rabu</button>
                    </div>
                    <div class="col text-center">
                        <button type="submit" name="tanggal_pinjam" value="kamis" class="btn btn-secondary px-5">Kamis</button>
                    </div>
                    <div class="col text-center">
                        <button type="submit" name="tanggal_pinjam" value="jumat" class="btn btn-secondary px-5">Jumat</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="row">
            @foreach ($mobils as $mobil)
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="{{ asset('img/' . $mobil->gambar) }}" class="card-img-top img-fluid pt-3" alt="Mobil Image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $mobil->nama_mobil }}</h5>
                            <p class="card-text">{{ $mobil->plat_nomor }}</p>
                            <p class="card-text">Warna: {{ $mobil->warna }}</p>
                            <p class="card-text">Status: {{ $mobil->status }}</p>
                            @if($mobil->status == 'Ada')
                                <!-- Tombol peminjaman aktif jika mobil tersedia -->
                                <button type="button" class="btn btn-primary" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#mobilModal" 
                                    data-nama="{{ $mobil->nama_mobil }}" 
                                    data-plat="{{ $mobil->plat_nomor }}"
                                    data-id="{{ $mobil->id }}"
                                >
                                    Pilih Mobil
                                </button>
                            @elseif($mobil->status == 'Dipinjam')
                                <!-- Tombol dinonaktifkan jika mobil sedang dipinjam -->
                                <button type="button" class="btn btn-primary" disabled>
                                    Sedang Dipinjam Oleh: {{ $mobil->user->username ?? 'Tidak Diketahui' }}
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
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
                        <form id="formPeminjaman" method="POST" action="{{ route('peminjaman.store') }}">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}"> <!-- ID pengguna -->
                            <input type="hidden" id="mobil_id" name="mobil_id"> <!-- ID mobil yang dipilih -->
                            <div class="mb-3">
                                <label for="nama_mobil" class="form-label">Nama Mobil</label>
                                <input type="text" class="form-control" id="nama_mobil" name="nama_mobil" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="plat_nomor" class="form-label">Plat Nomor</label>
                                <input type="text" class="form-control" id="plat_nomor" name="plat_nomor" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
                                <input type="date" class="form-control" id="tanggal_peminjaman" name="tanggal_peminjaman" required readonly>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_pengembalian" class="form-label">Tanggal Pengembalian</label>
                                <input type="date" class="form-control" id="tanggal_pengembalian" name="tanggal_pengembalian" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_pengembalian" class="form-label">Tujuan</label>
                                <select class="form-control" id="tujuan" name="tujuan">
                                    <option value="">Pilih Tujuan</option>
                                    @foreach($wilayah as $x)
                                        <option value="{{ $x->kantor_wilayah }}">{{ $x->kantor_wilayah }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Pinjam Mobil</button>
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

                document.getElementById('pilihHariBtn').addEventListener('click', function () {
                    const hariPilihan = document.getElementById('hariPilihan');
                    if (hariPilihan.style.display === 'none' || !hariPilihan.style.display) {
                        hariPilihan.style.display = 'flex';
                    } else {
                        hariPilihan.style.display = 'none';
                    }
                });

                // Set tanggal pinjam default ke hari ini
                const today = new Date().toISOString().split('T')[0];
                document.getElementById('tanggal_peminjaman').value = today;

                // Menambahkan pembatasan pada tanggal pengembalian
                const tanggalPinjam = document.getElementById('tanggal_peminjaman');
                const tanggalPengembalian = document.getElementById('tanggal_pengembalian');

                // Set event listener pada perubahan tanggal pinjam
                tanggalPinjam.addEventListener('change', function () {
                    const pinjamDate = new Date(tanggalPinjam.value);
                    const maxReturnDate = new Date(pinjamDate);
                    maxReturnDate.setDate(pinjamDate.getDate() + 3); 

                    // Mengubah batasan tanggal pengembalian
                    const maxReturnDateString = maxReturnDate.toISOString().split('T')[0];
                    tanggalPengembalian.setAttribute('max', maxReturnDateString);
                    // Mengubah nilai tanggal pengembalian agar tidak melebihi tanggal max
                    if (new Date(tanggalPengembalian.value) > maxReturnDate) {
                        tanggalPengembalian.value = maxReturnDateString;
                    }
                });
            });
        </script>
@endsection
