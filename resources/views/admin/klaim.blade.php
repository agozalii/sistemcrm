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
                <table class="table table-bordered table-striped" style="min-width:1500px; overflow-y: auto;">
                    <thead>
                        {{-- class="sticky-top" --}}
                        <tr style="text-align: center">
                            <th>No</th>
                            <th>Nama</th>
                            <th>nama Gift</th>
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
                                <td>{{ $d->status == 'Terklaim' ? date('d F Y', strtotime($d->updated_at)) : '-' }}</td>
                                <td>
                                    @if($d->status == 'Terklaim')
                                        <span class="badge bg-success text-light">Terklaim</span>
                                        @else
                                        <span class="badge bg-warning text-dark">Menunggu</span>
                                    @endif
                                </td>
                                <td>
                                    @if($d->status == 'Menunggu')
                                    <button class="btn btn-info" style="100px"
                                        onclick="klaimGift({{ $d->id }}, '{{ $d->user->nama }}')">
                                        <i class="fas fa-check"></i> Konfirmasi
                                    </button>
                                    @else
                                    <btn class="btn btn-success text-light">Selesai</btn>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    @endsection

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
    </script>
