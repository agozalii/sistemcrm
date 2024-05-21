@extends('layout.mainmember')

@section('judul')
    <strong>Halaman Produk</strong>
@endsection

@section('content')
    <h3 class="container text-center" style="margin-top: 75px;">Rekomendasi</h3>
    <div class="container mb-4 mt-3">
        <div class="row">
            @foreach ($gunungs as $gunung)
                <div class="col-md-3 mb-4 mt-1">
                    <div class="item">
                        <div class="item-image"
                            style="width: 270px; height: 250px; border: 1px solid #ccc; position: relative;">
                            <a href="{{ route('gunung.filter', ['id' => $gunung->id]) }}">
                                    <img src="{{ asset('storage/gunung/' . $gunung->gambar_gunung) }}" class="card-img-top product-image" style="width: 100%; height: 100%; object-fit: cover;" alt="{{ $gunung->nama_gunung }}" data-href="{{ route('gunung.filter', ['id' => $gunung->id]) }}">
                                </a>
                        </div>

                        <div class="item-meta text-center" style="font-size: 20px;">
                            <!-- Menambahkan font-size 15px dan centering -->
                            <p style="margin-top: 17px;">Gunung {{ ucwords($gunung->nama_gunung) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection



{{-- @extends('layout.mainmember')

@section('judul')
    <strong>Halaman Rekomendasi</strong>
@endsection

@section('content')
    <h3 class="container text-center" style="margin-top: 150px;">Rekomendasi</h3>

    <div class="container" style="margin-top: 50px;">
        <form action="{{ route('rekomendasi') }}" method="GET">
            <div class="form-group">
                <label for="gunung">Pilih Gunung:</label>
                <select class="form-control" id="gunung" name="gunung">
                    @foreach ($gunungs as $gunung)
                        <option value="{{ $gunung->id }}">{{ $gunung->nama_gunung }}</option>
                    @endforeach
                </select>
            </div>
        </form>


        <div class="mt-4">
            @if (isset($rekomendasiProduk) && $rekomendasiProduk->isNotEmpty())
                <h4>Rekomendasi Produk untuk {{ $gunung->nama_gunung }}</h4>
                <div class="row">
                    @foreach ($rekomendasiProduk as $produk)
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <img src="{{ asset('storage/produk/' . $produk->gambar_produk) }}" class="card-img-top" alt="{{ $produk->nama_produk }}" style="width: 100%; height: 100%; object-fit: cover;">
                                <div class="card-body">
                                     <h5 class="card-title">{{ $produk->nama_produk }}</h5>
                                     <p class="card-text">Harga: {{ $produk->harga_produk }}</p>
                                 </div>
                             </div>
                             <div class="card">
                                <!-- Menampilkan gambar produk -->
                                    <div class="card-img-top" style="width: 100% ; height: 200px; overflow: hidden;">
                                        <img src="{{ asset('storage/produk/' . $produk->gambar_produk) }}" style="width: 100%; height: 100%; object-fit: cover;" alt="{{ $produk->nama_produk }}">
                                    </div>
                                <div class="item-meta text-center" style="font-size: 15px;"> <!-- Menambahkan font-size 15px dan centering -->
                                    <p style="margin-top: 17px; font-weight: bold;">{{ $produk->nama_produk }}</p> <!-- Menjadikan nama produk tebal (bold) -->
                                    <p style="margin-top: -15px; color: #148E8E;">Harga: {{ $produk->harga_produk }}</p>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            @else
                <p>Tidak ada produk yang sesuai dengan gunung yang dipilih.</p>
            @endif
        </div>
    </div>


@endsection --}}
