@extends('layout.main')

@section('judul')
    Halaman Member
@endsection

@section('isi')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <button style="background-color: #06696d" class="btn btn-success mb-3" id="addDataMember">
                        <i class="fa fa-plus"></i>
                        <span> Tambah Data Member</span>

                    </button>
                </div>

                {{-- <div class="col-md-6">
                    <form action="{{ route('member.index') }}" method="GET" class="form-inline float-right">
                        <a href="{{ route('member.index') }}" class="btn btn-link ml-2">
                            <i class="fas fa-sync-alt"></i>
                        </a>
                        <input type="text" name="query" class="form-control mr-2" placeholder="Cari produk..."
                            value="{{ $query ?? '' }}">
                        <button type="submit" class="btn btn-primary">Cari</button>

                    </form>
                </div> --}}

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
                            <th>ID</th>
                            <th>Username</th>
                            <th>Nama</th>
                            <th style="width: 300px">Alamat</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Email</th>
                            <th>Nomor Telepon</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($data as $y => $x)
                        @if ($x->role == 'member')
                            <tr>
                                <th>{{ $no++ }}</th>
                                <td>{{ $x->id }}</td>
                                <td>{{ $x->username }}</td>
                                <td>{{ $x->nama }}</td>
                                <td>{{ $x->alamat }}</td>
                                <td>{{ $x->tgl_lahir }}</td>
                                <td>{{ $x->jenis_kelamin }}</td>
                                <td>{{ $x->email }}</td>
                                <td>{{ $x->nomor_telpon }}</td>
                                <td>
                                    <button class="btn btn-info editMember" style="100px" data-id="{{ $x->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger deleteMember" style="100px" data-id="{{ $x->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endif
                    @endforeach

                    </tbody>
                </table>
            </div>
            {{-- <div class="d-flex justify-content-center" style="margin-top: 20px;">
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
                {{ $data->total() }}</p> --}}


        </div>
        <div class="tampilData" style="display:none;"></div>
        <div class="tampilEditData" style="display:none;"></div>

        <script>
            $('#addDataMember').click(function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('addMember') }}',
                    success: function(response) {
                        $('.tampilData').html(response).show();
                        $('#addMember').modal("show");
                    }
                });
            });

            $('.editMember').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    url: "{{ route('editMember', ['id' => ':id']) }}".replace(':id', id),
                    success: function(response) {
                        $('.tampilEditData').html(response).show();
                        $('#editMember').modal("show");
                    }
                });

            });
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            $('.deleteMember').click(function(e) {
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
                            url: "{{ route('deleteMember', ['id' => ':id']) }}".replace(':id', id),
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
