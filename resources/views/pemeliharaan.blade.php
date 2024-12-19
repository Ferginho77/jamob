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
                            <td>Status</td>
                            <td>Merk Mobil</td>
                            <td>Selesaikan Pemeliharaan</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pemeliharaans as $x)
                        @if($x->mobil->status == 'Rusak')
                            <tr>
                                <td><img src="{{ asset('img/' . $x->kondisi_fisik) }}" alt="Kondisi Fisik" style="max-width: 100px; height: auto;"></td>
                                <td><img src="{{ asset('img/' . $x->bensin) }}" alt="Kondisi Bensin" style="max-width: 100px; height: auto;"></td>
                                <td>{{ $x->deskripsi }}</td>
                                <td class="status">{{ $x->mobil->status }}</td>
                                <td>{{ $x->mobil->nama_mobil }}</td>
                                <td> <button class="btn btn-success btn-ubah-status" data-id="{{ $x->mobil->id }}" type="button">Ubah ke Ada</button></td>
                            </tr>
                        @endif
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.btn-ubah-status');

        buttons.forEach(button => {
            button.addEventListener('click', function () {
                const mobilId = this.getAttribute('data-id');

                fetch("{{ route('mobil.selesaikan') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ mobil_id: mobilId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const row = this.closest('tr');
                        const statusCell = row.querySelector('.status');

                        // Perbarui status di tampilan
                        statusCell.textContent = 'Ada';

                        // Nonaktifkan tombol setelah perubahan
                        this.disabled = true;
                        this.textContent = 'Status Diubah';
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    });
</script>
