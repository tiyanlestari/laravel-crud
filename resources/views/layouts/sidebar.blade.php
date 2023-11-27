<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Mahasiswa</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="{{route  ('home') }}">MAHASISWA</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        {{-- <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i
                        class="fas fa-search"></i></button>
            </div>
        </form> --}}
        <!-- Navbar-->
        <!-- Navbar-->
    <ul class="navbar-nav ms-auto" style="padding-right: 20px;">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                {{-- <li><a class="dropdown-item" href="#!">Pengaturan</a></li>
                <li><a class="dropdown-item" href="#!">Log Aktivitas</a></li> --}}
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </ul>
        </li>
    </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        {{-- <div class="sb-sidenav-menu-heading">Core</div> --}}
                        <a class="nav-link" href="{{ route('mahasiswa') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-graduation-cap"></i></div>
                            Mahasiswa
                        </a>
                        <a class="nav-link" href="{{ route('matkul') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                            Mata Kuliah
                        </a>
                        <a class="nav-link" href="{{ route('dosen') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                            Dosen
                        </a>
                        <a class="nav-link" href="{{ route('programstudi') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-reader"></i></div>
                            Program Study
                        </a>
                        <a class="nav-link" href="{{ route('nilai') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-calculator"></i></div>
                            Nilai
                        </a>
                    </div>
                </div>

            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main class="py-4 container  ml-5">
                @yield('content')
            </main>
            </nav>

        </div>




        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
        </script>
        <script src="js/scripts.js"></script>
</body>

</html>
