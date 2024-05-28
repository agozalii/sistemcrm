<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <style>
        /* CSS Styling for Navbar and Carousel */
        /* CSS Styling for Navbar and Carousel */
.navbar {
    background-color: rgb(11, 142, 138);
}

.navbar-scrolled {
    background-color: #7FC3C3;
}

.navbar-brand {
    color: #fff;
    font-size: 25px;
    text-transform: uppercase;
    font-weight: bold;
    letter-spacing: 2px;
}

.navbar-nav .nav-link {
    color: #fff; /* Warna default putih */
}

.navbar-nav .nav-link:hover,
.navbar-nav .nav-link.active:hover {
    color: #1e403c; /* Warna saat di-hover (hijau) */
}

.navbar-nav .nav-link.active {
    color: #4f8f88; /* Warna saat item aktif (hitam) */
}

.navbar-toggler {
    background: #fff;
    padding: 1px 5px;
    font-size: 18px;
    line-height: 0.3;
}

.carousel-item {
    width: 100%;
    height: 90vh;
    min-height: 300px;
    background: no-repeat center center scroll;
    background-size: cover;
}

.carousel-caption {
    bottom: 270px;
}

.carousel-caption h5 {
    font-size: 45px;
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-top: 25px;
}

.carousel-caption p {
    width: 75%;
    margin: auto;
    font-size: 18px;
    line-height: 1.9;
}

.about-us {
    background-color: #f8f9fa;
    padding: 50px 0;
}

.about-us h2 {
    text-align: center;
    margin-bottom: 30px;
}

.about-us p {
    text-align: center;
    font-size: 20px;
    line-height: 1.6;
}

body {
    font-family: "Times New Roman", Times, serif;
}

.navbar {
    box-shadow: 0px 2px 4px rgba(176, 142, 142, 0.1);
}

.navbar-brand,
.nav-link {
    font-family: "Times New Roman", Times, serif;
    font-size: 14px;
}

.welcome-message {
    background-color: #ffffff;
    color: #1C5C58;
    padding: 5px;
    text-align: center;
    border: 1px solid #1C5C58;
}

.navbar-nav .nav-link.active {
    font-weight: bold;
}

.whatsapp-float {
    position: fixed;
    width: 85px;
    height: 85px;
    bottom: 40px;
    right: 40px;
    border-radius: 85px;
    text-align: center;
    z-index: 1000;
    display: flex;
    justify-content: center;
    align-items: center;
}

.whatsapp-icon {
    width: 75px;
    height: 75px;
}

    </style>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('css/custom.css') }}"> --}}
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-success fixed-top" style="background-color: #68b4a8">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img style="height: 30px; display: inline-block; vertical-align: middle;" src="{{url('/image/forester.png')}}" alt="logo" />
                <img style="height: 30px; display: inline-block; vertical-align: middle;" src="{{url('/image/cnsnlogo.png')}}" alt="logo" />
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse text-light" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item ">
                        <a class="nav-link " href="{{ url('/member/dashboard') }}">Beranda</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link ml-4" href="{{ route('rekomendasi') }}">Rekomendasi</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link ml-4" href="{{ route('poin') }}">Poin</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link ml-4" href="{{ route('member.statusklaim') }}">Status Klaim</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link ml-4" href="{{ url('/member/kritiksaran') }}">Kritik Saran</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link ml-4" href="{{ url('/member/profil') }}">Profil</a>
                    </li>
                    @if(Auth::user() && Auth::user()->role != 'member')
                    <li class="nav-item ">
                        <a class="nav-link ml-4" href="{{ url('/home') }}">Admin</a>
                    </li>
                    @endif
                    <li class="nav-item ">
                        @if(Auth::user() && Auth::user()->id != '')
                        <a class="ml-4 mt-1 btn btn-primary btn-sm text-white" href="{{ url('logout') }}" role="button">
                           <i class="nav-icon fas fa-user-circle mr-2"></i> Logout
                        </a>
                        @else
                        <a class="ml-4 mt-1 btn btn-primary btn-sm text-white" href="{{ url('login') }}" role="button">
                           <i class="nav-icon fas fa-user-circle mr-2"></i> Login
                        </a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <a href="https://chat.whatsapp.com/Kcz49aF78QsJQtSMAgFhf0" class="whatsapp-float" target="_blank">
        <img src="{{ url('storage/aset/logowa.png') }}" alt="WhatsApp" class="whatsapp-icon">
    </a>

    @yield('content')

    <!-- JavaScript for Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(window).scroll(function() {
            var scroll = $(window).scrollTop();

            if (scroll > 50) {
                $(".navbar").addClass("navbar-scrolled");
            } else {
                $(".navbar").removeClass("navbar-scrolled");
            }
        });


        $(document).ready(function() {
            var currentUrl = window.location.href;

            $('.navbar-nav .nav-link').each(function() {
                var linkUrl = $(this).attr('href');

                if (currentUrl.indexOf(linkUrl) !== -1) {
                    $(this).addClass('active');
                }
            });
        });
    </script>
</body>

</html>
