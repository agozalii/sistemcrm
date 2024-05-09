@extends('layout.main')

@section('judul')
    Klasifikasi Gunung
@endsection

@section('isi')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <button style="background-color: #06696d" class="btn btn-success mb-3" id="addDatagunung">
                        <i class="fa fa-plus"></i>
                        <span> Tambah Data Gunung</span>

                    </button>
                </div>

                <div class="col-md-6">
                    <form action="{{ route('klasifikasigunung.index') }}" method="GET" class="form-inline float-right">
                        <a href="{{ route('klasifikasigunung.index') }}" class="btn btn-link ml-2">
                            <i class="fas fa-sync-alt"></i>
                        </a>
                        <input type="text" name="query" class="form-control mr-2" placeholder="Cari produk..."
                            value="{{ $query ?? '' }}">
                        <button type="submit" class="btn btn-primary">Cari</button>

                    </form>
                </div>

            </div>

            @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
            @endif
            <div style="overflow-x:auto;">
                {{-- height:300px; --}}
                <table class="table table-bordered table-striped" style="min-width:1500px; overflow-y: auto;">
                    <thead>
                        {{-- class="sticky-top" --}}
                        <tr style="text-align: center">
                            <th>No</th>
                            <th>Id</th>
                            <th>Nama Gunung</th>
                            <th>Gambar Gunung</th>
                            <th>Ketinggian</th>
                            <th>Kesulitan</th>
                            <th>Lama Pendakian</th>
                            <th>Suhu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            // $no = 1;
                        @endphp
                        @foreach ($data as $y => $x)
                            <tr>
                                <th scope="row">{{ $data->firstItem() + $loop->index }}</th>
                                <td>{{ $x->id }}</td>
                                <td>{{ $x->nama_gunung }}</td>
                                <td><img src="{{ asset('storage/gunung/' . $x->gambar_gunung) }}" alt="Gambar Gunung"
                                        width="60"></td>
                                <td>{{ $x->ketinggian }}</td>
                                <td>{{ $x->kesulitan }}</td>
                                <td>{{ $x->lama_pendakian }}</td>
                                <td>{{ $x->suhu }}</td>
                                <td>
                                    <button class="btn btn-info editGunung" style="100px" data-id="{{ $x->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger deleteGunung" style="100px"
                                        data-id="{{ $x->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center" style="margin-top: 20px;">
                <ul class="pagination">
                    <li class="page-item">
                        @if ($data->previousPageUrl())
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

            <p class="text-center">Menampilkan {{ $data->firstItem() }} - {{ $data->lastItem() }}, dari total
                {{ $data->total() }}</p>


        </div>
        <div class="tampilData" style="display:none;"></div>
        <div class="tampilEditData" style="display:none;"></div>

        <script>
            $('#addDatagunung').click(function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('addGunung') }}',
                    success: function(response) {
                        $('.tampilData').html(response).show();
                        $('#addGunung').modal("show");
                    }
                });
            });

            $('.editGunung').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    url: "{{ route('editGunung', ['id' => ':id']) }}".replace(':id', id),
                    success: function(response) {
                        $('.tampilEditData').html(response).show();
                        $('#editGunung').modal("show");
                    }
                });

            });
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            $('.deleteGunung').click(function(e) {
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
                            url: "{{ route('deleteGunung', ['id' => ':id']) }}".replace(':id', id),
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
