<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- link bootstrap -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css')}}">
     <!-- link untuk fontawesome -->
     <link rel="stylesheet" href="{{asset('assets/fontawesome/css/all.min.css')}}">
    <title>Document</title>
    <title>Document</title>
</head>
{{-- <div id="auth">
    <div class="container justify-content-center">
        <div class="row">
            <div class="col-md-5 col-sm- mx-auto">
                <div class="card py-4">
                    <div class="card-body">

                            <h3 class="text-center font-weight-bold">DAFTAR</h3>

                            @csrf
                            <form action="" method="POST" id="formRegister">
                            <!-- nama lengkap -->
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama" inputmode="text" autocomplete="nama" placeholder="nama" required>
                            </div>
                            <!-- username -->
                            <div class="mb-3">
                                <label for="nama" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" inputmode="text" autocomplete="username" placeholder="username" required>
                            </div>
                             <!-- nomor hp -->
                             <div class="mb-3">
                                <label for="nomor_telpon">Nomor Telpon</label>
                                <input type="nomor_telpon" class="form-control" name="nomor_telpon" inputmode="text" placeholder="+62" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="jenis_kelamin">Jenis kelamin</label>
                                    <select class="form-select" name="jenis_kelamin" id="jenis_kelamin">
                                        <option value="">Pilih</option>
                                        <option value="L">Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                            </div>
                             <!-- password -->
                             <div class="mb-3">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" inputmode="text" autocomplete="password" placeholder="password" required>
                            </div>

                            <button type="submit" name="submit" class="btn btn-primary btn-block mt-3">Register</button>

                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div id="auth">
    <div class="container">
        <div class="row">
            <div class=" col-md-8 col-sm-10 mx-auto">
                <div class="card py-4">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold">Form Register</h5>
                        <form action="{{url('register')}}" method="POST">
                            @csrf

                            <div class="row mt-3">
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class=" form-control" id="nama" name="nama" value="" placeholder="Joko" required>
                                    <div class=" invalid-feedback"></div>
                                </div>

                                <div class="col-12  col-md-6 mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class=" form-control" id="username" name="username" value="" placeholder="Joko123" required>
                                    <div class=" invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="nomor_telpon" class="form-label">Nomor Telepon</label>
                                    <input type="text" class=" form-control" id="nomor_telpon" name="nomor_telpon" value="" placeholder="+628912345" required>
                                    <div class=" invalid-feedback"></div>
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <label class="form-label" for="jenis_kelamin">Jenis kelamin</label>
                                    <select class="form-select" name="jenis_kelamin" id="jenis_kelamin">
                                        <option value="L">Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6 mb-3">
                                    <div class="from-group">
                                        <label for="password">Password</label>
                                            <input type="password" id="password" class="form-control" name="password" value="" required>
                                    </div>
                                </div>

                                {{-- <div class="col-12 col-md-6 mb-3">
                                    <div class="from-group">
                                        <label for="konfirmasi_passwowrd">Konfirmasi Password</label>
                                            <input type="password" id="konfirmasi_passwowrd" class="form-control" name="konfirmasi_passwowrd" required>
                                    </div>
                                </div> --}}
                            </div>

                            <button type="submit" class=" btn btn-primary">Daftar</button>
                            <a href="{{url('login')}}" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- bootstrap -->
<script src="{{ asset('assets/js/app.js') }}"></script>
<script src="{{asset('assets/js/bootstrap.js')}}">
<script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/fontawesome/js/all.min.js') }}"></script>

</body>
</html>



