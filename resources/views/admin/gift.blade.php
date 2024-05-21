@extends('layout.main')

@section('judul')
    Halaman Gift
@endsection

@section('isi')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <button style="background-color: #06696d" class="btn btn-success mb-3" id="addDataGift">
                        <i class="fa fa-plus"></i>
                        <span> Tambah Data Gift</span>

                    </button>
                </div>
                <div class="col-md-6">
                    <form action="{{ route('member.index') }}" method="GET" class="form-inline float-right">
                        <a href="{{ route('member.index') }}" class="btn btn-link ml-2">
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
                <table id="example1" class="table table-bordered table-striped" style="min-width:1300px; overflow-y: auto;">
                    <thead>
                        {{-- class="sticky-top" --}}
                        <tr style="text-align: center">
                            <th>No</th>
                            <th style="width: 400px">Nama </th>
                            <th>Gambar </th>
                            <th>Poin Tukar</th>
                            <th>Stock</th>
                            <th style="width: 400px">Deskripsi</th>
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
                                <td>{{ $x->nama_gift }}</td>
                                <td><img src="{{ asset('storage/gift/' . $x->gambar_gift) }}" alt="Gambar Gift"
                                        width="60"></td>
                                <td>{{ $x->poin_cost }}</td>
                                <td>{{ $x->stock }}</td>
                                <td>{{ $x->deskripsi }}</td>
                                <td>
                                    <button class="btn btn-info editGift" style="100px" data-id="{{ $x->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger deleteGift" style="100px" data-id="{{ $x->id }}">
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
        {{-- <script>
            $(document).ready(function () {
                $('#example1').DataTable({
                    dom: 'Blfrtip',
                    buttons: [
                        {
                            extend: 'pdf',
                            text: 'Print PDF',
                            title: 'Laporan Data Gift',
                        }
                    ],
                    lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
                });
            });
        </script> --}}

        <script>
            $('#addDataGift').click(function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('addGift') }}',
                    success: function(response) {
                        $('.tampilData').html(response).show();
                        $('#addGift').modal("show");
                    }
                });
            });

            $('.editGift').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    url: "{{ route('editGift', ['id' => ':id']) }}".replace(':id', id),
                    success: function(response) {
                        $('.tampilEditData').html(response).show();
                        $('#editGift').modal("show");
                    }
                });

            });
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            $('.deleteGift').click(function(e) {
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
                            url: "{{ route('deleteGift', ['id' => ':id']) }}".replace(':id', id),
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
