@extends('layout.main')

@section('judul')
    Dashboard
@endsection

@section('isi')
    <div class="p-3">
        <div class="card">
            <div class="card-header">
                <div class="mt-2">
                    <form action="{{ route('manajer.dashboard') }}" method="GET">
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
                                <a href="{{ route('manajer.dashboard') }}" class="btn btn-danger"
                                    style="margin-top: 32px"><i class="fa fa-eraser"></i> Reset</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-md-8">
                            <canvas id="giftChart" width="50" height="50"></canvas>
                        </div>
                    </div>
                    <div class="col-md-6" style="overflow-x: auto">
                        <div class="bg-info card mt-5">
                            <h3 class="text-center mt-5">Member Loyal</h3>
                            <div class="text-center">
                                <i class="fa fa-trophy fa-5x mb-5 mt-5 text-warning"></i>
                                <h2 class="text-center mt-4">{{ $memberLoyal }}</h2>
                            </div>
                            <h5 class="text-center mt-2">
                                {{ $tgl_awal && $tgl_akhir
                                    ? date('Y F d', strtotime($tgl_awal)) .
                                        ' -
                                                                                                                                                                                                                                                         ' .
                                        date('Y F d', strtotime($tgl_akhir))
                                    : date('Y F d') . ' - ' . date('Y F d') }}
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-6" style="overflow-x: auto">
                        <div class="col-md-10">
                            <canvas id="memberChart" width="50" height="50"></canvas>
                        </div>
                    </div>
                    <div class="col-md-6" style="overflow-x: auto">
                        <div class="col-md-10">
                            <canvas id="kepuasanChart" width="50" height="50"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-5">
            <div class="card-header">
                <div class="row text-center">
                    <h3>Kritik dan Saran Terbaru</h3>
                </div>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped" style="min-width:100px; overflow-y: auto;">
                    <thead>
                        <tr style="text-align: center">
                            <th style="width: 50px;">No</th>
                            <th style="width: 100px;">Tanggal</th>
                            <th style="width: 50px;">Nama Member</th>
                            <th style="width: 200px;">Kritik & Saran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kritikSarans as $y => $x)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $x->tgl_kirim }}</td>
                                <td>{{ $x->user->nama }}</td>
                                <td>{{ $x->isi_kritiksaran }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        // Data penjualan produk dari PHP (hasil array)
        const giftData = @json($grafikGift);

        // Ekstrak nama produk dan total penjualan
        const giftNames = giftData.map(item => item.nama_gift);
        const useCount = giftData.map(item => item.use);

        // Konfigurasi chart
        const ctx = document.getElementById('giftChart').getContext('2d');
        const giftChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: giftNames,
                datasets: [{
                    label: 'Gift Terklaim',
                    data: useCount,
                    backgroundColor: ['#03AED2', '#FF0000', '#97BE5A', '#028391', '#AF8F6F', '#D2649A',
                        '#E6FF94'
                    ],
                    borderColor: '#4D869C',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <script>
        // Data penjualan produk dari PHP (hasil array)
        const memberData = @json($pertambahan_member);

        // Ekstrak nama produk dan total penjualan
        const monthName = memberData.map(item => item.nama_bulan);
        const jumlah = memberData.map(item => item.jumlah);

        // Konfigurasi chart
        const mtx = document.getElementById('memberChart').getContext('2d');
        const memberChart = new Chart(mtx, {
            type: 'line',
            data: {
                labels: monthName,
                datasets: [{
                    label: 'Pertambahan Member',
                    data: jumlah,
                    backgroundColor: ['#03AED2'],
                    borderColor: '#4D869C',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <script>
        // Data penjualan produk dari PHP (hasil array)
        const kritiksaranData = @json($kepuasan);

        // Ekstrak nama produk dan total penjualan
        const kepuasan = kritiksaranData.map(item => item.nama_rating);
        const jumlahKepuasan = kritiksaranData.map(item => item.jumlah);

        // Konfigurasi chart
        const ktx = document.getElementById('kepuasanChart').getContext('2d');
        const kepuasanChart = new Chart(ktx, {
            type: 'bar',
            data: {
                labels: kepuasan,
                datasets: [{
                    label: 'Kepuasan Member',
                    data: jumlahKepuasan,
                    backgroundColor: ['#03AED2'],
                    borderColor: '#4D869C',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>


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
                                cell.margin = [10, 5, 10,
                                    5
                                ]; // [left, top, right, bottom]
                            });
                        });

                        // Mengatur lebar kolom agar tabel memenuhi 100% lebar halaman
                        var objLayout = {};
                        objLayout['hLineWidth'] = function(i) {
                            return .5;
                        };
                        objLayout['vLineWidth'] = function(i) {
                            return .5;
                        };
                        objLayout['hLineColor'] = function(i) {
                            return '#aaa';
                        };
                        objLayout['vLineColor'] = function(i) {
                            return '#aaa';
                        };
                        objLayout['paddingLeft'] = function(i) {
                            return 10;
                        };
                        objLayout['paddingRight'] = function(i) {
                            return 10;
                        };
                        objLayout['paddingTop'] = function(i) {
                            return 5;
                        };
                        objLayout['paddingBottom'] = function(i) {
                            return 5;
                        };

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
@endsection
