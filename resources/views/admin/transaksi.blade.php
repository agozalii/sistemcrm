{{-- @extends('layout.main')

@section('judul')
    Halaman Transaksi
@endsection

@section('isi')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <button style="background-color: #06696d" class="btn btn-success mb-3" id="addDataTransaksi">
                        <i class="fa fa-plus"></i>
                        <span> Tambah Data Transaksi</span>

                    </button>
                </div>

            </div>

            @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
            @endif
            <div style="overflow-x:auto;">
                <table class="table table-bordered table-striped" style="min-width:1500px; overflow-y: auto;">
                    <thead>
                        <tr style="text-align: center">
                            <th>No</th>
                            <th>Nama Member</th>
                            <th>Tanggal Transaksi</th>
                            <th>Total</th>
                            <th style="width: 300px">Poin Diperoleh</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($data as $y => $x)
                        <tr>
                            <th>{{ $no++ }}</th>
                            <td>{{ $x->user->nama }}</td>
                            <td>{{ $x->tanggal_transaksi }}</td>
                            <td>{{ $x->total }}</td>
                            <td>{{ $x->poin_diperoleh }}</td>
                            <td>
                                <button class="btn btn-info editTransaksi" style="100px" data-id="{{ $x->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger deleteTransaksi" style="100px" data-id="{{ $x->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

        </div>
        <div class="tampilData" style="display:none;"></div>
        <div class="tampilEditData" style="display:none;"></div>

        <script>
            $('#addDataTransaksi').click(function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('addTransaksi') }}',
                    success: function(response) {
                        $('.tampilData').html(response).show();
                        $('#addTransaksi').modal("show");
                    }
                });
            });

            $('.editTransaksi').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    url: "{{ route('editTransaksi', ['id' => ':id']) }}".replace(':id', id),
                    success: function(response) {
                        $('.tampilEditData').html(response).show();
                        $('#editTransaksi').modal("show");
                    }
                });

            });
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            $('.deleteTransaksi').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener("mouseenter", Swal.stopTimer);
                        toast.addEventListener("mouseleave", Swal.resumeTimer);
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    },
                });

                Swal.fire({
                    title: 'Hapus data ?',
                    text: "Kamu yakin untuk menghapus " + id + " ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "GET",
                            url: "{{ route('deleteTransaksi', ['id' => ':id']) }}".replace(':id', id),
                            dataType: "json",
                            success: function(response) {
                                // ini diambil dari controller
                                if (response.status === 'success') {
                                    Toast.fire({
                                        icon: "success",
                                        // ini diambil dari controller
                                        title: response.message,
                                    });
                                    // window.location.reload()
                                }
                            },
                            error: function(xhr, status, error) {
                                // Tampilkan notifikasi error jika terjadi kesalahan
                                Swal.fire({
                                    title: 'Error',
                                    text: 'Terjadi kesalahan saat menghapus data',
                                    icon: 'error'
                                });
                            }
                        });
                    }
                })
            });
        </script>
    @endsection --}}

    @extends('layout.main')

{{-- @include('sweetalert::alert') --}}

@section('judul')
    <strong>Halaman Transaksi</strong>
@endsection

@section('isi')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <button style="background-color: #237e79" class="btn btn-success mb-3" id="addDataTransaksi">
                        <i class="fa fa-plus"></i>
                        <span> Tambah Transaksi</span>

                    </button>
                </div>
                {{-- <div class="col-md-6">
                    <form action="/transaksi" role="search" method="GET" class="form-inline float-right">
                        <a href="{{ route('transaksi.index') }}" class="btn ml-2 mr-2">
                            <i class="fas fa-sync-alt"></i> <!-- Ikon refresh -->
                        </a>
                        <input type="text" name="query" class="form-control mr-2" placeholder="Cari transaksi..."
                            style="width: 400px" name="search" value="{{ $search }}">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </form>
                </div> --}}
            </div>

            @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
            @endif
            <div class="table-responsive" style="overflow-x: auto; height: 600px;">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Nota</th>
                            <th>Nama Pelanggan</th>
                            <th>Tanggal Transaksi</th>
                            <th>Total </th>
                            <th>Poin Diperoleh </th>

                            <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
                            <th>Aksi</th>
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


                            {{-- <td>Rp. {{ number_format($item->total_transaksi, 2) }}</td>
                            <!-- Tambahkan kolom lainnya sesuai kebutuhan --> --}}
                            <td>
                                <a href="{{ route('transaksi.view', $item->id) }}" class="btn btn-warning">
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

            {{-- <div class="d-flex justify-content-center mt-2">
                <ul class="pagination">
                    <li class="page-item">
                        @if ($data->currentPage() > 1)
                            <a href="{{ $data->previousPageUrl() }}" class="page-link">&laquo; Sebelumnya</a>
                        @else
                            <span class="page-link disabled ">&laquo; Sebelumnya</span>
                        @endif
                    </li>

                    <li class="page-item">
                        @if ($data->nextPageUrl())
                            <a href="{{ $data->nextPageUrl() }}" class="page-link">Berikutnya &raquo;</a>
                        @else
                            <span class="page-link disabled">Berikutnya &raquo;</span>
                        @endif
                    </li>
                </ul>
            </div>
            <p class="text-center">Menampilkan {{ $data->firstItem() }} - {{ $data->lastItem() }}, dari total {{ $data->total() }}</p> --}}

            </div>

    </div>
    <div class="tampilData" style="display:none;"></div>
    <div class="tampilEditData" style="display:none;"></div>




    <script>
        $('#addDataTransaksi').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('addTransaksi') }}',
                success: function(response) {
                    $('.tampilData').html(response).show();
                    $('#addTransaksi').modal("show");
                }
            });
        });

        $('.editTransaksi').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');

            $.ajax({
                type: "GET",
                url: "{{ route('editTransaksi', ['id' => ':id']) }}".replace(':id', id),
                success: function(response) {
                    $('.tampilEditData').html(response).show();
                    $('#editTransaksi').modal("show");
                }
            });
        });

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $('.deleteProduk').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener("mouseenter", Swal.stopTimer);
                    toast.addEventListener("mouseleave", Swal.resumeTimer);
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                },
            });

            Swal.fire({
                title: 'Hapus data ?',
                text: "Kamu yakin untuk menghapus data ini ",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('deleteTransaksi', ['id' => ':id']) }}".replace(':id', id),
                        dataType: "json",
                        success: function(response) {
                            // ini diambil dari controller
                            if (response.status === 'success') {
                                Toast.fire({
                                    icon: "success",
                                    // ini diambil dari controller
                                    title: response.message,
                                });
                                // window.location.reload()
                            }
                        },
                        error: function(xhr, status, error) {
                            // Tampilkan notifikasi error jika terjadi kesalahan
                            Swal.fire({
                                title: 'Error',
                                text: 'Terjadi kesalahan saat menghapus data',
                                icon: 'error'
                            });
                        }
                    });
                }
            })
        });
    </script>
@endsection
