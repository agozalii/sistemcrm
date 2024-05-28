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

