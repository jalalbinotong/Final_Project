<header class="p-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="logo">E-class</h1>
            <div class="d-flex align-items-center">
                <nav>
                    <a href="/" class="text-decoration-none text-dark me-3">Home</a>
                    <a href="{{ route('mapel.index') }}" class="text-decoration-none text-dark me-3">Mapel</a>
                    @auth
                        @if (Auth::user()->hasRole('siswa'))
                            <a href="{{ route('rapor.index') }}" class="text-decoration-none text-dark me-3">Rapor</a>
                        @else
                            <a href="{{ route('rapor_admin') }}" class="text-decoration-none text-dark me-3">Rapor</a>
                        @endif
                    @endauth
                </nav>
            </div>
            <div class="auth-buttons">
                @guest
                    <button class="login"><a href="{{ route('login') }}" style="color: black; text-decoration: none">Login</a></button>
                    <button class="signup"><a href="{{ route('register') }}" style="color: white; text-decoration: none">Sign Up</a></button>
                @endguest
                @auth
                    @if (Auth::user()->hasRole('siswa'))
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img class="profile-img rounded-circle" src="{{ Auth::user()->siswa->pas_foto ? asset(Auth::user()->siswa->pas_foto) : asset('images/profile-picture.png') }}" alt="Profile Picture" name="pas_foto" style="width:50px; height:50px; border-radius: 50%; object-fit: cover; cursor: pointer;">
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('account.settings') }}">Profile</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}" class="dropdown-item text-danger" style="hover:background-color red;">Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    @else
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="https://i.pinimg.com/564x/5f/40/6a/5f406ab25e8942cbe0da6485afd26b71.jpg" alt="Profile Picture" style="width:50px; height:50px; border-radius: 50%; object-fit: cover; cursor: pointer;">
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin') }}">Halaman Admin</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}" class="dropdown-item text-danger" style="hover:background-color red;">Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</header>
