{{-- @extends('layout.mainmember')

@section('judul')
    <strong>Detail Produk</strong>
@endsection

@section('content')
    <style>
        /* .description-header {
        border-bottom: 1px solid #ccc;
        padding-bottom: 10px;
        margin-bottom: 20px;
    } */

        .description-content {
            border: 1px solid #ccc;
            padding: 10px;
            padding-left: 10px;
            "

        }

        .table th,
        .table td {
            padding: 0.5rem;
            /* Atur padding antara teks dan kolom */
        }
    </style>
    <div class="container" style="margin-top: 150px;">
        <div class="card">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <!-- Menampilkan gambar produk -->
                    <img src="{{ asset('storage/gunung/' . $gunung->gambar_gunung) }}" class="card-img-top gunung-image"
                        style="width: 350px; height: 350px; object-fit: cover;" alt="{{ $gunung->nama_guung }}">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h3 class="card-title mb-3">{{ strtoupper($gunung->nama_gunung) }}</h3>
                        <div class="description-header mt-3">
                            <h5>Detail</h4>
                        </div>

                        <table class="custom-table" style="width: 200px;">
                            <tbody>
                                <tr>
                                    <td style="padding-left: 20px;">Ketinggian</td>
                                    <td>:</td>
                                    <td style="padding-left: 10px;"><strong
                                            style="color: #148E8E;">{{ $gunung->ketinggian }}</strong></td>
                                </tr>
                                <tr>
                                    <td style="padding-left: 20px;">Kesulitan</td>
                                    <td>:</td>
                                    <td style="padding-left: 10px;"><strong
                                            style="color: #148E8E;">{{ $gunung->kesulitan }}</strong></td>
                                </tr>
                                <tr>
                                    <td style="padding-left: 20px;">Lama Pendakian</td>
                                    <td>:</td>
                                    <td style="padding-left: 10px;"><strong
                                            style="color: #148E8E;">{{ $gunung->lama_pendakian }}</strong></td>
                                </tr>
                                <tr>
                                    <td style="padding-left: 20px;">Suhu</td>
                                    <td>:</td>
                                    <td style="padding-left: 10px;"><strong
                                            style="color: #148E8E;">{{ $gunung->suhu }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <h4>Produk yang Sesuai dengan Gunung {{ $gunung->nama_gunung }}</h4>
        <div class="row">
            @foreach ($produk as $product)
            <div class="col-md-3 mb-4 mt-1">
                <div class="item">
                    <div class="item-image"
                        style="width: 270px; height: 250px; border: 1px solid #ccc; position: relative;">
                                <img src="{{ asset('storage/produk/' . $product->gambar_produk) }}" class="card-img-top product-image" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>

                    <div class="item-meta text-center" style="font-size: 20px;">
                        <!-- Menambahkan font-size 15px dan centering -->
                        <p style="margin-top: 17px;">product {{ ucwords($product->nama_product) }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>




@endsection --}}

@extends('layout.mainmember')

@section('judul')
    <strong>Detail Produk</strong>
@endsection

@section('content')
    <style>
        /* .description-header {
        border-bottom: 1px solid #ccc;
        padding-bottom: 10px;
        margin-bottom: 20px;
    } */

        .description-content {
            border: 1px solid #ccc;
            padding: 10px;
            padding-left: 10px;
            "

        }

        .table th,
        .table td {
            padding: 0.5rem;
            /* Atur padding antara teks dan kolom */
        }
    </style>
    <div class="container" style="margin-top: 150px;">
        <div class="card">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <!-- Menampilkan gambar gunung -->
                    <img src="{{ asset('storage/gunung/' . $gunung->gambar_gunung) }}" class="card-img-top gunung-image"
                        style="width: 350px; height: 350px; object-fit: cover;" alt="{{ $gunung->nama_gunung }}">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h3 class="card-title mb-3">{{ strtoupper($gunung->nama_gunung) }}</h3>
                        <div class="description-header mt-3">
                            <h5>Detail</h4>
                        </div>

                        <table class="custom-table" style="width: 200px;">
                            <tbody>
                                <tr>
                                    <td style="padding-left: 20px;">Ketinggian</td>
                                    <td>:</td>
                                    <td style="padding-left: 10px;"><strong
                                            style="color: #148E8E;">{{ $gunung->ketinggian }}</strong></td>
                                </tr>
                                <tr>
                                    <td style="padding-left: 20px;">Kesulitan</td>
                                    <td>:</td>
                                    <td style="padding-left: 10px;"><strong
                                            style="color: #148E8E;">{{ $gunung->kesulitan }}</strong></td>
                                </tr>
                                <tr>
                                    <td style="padding-left: 20px;">Lama Pendakian</td>
                                    <td>:</td>
                                    <td style="padding-left: 10px;"><strong
                                            style="color: #148E8E;">{{ $gunung->lama_pendakian }}</strong></td>
                                </tr>
                                <tr>
                                    <td style="padding-left: 20px;">Suhu</td>
                                    <td>:</td>
                                    <td style="padding-left: 10px;"><strong
                                            style="color: #148E8E;">{{ $gunung->suhu }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Filter Kategori -->
{{-- <div class="mb-3">
    <h5>Filter Kategori</h5>
    <form action="{{ route('gunung.filter', $gunung->id) }}" method="GET">
        <select name="kategori">
            <option value="">Semua Kategori</option>
            @foreach ($kategoriProduk as $kategori)
                <option value="{{ $kategori }}">{{ $kategori }}</option>
            @endforeach
        </select>
        <button type="submit">Filter</button>
    </form>
</div> --}}

    <div class="container mt-4">

        <div class="row">
            <!-- Filter Kategori -->
            <div class="row">
                <!-- Filter Kategori -->
                <div class="col-md-4 offset-md-8 mb-3">
                    <form action="{{ route('gunung.filter', $gunung->id) }}" method="GET" class="d-flex align-items-center">
                        <select name="kategori" class="form-control mr-2" style="flex-grow: 1;">
                            <option value="">Semua Kategori</option>
                            @foreach ($kategoriProduk as $kategori)
                                <option value="{{ $kategori }}" {{ $kategori == request('kategori') ? 'selected' : '' }}>{{ $kategori }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                </div>
            </div>

        {{-- <h4>Produk yang Sesuai dengan Gunung {{ $gunung->nama_gunung }}</h4> --}}
        <!-- Filter Kategori -->

        <!-- Daftar Produk -->
        <div class="row">
            @foreach ($produk as $product)
                <div class="col-md-3 mb-4 mt-1">
                    <div class="item">
                        <div class="item-image"
                            style="width: 270px; height: 250px; border: 1px solid #ccc; position: relative;">
                            <img src="{{ asset('storage/produk/' . $product->gambar_produk) }}" class="card-img-top product-image"
                                style="width: 100%; height: 100%; object-fit: cover;">
                        </div>

                        <div class="item-meta text-center" style="font-size: 20px;">
                            <p style="margin-top: 17px;">{{ ucwords($product->nama_produk) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
