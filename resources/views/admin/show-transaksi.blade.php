@extends('layout.main')

@section('judul')
    <strong>Detail Transaksi {{ $transaksi->user->nama }}</strong>
@endsection

@section('isi')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route('transaksi.index') }}" style="background-color: #237e79" class="btn btn-success mb-3"
                        id="addDataTransaksi">
                        <i class="fa fa-arrow-left"></i>
                        <span> Kembali</span>

                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="id">ID Transaksi</label>
                        <input type="text" class="form-control" id="id" name="id"
                            value="{{ $transaksi->id }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="id_pelanggan">Nama Pelanggan</label>
                        <input type="text" class="form-control" id="id_pelanggan" name="id_pelanggan"
                            value="{{ $transaksi->user->nama }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_transaksi">Tanggal Transaksi</label>
                        <input type="text" class="form-control" id="tanggal_transaksi" name="tanggal_transaksi"
                            value="{{ $transaksi->tanggal_transaksi }}" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="total">Total Transaksi</label>
                        <input type="text" class="form-control" id="total" name="total"
                            value="Rp. {{ number_format($transaksi->total, 2) }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="poin_diperoleh">Poin Diperoleh</label>
                        <input type="text" class="form-control" id="poin_diperoleh" name="poin_diperoleh"
                            value="{{ $transaksi->poin_diperoleh }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="poin_ditukar">Poin Ditukar</label>
                        <input type="text" class="form-control" id="poin_ditukar" name="poin_ditukar"
                            value="{{ $transaksi->poin_ditukar != null ? $transaksi->poin_ditukar : 0  }}" readonly>
                    </div>
                </div>
                <h3>Detail Produk</h3>
                <div class="table-responsive" style="overflow-x: auto; height: 600px;">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Nota</th>
                                <th>ID Produk</th>
                                <th>Nama Produk</th>
                                <th>Harga Produk</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksi->detail as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $transaksi->id }}</td>
                                    <td>{{ $item->produk_id }}</td>
                                    <td>{{ $item->produk->nama_produk }}</td>
                                    <td>Rp. {{ number_format($item->produk->harga_produk, 2) }}</td>
                                    <td>{{ $item->jumlah_beli_produk }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            @endsection