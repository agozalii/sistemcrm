@extends('layout.mainmember')

@section('judul')
    <strong>Halaman Transaksi</strong>
@endsection

@section('content')

    <h1 class="container text-center" style="margin-top: 75px;">Status Klaim</h1>
    <h4 class="text-center">Sisa Poin Anda : {{ $user->poin }}</h4>
    <div class="container">
    @include('layout.alerts')
        <div style="overflow-x:auto; margin-top: 20px;">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Nama Gift</th>
                        <th>Tanggal Klaim</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($klaimPoin as $index => $klaim)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $klaim->user->nama }}</td>
                            <td>{{ $klaim->gift->nama_gift }}</td>
                            <td>{{ date('d F Y', strtotime($klaim->created_at)) }}</td>
                            <td>
                                @if($klaim->status == 'Menunggu')
                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                @else
                                    <span class="badge bg-warning text-light">Terklaim</span>
                                @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
