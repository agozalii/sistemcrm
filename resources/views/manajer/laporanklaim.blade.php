@extends('layout.main')

@section('judul')
    Laporan Klaim Poin
@endsection

@section('isi')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title col-md-12 mb-4">Data Laporan</h3>
            <div class="mt-2">
                <form action="{{ route('laporanklaim') }}" method="GET">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="tgl_awal">Tgl. Awal</label>
                            <input type="date" name="tgl_awal" class="form-control" id="datepicker"
                                placeholder="Tgl. Awal" value="{{ $tgl_awal }}">
                        </div>
                        <div class="col-md-3">
                            <label for="tgl_akhir">Tgl. Akhir</label>
                            <input type="date" name="tgl_akhir" class="form-control" id="datepicker"
                                placeholder="Tgl. Akhir" value="{{ $tgl_akhir }}">
                        </div>
                        <div class="col-md-3">
                            <label for="status">Status</label>
                            <select name="status" class="form-control">
                                <option value="">Tampilkan Semua</option>
                                <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                <option value="Terklaim" {{ request('status') == 'Terklaim' ? 'selected' : '' }}>Terklaim</option>
                                <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-inline-flex gap-1">
                            <button type="submit" class="btn btn-primary" style="margin-top: 32px"><i
                                    class="fa fa-filter"></i> Filter</button>
                            <a href="{{ route('laporanklaim') }}" class="btn btn-danger" style="margin-top: 32px"><i
                                    class="fa fa-eraser"></i> Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div style="overflow-x:auto;">
                <table id="example1" class="table table-bordered table-striped"
                    style="min-width:950px; overflow-y: auto;">
                    <thead>
                        <tr style="text-align: center">
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>Nama Gift</th>
                            <th>Tanggal Klaim</th>
                            <th>Status Klaim</th>
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
                                <td>{{ $d->tanggal_klaim }}</td>
                                <td>{{ $d->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <h4 class="mt-4">Total Gift Terklaim</h4>
            <div style="overflow-x:auto;">
                <table id="giftTerklaim" class="table table-bordered table-striped"
                    style="min-width:950px; overflow-y: auto;">
                    <thead>
                        <tr style="text-align: center">
                            <th>No</th>
                            <th>Nama Gift</th>
                            <th>Jumlah Terklaim</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($giftCountsTerklaim as $gift)
                            <tr>
                                <th>{{ $no++ }}</th>
                                <td>{{ $gift->gift->nama_gift }}</td>
                                <td>{{ $gift->total }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <h4 class="mt-4">Total Gift Ditolak dan Menunggu</h4>
            <div style="overflow-x:auto;">
                <table id="giftOther" class="table table-bordered table-striped"
                    style="min-width:950px; overflow-y: auto;">
                    <thead>
                        <tr style="text-align: center">
                            <th>No</th>
                            <th>Nama Gift</th>
                            <th>Status</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($giftCountsOther as $gift)
                            <tr>
                                <th>{{ $no++ }}</th>
                                <td>{{ $gift->gift->nama_gift }}</td>
                                <td>{{ $gift->status }}</td>
                                <td>{{ $gift->total }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    {{-- <script>
        $(document).ready(function() {
            var table1 = $('#example1').DataTable({
                dom: 'Blfrtip',
                buttons: [{
                    extend: 'pdf',
                    text: 'Print PDF',
                    title: 'Laporan Klaim Poin',
                    customize: function(doc) {
                        // Initialize the structure for doc.content[1].table.body
                        var content = [
                            { text: 'Laporan Klaim Poin', style: 'header', alignment: 'center', margin: [0, 0, 0, 20] }
                        ];

                        // Function to push table data to doc content
                        function addTableToContent(selector, title) {
                            var table = $(selector).DataTable();
                            var data = table.data().toArray();

                            // Ensure the table is not empty
                            if (data.length) {
                                content.push({ text: title, style: 'subheader', alignment: 'left', margin: [0, 20, 0, 10] });
                                var tableBody = [];

                                // Add table headers
                                $(selector + ' thead tr').each(function() {
                                    var headerRow = [];
                                    $(this).find('th').each(function() {
                                        headerRow.push({ text: $(this).text(), style: 'tableHeader' });
                                    });
                                    tableBody.push(headerRow);
                                });

                                // Add table data rows
                                data.forEach(function(row) {
                                    var dataRow = [];
                                    row.forEach(function(cell) {
                                        dataRow.push({ text: cell ? cell.toString() : '', style: 'tableBody' });
                                    });
                                    tableBody.push(dataRow);
                                });

                                content.push({
                                    table: {
                                        headerRows: 1,
                                        body: tableBody
                                    },
                                    layout: 'lightHorizontalLines'
                                });
                            }
                        }

                        // Add all tables to the content
                        addTableToContent('#example1', 'Laporan Klaim Poin');
                        addTableToContent('#giftTerklaim', 'Gift Terklaim');
                        addTableToContent('#giftOther', 'Gift Ditolak dan Menunggu');

                        // Update doc content
                        doc.content = content;
                    },
                    styles: {
                        header: {
                            fontSize: 18,
                            bold: true
                        },
                        subheader: {
                            fontSize: 15,
                            bold: true
                        },
                        tableHeader: {
                            bold: true,
                            fontSize: 13,
                            color: 'black'
                        },
                        tableBody: {
                            fontSize: 12
                        }
                    }
                }],
                lengthMenu: [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "All"]
                ]
            });

            $('#giftTerklaim').DataTable({
                dom: 'Blfrtip',
                buttons: [],
                lengthMenu: [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "All"]
                ]
            });

            $('#giftOther').DataTable({
                dom: 'Blfrtip',
                buttons: [],
                lengthMenu: [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "All"]
                ]
            });
        });
    </script> --}}
    <script>
        $(document).ready(function() {
            // Initialize DataTables for each table
            var table1 = $('#example1').DataTable({
                dom: 'Blfrtip',
                buttons: [{
                    extend: 'pdf',
                    text: 'Print PDF',
                    title: 'Laporan Klaim Poin',
                    customize: function(doc) {
                        // Initialize the structure for doc.content[1].table.body
                        var content = [
                            { text: 'Laporan Klaim Poin', style: 'header', alignment: 'center', margin: [0, 0, 0, 20] }
                        ];

                        // Function to push table data to doc content
                        function addTableToContent(selector, title) {
                            var table = $(selector).DataTable();
                            var data = table.data().toArray();

                            // Ensure the table is not empty
                            if (data.length) {
                                content.push({ text: title, style: 'subheader', alignment: 'left', margin: [0, 20, 0, 10] });
                                var tableBody = [];

                                // Add table headers
                                $(selector + ' thead tr').each(function() {
                                    var headerRow = [];
                                    $(this).find('th').each(function() {
                                        headerRow.push({ text: $(this).text(), style: 'tableHeader' });
                                    });
                                    tableBody.push(headerRow);
                                });

                                // Add table data rows
                                data.forEach(function(row) {
                                    var dataRow = [];
                                    row.forEach(function(cell) {
                                        dataRow.push({ text: cell ? cell.toString() : '', style: 'tableBody' });
                                    });
                                    tableBody.push(dataRow);
                                });

                                content.push({
                                    table: {
                                        headerRows: 1,
                                        body: tableBody
                                    },
                                    layout: 'lightHorizontalLines'
                                });
                            }
                        }

                        // Add all tables to the content
                        addTableToContent('#example1', 'Laporan Klaim Poin');
                        addTableToContent('#giftTerklaim', 'Gift Terklaim');
                        addTableToContent('#giftDitolak', 'Gift Ditolak');
                        addTableToContent('#giftMenunggu', 'Gift Menunggu');

                        // Update doc content
                        doc.content = content;
                    },
                    styles: {
                        header: {
                            fontSize: 18,
                            bold: true
                        },
                        subheader: {
                            fontSize: 15,
                            bold: true
                        },
                        tableHeader: {
                            bold: true,
                            fontSize: 13,
                            color: 'black'
                        },
                        tableBody: {
                            fontSize: 12
                        }
                    }
                }],
                lengthMenu: [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "All"]
                ]
            });

            // Initialize DataTables for additional tables
            $('#giftTerklaim').DataTable({
                dom: 'Blfrtip',
                buttons: [],
                lengthMenu: [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "All"]
                ]
            });

            $('#giftDitolak').DataTable({
                dom: 'Blfrtip',
                buttons: [],
                lengthMenu: [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "All"]
                ]
            });

            $('#giftMenunggu').DataTable({
                dom: 'Blfrtip',
                buttons: [],
                lengthMenu: [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "All"]
                ]
            });
        });
    </script>


@endsection
