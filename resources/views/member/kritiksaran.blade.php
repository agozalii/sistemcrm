@extends('layout.mainmember')

@section('judul')
    <strong>Halaman Produk</strong>
@endsection

@section('content')
    <main class="main main-product" style="margin-top: 75px" role="main">
        <div class="container">
            <div class="page">
                <div class="wrapper">
                    <div class="page-hero">
                        <h1 style="text-align: center; margin-bottom:50px;">Kritik & Saran</h1>
                    </div>
                    <div id="addpesan">
                        <div class="page-content">
                            <div class="contact">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="contact-form">
                                            <div class="heading">
                                            </div>
                                            <form id="formData" action="{{ route('simpanKritikSaran') }}" enctype="multipart/form-data" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="isi_kritiksaran" class="form-label">Kritik dan Saran dari Anda Sangat Berharga Bagi Kami</label>
                                                    <textarea name="isi_kritiksaran" class="form-control" id="isi_kritiksaran" rows="11" placeholder="Tuliskan Kritik dan Saran Anda Disini!!!"></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Kirim</button>

                                                {{-- <button style="background-color: #B1D8D8; " class="btn btn-success mb-3" type="submit">
                                                    <span class="btn btn-primary"> Kirim </span>
                                                </button> --}}
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="contact-info">
                                            <div class="section">
                                                <p class="heading"><strong>HUBUNGI KAMI</strong> </p>
                                                <p class="text" style="margin-top: -10px;">Jika Anda memiliki pertanyaan terkait produk dan layanan atau ingin memberikan saran maupun kritik silahkan hubungi tim Forester Jakal melalui : </p>
                                            </div>
                                            <div class="section">
                                                <p class="heading"><i class="fas fa-envelope fa-lg mr-2"></i><strong>Email</strong></p>
                                                <p class="text" style="padding-left: 28px; margin-top: -10px;">Foresterjakal@gmail.com</p>
                                                <!-- Masukkan alamat email yang sesuai di sini -->
                                            </div>
                                            <div class="section">
                                                <p class="heading"><i class="fas fa-phone-square fa-lg mr-2"></i> <strong>No. Telepon</strong></p>
                                                <p class="text" style="padding-left: 28px; margin-top: -10px;">0819-3286-1759</p>
                                                <!-- Masukkan nomor telepon yang sesuai di sini -->
                                            </div>
                                            <div class="section">
                                                <p class="heading"><i class="fas fa-map-marker-alt fa-lg mr-2"></i> <strong>Alamat</strong></p>
                                                <p class="text" style="padding-left: 28px; margin-top: -10px;">Jl. Kaliurang No.49 A, Manggung, Caturtunggal, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281</p>
                                                <!-- Masukkan nomor telepon yang sesuai di sini -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="tampilData" style="display:none;"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> <!-- Include SweetAlert JS -->

    <script>
        $(document).ready(function() {
            $('#formData').submit(function(e) {
                e.preventDefault(); // Prevent the default form submission

                // Serialize the form data
                var formData = $(this).serialize();

                // Kirim form menggunakan Ajax
                $.ajax({
                    url: $(this).attr('action'), // Ambil URL dari atribut action form
                    type: $(this).attr('method'), // Ambil metode HTTP dari atribut method form
                    data: formData,
                    success: function(response) {
                        // Tampilkan pesan sukses menggunakan SweetAlert
                        Swal.fire({
                            title: 'Pesan Berhasil Terkirim',
                            text: 'Terimakasih atas feedback yang Anda berikan',
                            icon: 'success'
                        });

                        // Reset form input
                        $('#formData')[0].reset();
                    },
                    error: function(xhr, status, error) {
                        // Tampilkan pesan error menggunakan SweetAlert
                        Swal.fire({
                            title: 'Error',
                            text: 'Terjadi kesalahan saat menyimpan data.',
                            icon: 'error'
                        });
                    }
                });
            });
        });
    </script>
@endsection
