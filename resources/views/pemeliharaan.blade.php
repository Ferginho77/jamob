@extends('layouts.app')

@section('title', 'PDAM TIRTA RAHARJA')

@section('content')

    <div class="container">
    <a href="/dashboard" class="btn btn-danger mt-3">Kembali</a>

        <h2 class="text-center">DATA PEMELIHARAAN MOBIL</h2>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <td>Merk Mobil</td>
                            <td>Deskripsi</td>
                            <td>Status</td>
                            <td>Selesaikan Pemeliharaan</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pemeliharaans as $x)
                        @if($x->mobil->status == 'Rusak')
                            <tr>
                                <td>{{ $x->mobil->nama_mobil }}</td>
                                <td>{{ $x->deskripsi }}</td>
                                <td class="status">{{ $x->mobil->status }}</td>
                                <td> <button class="btn btn-success btn-ubah-status" data-id="{{ $x->mobil->id }}" type="button">Selesaikan</button></td>
                            </tr>
                        @endif
                        @endforeach
                    </tbody>

                </table>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
   document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.btn-ubah-status');
    const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : null;

    if (!csrfToken) {
        console.error('CSRF token not found in meta tag!');
        return;
    }

    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const mobilId = this.getAttribute('data-id');

            fetch("{{ route('selesaikan') }}", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ mobil_id: mobilId })
            })
            .then(data => {
                Swal.fire({
                    title: "Data Berhasil Dikirim!",
                    icon: "success"
                });
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            });
        });
    });
});


</script>
