@extends('layout.mainmember')

@section('judul')
    <strong>Halaman Produk</strong>
@endsection

@section('content')

<div class="welcome-message" style="margin-top: 75px;">
    <h3 class="card-title">Selamat Datang, {{ $user ? $user->username : 'Guest' }} </h3>

</div>
    <div id="carouselExampleIndicators" style="margin-top: 20px;" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="{{ url('storage/aset/foto1.jpg') }}" alt="First slide">
                {{-- <div class="carousel-caption d-none d-md-block">
                    <h5>Slider One Item</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime, nulla, tempore. Deserunt excepturi
                        quas vero.</p>
                </div> --}}
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ url('storage/aset/foto10.jpg') }}" alt="Second slide">
                {{-- <div class="carousel-caption d-none d-md-block">
                    <h5>Slider One Item</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime, nulla, tempore. Deserunt excepturi
                        quas vero.</p>
                </div> --}}
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ url('storage/aset/foto11.jpg') }}" alt="Third slide">
                {{-- <div class="carousel-caption d-none d-md-block">
                    <h5>Slider One Item</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime, nulla, tempore. Deserunt excepturi
                        quas vero.</p>
                </div> --}}
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

<h3 class="container mt-3 text-center">Rekomendasi</h3>
<div class="container mb-4 mt-3">
    <div class="row">
        @foreach ($gunungs->slice(0, 4) as $gunung) <!-- Batasi jumlah gunung yang ditampilkan -->
            <div class="col-md-3 mb-4 mt-1">
                <div class="item">
                    <div class="item-image" style="width: 270px; height: 250px; border: 1px solid #ccc; position: relative;">
                        <img src="{{ asset('storage/gunung/' . $gunung->gambar_gunung) }}" alt="Gambar gunung"
                            style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="item-meta text-center" style="font-size: 20px;"> <!-- Menambahkan font-size 15px dan centering -->
                        <p style="margin-top: 17px;">Gunung {{ ucwords($gunung->nama_gunung) }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @if ($gunungs->count() > 4) <!-- Tampilkan tombol lihat semua jika jumlah gunung melebihi 8 -->
        <div class="text-end"> <!-- Menggunakan text-end untuk menggeser tombol ke kanan -->
            <a href="{{ url('/member/rekomendasi') }}" class="btn btn-primary">Lihat Semua Gunung</a> <!-- Menggunakan kelas btn-secondary untuk warna abu-abu -->
        </div>
    @endif
</div>






    <div class="about-us">
        <div class="container">
            <h2>Tentang Kami</h2>
            <p>Forester Jakal adalah sebuah toko yang menjual peralatan pendakian dengan merk Consina dan Forester.Forester jakal merupakan anak cabang dari perusahaan serupa yaitu Nomad Adventure. Sebagai salah satu dari empat cabang yang dimiliki oleh Nomad Adventure. Pada dasarnya, karena Forester Jakal merupakan perusahaan yang menjalin kerjasama konsinyasi dengan Consina dan Forester mereka tidak mempunyai visi misi sendiri dan berpegang pada visi misi dari 2 brand yang ada pada mereka yaitu Consina dan Forester.
        </div>
    </div>
@endsection
