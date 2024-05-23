@extends('layout.main')

@section('judul')
Dashboard
@endsection

@section('isi')
<div class="card">
    <div class="card-header">
        <div class="mt-2">
            <form action="{{ route('manajer.dashboard') }}" method="GET">
                <div class="row">
                    <div class="col-md-3">
                        <label for="tgl_awal">Tgl. Awal</label>
                        <input type="date" name="tgl_awal" class="form-control" id="datepicker" placeholder="Tgl. Awal"
                            value="{{ $tgl_awal }}">
                    </div>
                    <div class="col-md-3">
                        <label for="tgl_akhir">Tgl. Akhir</label>
                        <input type="date" name="tgl_akhir" class="form-control" id="datepicker" placeholder="Tgl. Awal"
                            value="{{ $tgl_akhir }}">
                    </div>
                    <div class="col-md-3 d-inline-flex gap-1">
                        <button type="submit" class="btn btn-primary" style="margin-top: 32px"><i
                                class="fa fa-filter"></i> Filter</button>
                        <a href="{{ route('manajer.dashboard') }}" class="btn btn-danger" style="margin-top: 32px"><i
                                class="fa fa-eraser"></i> Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-7">
                <div>
                    <canvas id="giftChart" width="200" height="100"></canvas>
                </div>
            </div>
            <div class="col-md-3 card ml-4 bg-info" style="overflow-x: auto">
                <h3 class="text-center mt-5">Member Loyal</h3>
                <div class="text-center">
                    <i class="fa fa-trophy fa-5x mb-5 mt-5 text-warning"></i>
                    <h2 class="text-center mt-4">{{ $memberLoyal }}</h2>
                </div>
                <h5 class="text-center mt-2">{{ $tgl_awal && $tgl_akhir ? date('Y F d', strtotime($tgl_awal)) . ' - ' . date('Y F d', strtotime($tgl_akhir)) : date('Y F d').' - '. date('Y F d') }}</h4>
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
                type: 'bar',
                data: {
                    labels: giftNames,
                    datasets: [{
                        label: 'Gift Terklaim',
                        data: useCount,
                        backgroundColor: '#03AED2',
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
    @endsection