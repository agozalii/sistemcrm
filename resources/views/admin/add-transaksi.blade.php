@extends('layout.main')

@section('judul')
    <strong>Tambah Transaksi</strong>
@endsection

@section('isi')
    <style>
        .hidden {
            display: none;
        }
    </style>
    <div class="card">
        <div class="card-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
            @endif
            <form action="{{ route('transaksi.simpan') }}" method="POST">
                @csrf
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="id_user">Nama</label>
                            <select class="form-control" id="id_user" name="id_user" onchange="getPoin()">
                                @foreach ($users as $row)
                                    <option value="{{ $row->id }}">{{ $row->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
                            <input type="date" class="form-control" id="tanggal_transaksi" value="{{date('Y-m-d')}}" name="tanggal_transaksi"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="total_poin" class="form-label">Total Poin Dimiliki</label>
                            <input type="text" class="form-control" id="total_poin" name="total_poin" readonly>
                            <input type="hidden" class="form-control" id="poin_awal" name="poin_awal">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="total_transaksi" class="form-label">Total Transaksi</label>
                            <input type="text" class="form-control" id="total_transaksi" name="total_transaksi"
                                   readonly>
                        </div>
                        <div class="form-group">
                            <label for="poin_diperoleh" class="form-label">Poin Diperoleh</label>
                            <input type="text" class="form-control" id="poin_diperoleh" name="poin_diperoleh" readonly>
                        </div>
                        <div class="form-group">
                            <label for="poin_ditukar" class="form-label">Poin Ingin Ditukar</label>
                            <input type="text" class="form-control" id="poin_ditukar" name="poin_ditukar">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <div class="row mb-2">
                                <center>
                                    <button type="button" class="btn btn-primary" onclick="addProduk()"><i class="fa fa-plus"></i>
                                        Tambah Produk
                                    </button>
                                </center>
                            </div>
                            <div id="produk-container" class="row col-lg-12">
                                <!-- Tempat untuk menambahkan input produk dan promosi secara dinamis -->
                            </div>
                        </div>
                        <div class="col-md-12">
                            <center>
                                <a href="{{ url('/kasir/transaksi') }}" style="background-color: #237e79"
                                   class="btn btn-success">
                                    <i class="fa fa-arrow-left"></i>
                                    <span> Kembali</span>

                                </a>
                                <button type="button" id="btn-submit" class="btn btn-primary hidden" data-toggle="modal" data-target="#detail-modal">
                                    Simpan
                                </button>
                                <button type="submit" id="btn-simpan" class="btn btn-primary hidden"><i class="fa fa-save"></i> Simpan</button>
                            </center>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    @include('admin.modal.detail_modal')


    <script>
        function getPoin() {
            var id_user = document.getElementById('id_user').value;
            var csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            $.ajax({
                url: "{{ route('transaksi.getPoin') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': csrf_token
                },
                data: {
                    id_user: id_user
                },
                success: function (data) {
                    if (data == 0 || data == null) {
                        $("#total_poin").val(0);
                        $("#poin_awal").val(0);
                    } else {
                        $("#total_poin").val(data);
                        $("#poin_awal").val(data);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }

            })
        }

        $('#btn-accept').on('click', function() {
            $('#btn-simpan').removeClass('hidden');
            $('#btn-submit').addClass('hidden');
            $('#detail-modal').hide();
            $('.modal-backdrop').hide();
        })
    </script>
    <script>
        let produkCount = 0;

        function addProduk() {
            $('#btn-submit').removeClass('hidden');
            $('#btn-simpan').addClass('hidden');
            produkCount++;
            const produkInput = `
                        <div class="mb-3 col-lg-6">
                            <label for="produk_id_${produkCount}" class="form-label">Produk ID ${produkCount}</label>
                            <select class="form-select" id="produk_id_${produkCount}" name="produk_id[]" required>
                                @foreach ($produks as $row)
            <option value="{{ $row->id }}" data-harga="{{ $row->harga_produk }}">{{ $row->id }} - {{ $row->nama_produk }}</option>
                                @endforeach
            </select>
    </div>
    <div class="mb-3 col-lg-6">
            <label for="jumlah_beli_produk_${produkCount}" class="form-label">Jumlah Beli Produk ${produkCount}</label>
                            <input type="number" class="form-control" id="jumlah_beli_produk_${produkCount}" name="jumlah_beli_produk[]" required>
                        </div>
                    `;
            document.getElementById('produk-container').insertAdjacentHTML('beforeend', produkInput);
            updateTotal(); // Panggil fungsi untuk memperbarui total transaksi setelah menambahkan produk baru
            if(produkCount == 1){
                $('#btn-submit').removeClass('hidden');
            }
        }

        function updateTotal() {
            let total = 0;
            document.querySelectorAll('[id^=produk_id_]').forEach(function (select, index) {
                const harga = parseFloat(select.options[select.selectedIndex].getAttribute('data-harga'));
                const jumlah = parseFloat(document.getElementById(`jumlah_beli_produk_${index + 1}`).value);
                if (!isNaN(harga) && !isNaN(jumlah)) {
                    total += harga * jumlah;
                }
            });
            document.getElementById('total_transaksi').value = total;
        }

        document.getElementById('produk-container').addEventListener('change', function (event) {
            if (event.target.matches('select[id^=produk_id_]')) {
                updateTotal();
            }
        });

        document.getElementById('produk-container').addEventListener('input', function (event) {
            if (event.target.matches('input[id^=jumlah_beli_produk_]')) {
                updateTotal();
            }
        });

        function updateTotal() {
            let total = 0;
            document.querySelectorAll('[id^=produk_id_]').forEach(function (select, index) {
                const harga = parseFloat(select.options[select.selectedIndex].getAttribute('data-harga'));
                const jumlah = parseFloat(document.getElementById(`jumlah_beli_produk_${index + 1}`).value);
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
    </script>

@endsection
