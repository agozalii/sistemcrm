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
                        <th>Tanggal Transaksi</th>
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
                            <td>{{ $item->tanggal_transaksi }}</td>
                            <td>{{ $item->total }}</td>
                            <td>{{ $item->poin_diperoleh }}</td>
                            <td>
                                <a href="{{ route('transaksi.show', $item->id) }}" class="btn btn-warning">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <button class="btn btn-info editTransaksi" data-id="{{ $item->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger deleteProduk" data-id="{{ $item->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
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
                            text: 'Print PDF'
                        }
                    ],
                    lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
                });
            });
        </script>
@endsection

