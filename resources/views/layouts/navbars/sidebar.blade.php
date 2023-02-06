<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <div class="text-center"><!-- bran/smk.png -->
            <img src="{{ asset('argon') }}/img/brand" class="mt-2" style="width: 60px;" alt="..."> <br>
            <div class="mt-2">
                <h3 class="text-center fs-3 fw-bold "><!-- SMK TAMTAMA KROYA --></h3>
            </div>
        </div>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="/">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            @if (auth()->check())    
                @if (auth()->user()->role_id == 1)
                    <!-- Navigation -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/admin">
                                <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                            </a>
                        </li>
                    </ul>
                    <!-- Divider -->
                    <hr class="my-3">
                    <!-- Heading -->
                    <h6 class="navbar-heading text-muted">MASTER DATA</h6>
                    <!-- Navigation -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/student">
                                <i class="ni ni-tv-2 text-primary"></i> {{ __('Siswa') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/student-class">
                                <i class="ni ni-tv-2 text-primary"></i> {{ __('Kelas') }}
                            </a>
                        </li>
                    </ul>
                    <!-- Divider -->
                    <hr class="my-3">
                    <!-- Heading -->
                    <h6 class="navbar-heading text-muted">Forum</h6>
                    <ul class="navbar-nav mb-md-3">
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/forum">
                                <i class="ni ni-tv-2 fw-bold text-primary"></i> {{ __('Daftar Diskusi') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/forum/create">
                                <i class="ni ni-tv-2 fw-bold text-primary"></i> {{ __('Buat Diskusi Baru') }}
                            </a>
                        </li>
                    </ul>  
                    <!-- Divider -->
                    <hr class="my-3">
                    <!-- Heading -->
                    <h6 class="navbar-heading text-muted">Basis Pengetahuan</h6>
                    <ul class="navbar-nav mb-md-3">
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/problem">
                                <i class="ni ni-tv-2 fw-bold text-primary"></i> {{ __('Permasalahan') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/counseling">
                                <i class="ni ni-tv-2 fw-bold text-primary"></i> {{ __('Bimbingan dan Konseling') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin">
                                <i class="ni ni-tv-2 fw-bold text-primary"></i> {{ __('Kasus Baru') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/solution/">
                                <i class="ni ni-tv-2 fw-bold text-primary"></i> {{ __('Pencarian Solusi Masalah') }}
                            </a>
                        </li>
                    </ul>  
                @elseif (auth()->user()->role_id == 2)
                    <!-- Navigation -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/counselor">
                                <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                            </a>
                        </li>
                    </ul>
                    <!-- Divider -->
                    <hr class="my-3">
                    <!-- Heading -->
                    <h6 class="navbar-heading text-muted">MASTER DATA</h6>
                    <!-- Navigation -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/counselor/student">
                                <i class="ni ni-tv-2 text-primary"></i> {{ __('Siswa') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="/counselor/student-class">
                                <i class="ni ni-tv-2 text-primary"></i> {{ __('Kelas') }}
                            </a>
                        </li>
                    </ul>
                    <!-- Divider -->
                    <hr class="my-3">
                    <!-- Heading -->
                    <h6 class="navbar-heading text-muted">Forum</h6>
                    <ul class="navbar-nav mb-md-3">
                        <li class="nav-item">
                            <a class="nav-link" href="/counselor/forum">
                                <i class="ni ni-tv-2 fw-bold text-primary"></i> {{ __('Daftar Diskusi') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/counselor/forum/create">
                                <i class="ni ni-tv-2 fw-bold text-primary"></i> {{ __('Buat Diskusi Baru') }}
                            </a>
                        </li>
                    </ul>
                @endif    
            @else
                <h1>Displaying guest content</h1>
            @endif
        </div>
    </div>
</nav>
