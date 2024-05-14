@extends('layout.main')

@section('isi')
    <div class="card">
        <div class="card-header">
            <h3>Halaman History Transaksi</h3>
        </div>
        <div class="card-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <script>
                    $(document).ready(function () {
                        $(".btn-close").click(function () {
                            $(this).closest(".alert").alert('close');
                        });
                    });
                </script>

            @endif
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped"
                       style="overflow-x: auto; height: 600px;">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>No Nota</th>
                        <th>Nama Pelanggan</th>
                        <th>Produk</th>
                        <th>Tgl Transaksi</th>
                        <th>Total</th>
                        <th>Poin Diperoleh</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->user->nama }}</td>
                            <td>
                                @foreach ($item->detail as $detail)
                                    <ul>
                                        <li>{{ $detail->produk->nama_produk }}</li>
                                    </ul>
                                @endforeach
                            </td>
                            <td>{{ $item->tanggal_transaksi }}</td>
                            <td>Rp. {{ number_format($item->total, 2) }}</td>
                            <td>{{ $item->poin_diperoleh }}</td>
                            <td>
                                
                                @if($user->role == 'kasir')
                                <a href="{{ route('transaksi.show', $item->id) }}" class="btn btn-warning">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('kasir.transaksi.edit', $item->id) }}" class="btn btn-info">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-danger deleteProduk" data-id="{{ $item->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @else
                                <a href="{{ route('transaksi.view', $item->id) }}" class="btn btn-warning">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <script>
            $(document).ready(function () {
                $('#example1').DataTable({
                    dom: 'Blfrtip',
                    buttons: [
                        {
                            extend: 'pdf',
                            text: 'Print PDF',
                            title: 'Laporan Transaksi',
                            orientation: 'landscape',
                            customize: function(doc) {
                                // Menambahkan padding pada tabel
                                var tableBody = doc.content[1].table.body;
                                tableBody.forEach(function(row) {
                                    row.forEach(function(cell) {
                                        cell.margin = [10, 5, 10, 5]; // [left, top, right, bottom]
                                    });
                                });
                            }
                        }
                    ],
                    lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
                });
            });
        </script>
@endsection

