<div class="modal fade show" id="detail-modal"  aria-modal="true" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail transaksi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div id="content-modal" class="modal-body">

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="btn-accept" class="btn btn-primary">Save</button>
            </div>
        </div>

    </div>
</div>


<script>
    function showModal() {
        const jumlahBeliInputs = document.querySelectorAll('input[name="jumlah_beli_produk[]"]');
        const id_user = document.getElementById('id_user').value;
        let allFilled = true;

        jumlahBeliInputs.forEach(input => {
            if (input.value === '') {
                allFilled = false;
            }
        });
        if (id_user == '') {
            Swal.fire({
            title: "Oops!",
            text: "Anda belum memilih member",
            icon: "error",
            confirmButtonText: "Close",
            });
        }else if(!allFilled){
            Swal.fire({
            title: "Oops!",
            text: "Jumlah Beli Tidak Boleh Kosong",
            icon: "error",
            confirmButtonText: "Close",
            });
        }else{
            $('#detail-modal').modal('show');
            const userId = document.getElementById('id_user').value;
            const userName = document.querySelector(`#id_user option[value="${userId}"]`).textContent;
            const tanggalTransaksi = document.getElementById('tanggal_transaksi').value;
            const totalPoin = document.getElementById('total_poin').value;
            const totalTransaksi = document.getElementById('total_transaksi').value;
            const poinDiperoleh = document.getElementById('poin_diperoleh').value;
            const poinDitukar = document.getElementById('poin_ditukar').value;

            let produkDetails = '';
            for (let i = 1; i <= produkCount; i++) {
                const produkId = document.getElementById(`produk_id_${i}`).value;
                const produkNama = document.querySelector(`#produk_id_${i} option[value="${produkId}"]`).textContent;
                const jumlahBeli = document.getElementById(`jumlah_beli_produk_${i}`).value;

                produkDetails += `
                    <tr>
                        <td>${i}</td>
                        <td>${produkNama}</td>
                        <td>${jumlahBeli}</td>
                    </tr>
                `;
            }

            const modalContent = `
                <table class="table">
                    <tr>
                        <th>Nama</th>
                        <td>${userName}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Transaksi</th>
                        <td>${tanggalTransaksi}</td>
                    </tr>
                    <tr>
                        <th>Total Poin Dimiliki</th>
                        <td>${totalPoin}</td>
                    </tr>
                    <tr>
                        <th>Total Transaksi</th>
                        <td>${totalTransaksi}</td>
                    </tr>
                    <tr>
                        <th>Poin Diperoleh</th>
                        <td>${poinDiperoleh}</td>
                    </tr>
                    <tr>
                        <th>Poin Ditukar</th>
                        <td>${poinDitukar}</td>
                    </tr>
                    <tr>
                        <th>Produk</th>
                        <td>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Produk</th>
                                        <th>Jumlah Beli</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${produkDetails}
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
            `;

            document.getElementById('content-modal').innerHTML = modalContent;
        }
        
    }
</script>