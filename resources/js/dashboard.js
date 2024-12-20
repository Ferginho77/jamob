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
        const status = button.getAttribute('data-status')

        const modalKondisiFisik = kondisiModal.querySelector('#kondisi_fisik');
        const modalBensin = kondisiModal.querySelector('#bensin');
        const modalMobilId = kondisiModal.querySelector('#mobil_id');
        const modalUrlFisik = kondisiModal.querySelector('#url_fisik');
        const modalUrlBensin = kondisiModal.querySelector('#url_bensin');
        const modalDeskripsi = kondisiModal.querySelector('#deskripsi');
        // const modalstatus = kondisiModal.querySelector('#status');

        modalKondisiFisik.src = kondisi;
        modalBensin.src = bensin;
        modalUrlFisik.value = kondisi_fisik;
        modalUrlBensin.value = url_bensin;
        modalDeskripsi.value = deskripsi;
        modalMobilId.value = mobilId;
        // modalstatus.value = status;

        const pemeliharaanButton = document.getElementById('pemeliharaan');

        if (status === 'Rusak') {
            pemeliharaanButton.disabled = true;
            pemeliharaanButton.innerText = "Mobil Sedang Di Perbaiki";
        } else {
            pemeliharaanButton.disabled = false;
        }
    });


});
    document.getElementById("pemeliharaan").onclick = function(event) {
        event.preventDefault();

        var formData = new FormData(document.getElementById("form_pemeliharaan"));

        fetch("{{ route('pemeliharaan') }}" ,{
            method: 'POST',
            body: formData
        })
        .then(data => {
            Swal.fire({
                title: "Data Berhasil Dikirim!",
                icon: "success"
            });
            setTimeout(() => {
                        window.location.reload();
                    }, 1000);
            });
        };