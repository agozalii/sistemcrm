<div class="modal fade" id="editTransaksi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content me-5" style="width: 700px;">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $title }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{route('updateTransaksi', $data->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label">Nama Member</label>
                        <div class="col-sm-7">
                            <select class="form-control" id="nama_pelanggan" name="nama_pelanggan">
                                <option value="">Pilih Nama Member</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $data->user_id == $user->id ? 'selected' : '' }}>{{ $user->nama }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="tanggal_transaksi" class="col-sm-5 form-label">Tanggal Transaksi</label>
                        <div class="col-sm-7">
                        <input type="date" class="form-control" id="tanggal_transaksi" name="tanggal_transaksi" value="{{$data->tanggal_transaksi}}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="total_poin" class="col-sm-5 form-label">Total Poin Dimiliki</label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control" id="total_poin" name="total_poin" value="{{$data->user->poin}}" readonly>
                        <input type="hidden" class="form-control" id="poin_awal" name="poin_awal" value="{{$data->user->poin}}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label">Total Transaksi</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" id="total_transaksi" name="total_transaksi"  value="{{$data->total}}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label">Poin Diperoleh</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" id="poin_diperoleh" name="poin_diperoleh"
                            value="{{$data->poin_diperoleh}}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="poin_ditukar" class="col-sm-5 form-label">Poin Ingin Ditukar</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="poin_ditukar" name="poin_ditukar">
                        </div>
                    </div>
                    @foreach ($data->detail as $key => $d)
                    <div class="mb-3 row">
                        <label for="produk_id_{{ $key+1 }}" class="col-sm-5 form-label">Produk ID {{ $key+1 }}</label>
                        <div class="col-sm-7">
                        <select class="form-select" id="produk_id_{{ $key+1 }}" name="produk_id[]" required>
                            @foreach ($produks as $row)
                            <option value="{{ $row->id }}" data-harga="{{ $row->harga_produk }}" {{ $d->produk_id == $row->id ? 'selected' : '' }}>{{ $row->id }} - {{ $row->nama_produk }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jumlah_beli_produk_{{ $key+1 }}" class="col-sm-5 form-label">Jumlah Beli Produk {{ $key+1 }}</label>
                        <div class="col-sm-7">
                        <input type="number" class="form-control" id="jumlah_beli_produk_{{ $key+1 }}" onchange="updateTotal()" name="jumlah_beli_produk[]" value="{{ $d->jumlah_beli_produk }}" required>
                        </div>
                    </div>
                    @endforeach
                    <div id="produk-container">
                        <!-- Tempat untuk menambahkan input produk dan promosi secara dinamis -->
                    </div>
                    <button type="button" class="btn btn-primary" onclick="addProduk()">Tambah Produk</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save </button>
                </div>
            </form>
        </div>

    </div>
</div>

<script>
    $(document).ready(function() {
        // Ketika nilai poin_ditukar berubah
        $('#poin_ditukar').on('change', function() {
            var poin_awal = parseFloat($('#poin_awal').val());
            var poinDitukar = $(this).val();
            var totalPoin = parseFloat($('#total_poin').val());

            // Mengecek apakah nilai poin_ditukar valid (angka dan tidak negatif)
            if (isNaN(poinDitukar) || poinDitukar < 0) {
                alert('Masukkan jumlah poin yang valid.');
                $(this).val('');
                $('#total_poin').val(poin_awal);
                return;
            }

            // Mengecek apakah nilai poin_ditukar tidak melebihi total_poin
            if (parseFloat(poinDitukar) > totalPoin) {
                alert('Poin yang ingin ditukar melebihi total poin yang dimiliki.');
                $(this).val(poin_awal);
                $('#total_poin').val(poin_awal);
                return;
            }

            if (poinDitukar <= 0) {
                $('#total_poin').val(poin_awal);
            } else {
                var sisaPoin = totalPoin - parseFloat(poinDitukar);
                $('#total_poin').val(sisaPoin);
            }
        });
    });
</script>

<script>
    
    function addProduk() {
    let produkCount = {{ $data->detail->count() }};
        produkCount++;
        const produkInput = `
        <div class="mb-3 row">
            <label for="produk_id_${produkCount}" class="form-label col-sm-5">Produk ID ${produkCount}</label>
            <div class="col-sm-7">
            <select class="form-select" id="produk_id_${produkCount}" name="produk_id[]" required>
                @foreach ($produks as $row)
                <option value="{{ $row->id }}" data-harga="{{ $row->harga_produk }}">{{ $row->id }} - {{ $row->nama_produk }}</option>
                @endforeach
            </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="jumlah_beli_produk_${produkCount}" class="form-label col-sm-5">Jumlah Beli Produk ${produkCount}</label>
            <div class="col-sm-7">
            <input type="number" class="form-control" id="jumlah_beli_produk_${produkCount}" name="jumlah_beli_produk[]" required>
        </div>
        </div>
    `;
        document.getElementById('produk-container').insertAdjacentHTML('beforeend', produkInput);
        updateTotal(); // Panggil fungsi untuk memperbarui total transaksi setelah menambahkan produk baru
    }



    function updateTotal() {
        let total = 0;
        document.querySelectorAll('[id^=produk_id_]').forEach(function(select, index) {
            const harga = parseFloat(select.options[select.selectedIndex].getAttribute('data-harga'));
            const jumlah = parseFloat(document.getElementById(`jumlah_beli_produk_${index+1}`).value);
            if (!isNaN(harga) && !isNaN(jumlah)) {
                total += harga * jumlah;
            }
        });
        document.getElementById('total_transaksi').value = total;
    }

    document.getElementById('produk-container').addEventListener('change', function(event) {
        if (event.target.matches('select[id^=produk_id_]')) {
            updateTotal();
        }
    });

    document.getElementById('produk-container').addEventListener('input', function(event) {
        if (event.target.matches('input[id^=jumlah_beli_produk_]')) {
            updateTotal();
        }
    });

    function updateTotal() {
        let total = 0;
        document.querySelectorAll('[id^=produk_id_]').forEach(function(select, index) {
            const harga = parseFloat(select.options[select.selectedIndex].getAttribute('data-harga'));
            const jumlah = parseFloat(document.getElementById(`jumlah_beli_produk_${index+1}`).value);
            if (!isNaN(harga) && !isNaN(jumlah)) {
                total += harga * jumlah;
            }
        });
        document.getElementById('total_transaksi').value = total;

        // Menghitung poin yang diperoleh (1 poin untuk setiap 10.000 total transaksi)
        const poin = Math.floor(total / 100);
        document.getElementById('poin_diperoleh').value = poin;
    }

    function getTotalPoin() {
        // Ambil semua elemen yang memiliki kelas 'poin_diperoleh'
        const poinElements = document.querySelectorAll('.poin_diperoleh');

        let totalPoin = 0;

        // Iterasi melalui setiap elemen poin dan tambahkan nilainya ke totalPoin
        poinElements.forEach((element) => {
            const poin = parseFloat(element.textContent); // Ambil nilai poin sebagai angka
            if (!isNaN(poin)) {
                totalPoin += poin;
            }
        });

        return totalPoin;
    }

    // Fungsi untuk mengisi input "total poin" pada formulir
    // function fillTotalPoin() {
    //     const totalPoinInput = document.getElementById('total_poin');
    //     if (totalPoinInput) {
    //         const totalPoin = getTotalPoin();
    //         totalPoinInput.value = totalPoin;
    //     }
    // }

    // Panggil fungsi fillTotalPoin saat halaman dimuat
    // document.addEventListener('DOMContentLoaded', function() {
    //     fillTotalPoin();
    // });
</script>