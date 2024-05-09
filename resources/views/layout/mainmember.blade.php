<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <style>
        /* CSS Styling for Navbar and Carousel */
        .navbar {
            /* background-color: #148E8E;
            opacity: 32%; */
            background-color: rgba(20, 142, 142, 0.32);
        }

        .navbar-scrolled {
            background-color: #7FC3C3;
            /* Warna latar belakang tanpa opacity */
        }

        .navbar-brand {
            color: #fff;
            font-size: 25px;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 2px;
        }

        .navbar-nav .nav-link {
            color: #fff;
            padding: .2rem 1rem;
        }

        .navbar-nav .active>.nav-link,
        .navbar-nav .nav-link.active,
        .navbar-nav .nav-link.show,
        .navbar-nav .show>.nav-link {
            color: #fff;
        }

        .navbar-toggler {
            background: #fff;
            padding: 1px 5px;
            font-size: 18px;
            line-height: 0.3;
        }

        .navbar-light .navbar-nav .nav-link:focus,
        .navbar-light .navbar-nav .nav-link:hover {
            color: #fff;
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
            /* Background color for About Us section */
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

            /* Menggunakan Montserrat untuk seluruh teks di body */
            /* Ukuran font default */
        }

        .navbar {
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            /* Tambahkan bayangan dengan warna rgba(0, 0, 0, 0.1) */
        }

        .navbar-brand,
        .nav-link {
            font-family: "Times New Roman", Times, serif;
            /* Menggunakan Montserrat untuk teks di navbar */
            font-size: 14px;
            /* Ukuran font untuk navbar */
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

    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Forester Jakal</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Forester Jakal</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item ">
                        <a class="nav-link " style="color: #303030" href="{{ url('/member/dashboard') }}">Beranda</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link ml-4" style="color: #303030" href="{{ route('rekomendasi') }}">Rekomendasi</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link ml-4" style="color: #303030" href="{{ route('poin') }}">Poin</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link ml-4" style="color: #303030" href="{{ route('member.statusklaim') }}">Status Klaim</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link ml-4" style="color: #303030" href="{{ url('/member/kritiksaran') }}">Kritik Saran</a>
                    </li>
                    {{-- <li class="nav-item ">
                        <a class="nav-link ml-4" style="color: #303030" href="{{ url('/member/tentangkami') }}">Tentang Kami</a>
                    </li> --}}
                    <li class="nav-item ">
                        <a class="nav-link ml-4" style="color: #303030" href="{{ url('/member/profil') }}">Profil</a>
                    </li>
                    </li>
                    @if(Auth::user() && Auth::user()->role != 'member')
                    <li class="nav-item ">
                        <a class="nav-link ml-4" style="color: #303030" href="{{ url('/home') }}">Admin</a>
                    </li>
                    @endif
                    <li class="nav-item ">
                        @if(Auth::user() && Auth::user()->id != '')
                        <a class="ml-4 btn btn-primary btn-sm text-white" href="{{ url('logout') }}" role="button" style="color: #303030">
                           <i class="nav-icon fas fa-user-circle mr-2"></i> Logout
                        </a>
                        @else
                        <a class="ml-4 btn btn-primary btn-sm text-white" href="{{ url('login') }}" role="button" style="color: #303030">
                           <i class="nav-icon fas fa-user-circle mr-2"></i> Login
                        </a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    {{-- <nav class="navbar navbar-light bg-light sticky-top" style="border-bottom: 1px solid #dee2e6;">
        <div class="container">
            <a class="navbar-brand">FORESTER JAKAL</a>
        </div>
    </nav>

    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
            </div>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="bi bi-person-fill"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="bi bi-coin"></i></a>
                </li>
            </ul>
        </div>
    </nav> --}}






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

            if (scroll > 50) { // Misalkan saat user telah meng-scroll 50 piksel
                $(".navbar").addClass("navbar-scrolled"); // Tambahkan kelas untuk navbar saat di-scroll
            } else {
                $(".navbar").removeClass("navbar-scrolled"); // Hapus kelas untuk navbar saat di-scroll
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

            // Menambahkan efek hover pada teks dropdown
            $('.nav-link').mouseenter(function() {
                $(this).css('color', '#14534F'); // Mengubah warna teks saat hover
            });
            $('.nav-link').mouseleave(function() {
                $(this).css('color', '#303030'); // Mengembalikan warna teks ke aslinya saat tidak hover
            });
            $('.dropdown-item').mouseenter(function() {
                $(this).css('color', '#14534F'); // Mengubah warna teks saat hover
            });

            $('.dropdown-item').mouseleave(function() {
                $(this).css('color', ''); // Mengembalikan warna teks ke aslinya saat tidak hover
            });

            // Script untuk dropdown menu
            $('.nav-link.dropdown-toggle').mouseenter(function() {
                $(this).addClass('show');
                $(this).next('.dropdown-menu').addClass('show');
            });

            $('.nav-link.dropdown-toggle').mouseleave(function() {
                $(this).removeClass('show');
                $(this).next('.dropdown-menu').removeClass('show');
            });

            $('.dropdown-menu').mouseenter(function() {
                $(this).addClass('show');
            });

            $('.dropdown-menu').mouseleave(function() {
                $(this).removeClass('show');
                $(this).prev('.dropdown-toggle').removeClass('show');
            });
        });
    </script>



</body>

</html>