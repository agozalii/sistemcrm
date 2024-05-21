@extends('layout.main')

@section('judul')
    Halaman Data Klaim Poin
@endsection

@section('isi')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <button style="background-color: #06696d;display:none" class="btn btn-success mb-3" id="addDataMember">
                        <i class="fa fa-plus"></i>
                        <span> Tambah Data Poin</span>

                    </button>
                </div>

            </div>

            @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
            @endif
            <div style="overflow-x:auto;">
                {{-- height:300px; --}}
                <table id="example1" class="table table-bordered table-striped"
                    style="min-width:1200px; overflow-y: auto;">
                    <thead>
                        {{-- class="sticky-top" --}}
                        <tr style="text-align: center">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Nama Gift</th>
                            <th>Tanggal Klaim</th>
                            <th>Tanggal Konfirmasi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($data as $d)
                            <tr>
                                <th>{{ $no++ }}</th>
                                <td>{{ $d->user->nama }}</td>
                                <td>{{ $d->gift->nama_gift }}</td>
                                <td>{{ date('d F Y', strtotime($d->tanggal_klaim)) }}</td>
                                <td>{{ $d->status != 'Menunggu' ? date('d F Y', strtotime($d->updated_at)) : '-' }}</td>
                                <td>
                                    @if ($d->status == 'Terklaim')
                                        <span class="badge bg-success text-light">Terklaim</span>
                                    @elseif($d->status == 'Menunggu')
                                        <span class="badge bg-warning text-dark">Menunggu</span>
                                    @else
                                        <span class="badge bg-danger text-light">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($d->status == 'Menunggu')
                                        <div class="inline-flex">
                                            <button class="btn btn-info" style="100px"
                                                onclick="klaimGift({{ $d->id }}, '{{ $d->user->nama }}')">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <div class="d-inline-flex">
                                                <button class="btn btn-danger" style="100px"
                                                    onclick="rejectGift({{ $d->id }}, '{{ $d->user->nama }}')">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        @else
                                            <span class="btn btn-success text-light">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#example1').DataTable({
                    dom: 'Blfrtip',
                    buttons: [{
                        extend: 'pdf',
                        text: 'Print PDF',
                        title: 'Laporan Data Klaim Poin',
                    }],
                    lengthMenu: [
                        [5, 10, 25, 50, -1],
                        [5, 10, 25, 50, "All"]
                    ]
                });
            });
        </script>

        <script>
            function klaimGift(id, name) {
                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Apakah Anda yakin akan konfirmasi klaim gift dari ' + name + '?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Konfirmasi',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "GET",
                            url: "{{ route('klaim.klaimMember', ['id' => ':id']) }}".replace(':id', id),
                            success: function(response) {
                                if (response == 'success') {
                                    Swal.fire(
                                        'Berhasil!',
                                        'Klaim Berhasil!',
                                        'success'
                                    )
                                }
                                location.reload();
                            }
                        })
                    }
                });
            }

            function rejectGift(id, name) {
                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Apakah Anda yakin akan menolak klaim gift dari ' + name + '?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Tolak',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "GET",
                            url: "{{ route('klaim.rejectKlaim', ['id' => ':id']) }}".replace(':id', id),
                            success: function(response) {
                                if (response == 'success') {
                                    Swal.fire(
                                        'Berhasil!',
                                        'Klaim Berhasil Ditolak!',
                                        'success'
                                    )
                                }
                                location.reload();
                            }
                        })
                    }
                });
            }
        </script>
    @endsection


