@extends('layouts.app')

@section('title', 'Mobil Tersedia | PDAM TIRTA RAHARJA')

@section('content')
<div class="container">
<a href="/dashboard" class="btn btn-danger mt-3"><i class="fa-solid fa-arrow-left"></i> Kembali</a>

    <button class="btn btn-primary mt-3 ms-auto"
    data-bs-toggle="modal"
    data-bs-target="#FormModal"
    ><i class="fa-solid fa-plus"></i> Tambah Mobil</button>

    <button class="btn btn-info mt-3"
     data-bs-toggle="modal"
    data-bs-target="#Pemeliharaan"
    ><i class="fa-solid fa-plus"></i> Buat Pemeliharaan</button>

    <div class="pb-5 text-center bg-image img-fluid mt-3">
        <div class="text-black"><h1>MOBIL TERSEDIA</h1></div>
    </div>
    <div class="row">
        @foreach ($mobils as $x)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('img/' . $x->gambar) }}" class="card-img-top img-fluid pt-3" alt="Mobil Image">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $x->nama_mobil }}</h5>
                        <p class="card-text">{{ $x->plat_nomor }}</p>
                        <p class="card-text">Warna: {{ $x->warna }}</p>
                        <p class="card-text">Status:
                        <span class="{{ $x->status === 'Ada' ? 'text-success' : ($x->status === 'Rusak' ? 'text-danger' : ($x->status === 'Dipinjam' ? 'text-primary' : 'text-secondary')) }}">
                            {{ $x->status }}
                        </span>
                    </p>
                    <button class="btn 
                        {{ $x->status === 'Ada' ? 'btn-secondary' : 
                            ($x->status === 'Rusak' ? 'btn-danger' : 
                            ($x->status === 'Dipinjam' ? 'btn-primary' : 'btn-success')) }} ubah-status"
                        data-id="{{ $x->id }}"
                        {{ $x->status === 'Rusak' ? 'disabled' : '' }}
                        {{ $x->status === 'Dipinjam' ? 'disabled' : '' }}>
                        {{ $x->status === 'Ada' ? 'Non Aktifkan Kendaraan' : 
                            ($x->status === 'Rusak' ? 'Mobil Sedang Di Perbaiki' : 
                            ($x->status === 'Dipinjam' && $x->peminjaman ? 'Mobil Sedang Dipinjam Oleh : ' . $x->peminjaman->user->username : 'Aktifkan Kendaraan')) }}
                    </button>


                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
                    {{-- MODAL DISINI SEMUA --}}
<div class="modal fade" id="FormModal" tabindex="-1" aria-labelledby="FormModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="FormModalLabel">Form Penambahan Mobil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    <form  action="{{  route('tambah.mobil') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_mobil" class="form-label">Nama Mobil</label>
                            <input type="text" class="form-control" id="nama_mobil" name="nama_mobil" value="" >
                        </div>
                        <div class="mb-3">
                            <label for="plat_nomor" class="form-label">Plat Nomor</label>
                            <input type="text" class="form-control" id="plat_nomor" name="plat_nomor" value="" >
                        </div>
                        <div class="mb-3">
                            <label for="warna" class="form-label">Warna</label>
                            <input type="text" class="form-control" id="warna" name="warna" value="" >
                        </div>
                        <div class="mb-3">
                            <label for="">Foto Mobil</label>
                            <input class="form-control" type="file" id="gambar" name="gambar" accept="image/*">
                            <span>*foto minimal berukuran 300x192</span>
                        </div>
                        <button type="submit" name="submit" class="btn btn-success">Kirim Data</button>
                    </form>
                </div>
        </div>
    </div>
</div>

{{-- MODAL PEMELIHARAAN --}}
<div class="modal fade" id="Pemeliharaan" tabindex="-1" aria-labelledby="PemeliharaanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="PemeliharaanLabel">Form Pemeliharaan Mobil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            <div class="modal-body">
                <form action="{{ route('pemeliharaan') }}" method="POST">
                    @csrf
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
                        <label for="">Deskripsi Kerusakan</label>
                        <input type="text" name="deskripsi" class="form-control">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Kirim</button>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
            const FormModal = document.getElementById('FormModal');
        });
document.addEventListener('DOMContentLoaded', function () {
            const FormModal = document.getElementById('Pemeliharaan');
        });


        document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = getCsrfToken();
    if (!csrfToken) return;

    const buttons = document.querySelectorAll('.ubah-status');
    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const mobilId = this.getAttribute('data-id');
            handleStatusChange(mobilId, csrfToken, this);
        });
    });
});

function getCsrfToken() {
    const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
    if (!csrfTokenMeta) {
        console.error('CSRF token not found in meta tag!');
        return null;
    }
    return csrfTokenMeta.getAttribute('content');
}

function handleStatusChange(mobilId, csrfToken, button) {
    fetch("{{ route('nonaktif') }}", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify({ mobil_id: mobilId }),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateButtonStatus(button, data.new_status);
                displaySuccessMessage("Status berhasil diperbarui!");
            } else {
                displayErrorMessage("Gagal memperbarui status.");
            }
        });
}

function updateButtonStatus(button, newStatus) {
    button.classList.toggle('btn-secondary', newStatus === 'Ada');
    button.classList.toggle('btn-success', newStatus === 'NonAktif');
    button.classList.toggle('btn-danger', newStatus === 'Rusak');
    button.classList.toggle('btn-primary', newStatus === 'Dipinjam');  
    button.disabled = newStatus === 'Rusak' || newStatus === 'Dipinjam';  

    button.textContent = newStatus === 'Ada' ? 'Non Aktifkan Kendaraan' :
                         newStatus === 'Rusak' ? 'Mobil Sedang Di Perbaiki' : 
                         newStatus === 'Dipinjam' ? 'Mobil Sedang Dipinjam' : 'Aktifkan Kendaraan';

    const statusSpan = button.closest('.card-body').querySelector('span');
    statusSpan.textContent = newStatus;
    statusSpan.classList.toggle('text-success', newStatus === 'Ada');
    statusSpan.classList.toggle('text-danger', newStatus === 'Rusak');
    statusSpan.classList.toggle('text-secondary', newStatus === 'NonAktif');
    statusSpan.classList.toggle('text-primary', newStatus === 'Dipinjam'); 
}

function displaySuccessMessage(message) {
    Swal.fire({
        title: message,
        icon: "success",
    });
}

function displayErrorMessage(message) {
    Swal.fire({
        title: message,
        icon: "error",
    });
}

</script>
@endsection
