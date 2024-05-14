@extends('layout.main')

@section('judul')
    Halaman Data Laporan Kritik dan Saran
@endsection

@section('isi')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title col-md-12 mb-4">Data Laporan</h3>
            <div class="mt-2">
                <form action="{{ route('laporan.index') }}" method="GET">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="tgl_awal">Tgl. Awal</label>
                            <input type="date" name="tgl_awal" class="form-control" id="datepicker"
                                placeholder="Tgl. Awal" value="{{ $tgl_awal }}">
                        </div>
                        <div class="col-md-3">
                            <label for="tgl_akhir">Tgl. Akhir</label>
                            <input type="date" name="tgl_akhir" class="form-control" id="datepicker"
                                placeholder="Tgl. Awal" value="{{ $tgl_akhir }}">
                        </div>
                        <div class="col-md-3 d-inline-flex gap-1">
                            <button type="submit" class="btn btn-primary" style="margin-top: 32px"><i
                                    class="fa fa-filter"></i> Filter</button>
                            <a href="{{ route('laporan.index') }}" class="btn btn-danger" style="margin-top: 32px"><i
                                    class="fa fa-eraser"></i> Reset</a>
                                {{-- <a href="{{ route('laporan.cetak') }}" class="btn btn-dark" style="margin-top: 32px"><i
                                        class="fa fa-print"></i> Cetak</a> --}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">

            <div style="overflow-x:auto;">
                {{-- height:300px; --}}
                <table id="example1" class="table table-bordered table-striped"
                    style="min-width:1500px; overflow-y: auto;">
                    <thead>
                        {{-- class="sticky-top" --}}
                        <tr style="text-align: center">
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>Isi Kritik & Saran</th>
                            <th>Tanggal Kirim</th>
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
                                <td>{{ $d->isi_kritiksaran }}</td>
                                <td>{{ date('d F Y', strtotime($d->tgl_kirim)) }}</td>
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
                        title: 'Laporan Kritik Dan Saran',
                        customize: function(doc) {
                            var tableBody = doc.content[1].table.body;
                            tableBody.forEach(function(row) {
                                row.forEach(function(cell) {
                                    cell.margin = [10, 5, 10, 5]; // [left, top, right, bottom]
                                });
                            });

                            // Mengatur lebar kolom agar tabel memenuhi 100% lebar halaman
                            var objLayout = {};
                            objLayout['hLineWidth'] = function(i) { return .5; };
                            objLayout['vLineWidth'] = function(i) { return .5; };
                            objLayout['hLineColor'] = function(i) { return '#aaa'; };
                            objLayout['vLineColor'] = function(i) { return '#aaa'; };
                            objLayout['paddingLeft'] = function(i) { return 10; };
                            objLayout['paddingRight'] = function(i) { return 10; };
                            objLayout['paddingTop'] = function(i) { return 5; };
                            objLayout['paddingBottom'] = function(i) { return 5; };

                            doc.content[1].layout = objLayout;

                             // Mengatur lebar kolom pertama otomatis dan lainnya 100%
                            var widths = ['auto']; // Kolom pertama otomatis
                            var numCols = doc.content[1].table.body[0].length;
                            for (var i = 1; i < numCols; i++) {
                                widths.push('*');
                            }
                            doc.content[1].table.widths = widths;
                        }
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
