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
         <link rel="stylesheet" href="{{asset('assets/fontawesome/css/all.min.css')}}">
    <title>Document</title>
</head>
<div id="auth">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12 mx-auto">
                <div class="card py-4">
                    <div class="card-body">
                        <div class="text-center mb-6">
                            <img src="assets/gambar/logo.png" height="100" class="mb-4">
                            <h3>SELAMAT DATANG KIDS</h3>
                            <p>silahkan login</p>

                            @if ($errors->any())
                            <div class=" alert alert-warning" role=" alert ">
                            <ul>
                                @foreach ($errors->all() as $item )
                                <li>{{$item}}</li>

                                @endforeach
                            </ul>
                            </div>
                            @endif

                                <form action="{{url('login/proses')}}" method="POST">
                                    @csrf
                                    <div class="form-group position-relative has-icon-left">
                                        <label for="username">username</label>
                                        <div class="position-relatife">
                                            <input type="text" class="form-control" value="{{old('username')}}" id="username" name="username" autocomplete="off"  >
                                        </div>
                                    </div>

                                    <div class="form-group position-relative has-icon-left">
                                        <div class="clearfix">
                                            <label for="password">Password</label>
                                        </div>
                                        <div class="position-relative">
                                            <input type="password" class="form-control" id="password" name="password">
                                        </div>
                                    </div>

                                    <div class="d-grid gap-2 mt-4">
                                        <button class="btn btn-primary">Sign in</button>
                                    </div>
                                    <div class="d-flex justify-content-center pt-2">
                                        <p>Belum punya akun? <a href="/register">Daftar</a></p>
                                    </div>

                                </form>
                        </div>

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
