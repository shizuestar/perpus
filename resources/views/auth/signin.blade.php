<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('admin/assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('admin/assets/img/favicon.png') }}">
    <title>
        Soft UI Dashboard by Creative Tim
    </title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('admin/assets/css/soft-ui-dashboard.css?v=1.0.3') }}" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script> 
</head>

<body class="g-sidenav-show  bg-gray-100">
    <nav
        class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3  navbar-transparent mt-4">
        <div class="container">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white" href="{{ route('register') }}">
                Soft UI Dashboard
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
                data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon mt-2">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </span>
            </button>
            <div class="collapse navbar-collapse w-100 pt-3 pb-2 py-lg-0" id="navigation">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link me-2" href="{{ route('library.index') }}">
                            <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                            Library
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="{{ route('register') }}">
                            <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                            Sign Up
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="{{ route('login') }}">
                            <i class="fas fa-key opacity-6 text-dark me-1"></i>
                            Sign In
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <section class="min-vh-100 mb-8">
        <div class="page-header align-items-start min-vh-75 pt-5 pb-11 m-3 border-radius-lg"
            style="background-image: url('{{ asset('admin/assets/img/curved-images/curved14.jpg') }}');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <h1 class="text-white mb-2 mt-5">Selamat Datang!</h1>
                        <p class="text-lead text-white">Use these awesome forms to login or create new account in your
                            project for free.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" style="transform: translateY(-125px)">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10">
                <div class="col-xl-5 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header text-center pt-4 pb-0">
                            <h5>Form Daftar Akun</h5>
                        </div>
                        <div class="card-body">
                            <form role="form text-left" action="{{ route('register.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" placeholder="Nama lengkap anda"
                                        aria-label="Name" aria-describedby="name-addon" required>
                                    @error('name')
                                    <p class="text-danger px-1 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror" placeholder="example@email.com"
                                        aria-label="Email" aria-describedby="email-addon" required>
                                    @error('email')
                                    <p class="text-danger px-1 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="telp"
                                        class="form-control @error('telp') is-invalid @enderror" placeholder="08xxxxxxxxx"
                                        aria-label="telp" aria-describedby="telp-addon" required>
                                    @error('telp')
                                    <p class="text-danger px-1 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Password" aria-label="Password" aria-describedby="password-addon"
                                        required>
                                    @error('password')
                                    <p class="text-danger px-1 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-check form-check-info text-left">
                                    <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox"
                                        name="terms" id="flexCheckDefault" required>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Saya Setuju dengan <a href="javascript:;" class="text-dark font-weight-bolder">Syarat & Kebijakan yang berlaku</a>
                                    </label>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Daftar</button>
                                </div>
                                <p class="text-sm mt-3 mb-0 text-center">Sudah punya akun? <a href="{{ route('login') }}"
                                        class="text-dark font-weight-bolder">Masuk</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('admin/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }

    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
</body>

</html>
