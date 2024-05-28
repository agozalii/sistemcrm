@extends('layout.mainmember')

@section('judul')
    <strong>Halaman Transaksi</strong>
@endsection

@section('content')
    @include('layout.alerts')
    <div class="container">
        <div class="mb-3 d-flex justify-content-between" style="margin-top: 80px;">
        </div>
        <div style="display: flex; justify-content: center;items-align: center">
            <h5>Nama member : {{ Auth::user()->nama }}</h5>
       </div>

        <div style="overflow-x:auto; margin-top: 20px;">
            <table class="table table-bordered table-striped"
                style="width:800px; font-size: 20px; margin: 0 auto; margin-bottom:40px">
                <thead>
                    <tr>
                        <td style="text-align: center">Jumlah Transaksi: <br> <strong>{{ $jumlahTransaksi }}</strong></td>
                        <td style="text-align: center">Total Transaksi: <br> <strong>Rp. {{ number_format($totalTransaksi, 2) }}</strong></td>
                        <td style="text-align: center">Poin Saya: <br><strong>{{ $totalPoin }}</strong></td>
                        <th style="text-align: center;"> <a href="{{ route('klaim') }}" class="btn btn-primary mb-2" style="width: 150px;">Tukarkan Poin</a></th>
                        </th>
                    </tr>
                </thead>
            </table>
            <table class="table table-bordered table-striped" style="min-width:1000px; overflow-y: auto;">
                <thead>
                    <tr style="text-align: center">
                        <th>No</th>
                        <th>Tanggal Transaksi</th>
                        <th>Total</th>
                        <th>Poin Diperoleh</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td>{{ $no++ }}</td>
                            {{-- <td>{{ Auth::user()->nama }}</td> --}}
                            <td>{{ $transaction->tanggal_transaksi }}</td>
                            <td>{{ $transaction->total }}</td>
                            <td>{{ $transaction->poin_diperoleh }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
