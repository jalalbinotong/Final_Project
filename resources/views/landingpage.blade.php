<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-class LMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/landingpage.css') }}">
</head>
<body>
    @include('siswa.partials.navbar')

    <section class="hero">
        <div class="container">
            <div class="hero-text">
                <h1>Selamat Datang di E-class! 👋</h1>
                <p>E-class adalah platform Learning Management System (LMS) yang memudahkan proses belajar mengajar secara digital. Dirancang untuk institusi pendidikan E-class menawarkan berbagai fitur untuk pengalaman belajar yang optimal.</p>
                @auth
                  <button class="cta rounded"><a href="{{ route('mapel.index') }}" class="text-decoration-none text-white">Lihat Mapel</a></button>
                @else
                  <button class="cta rounded"><a href="{{ route('login') }}" class="text-decoration-none text-white">Mulai Sekarang</a></button>
                @endauth
            </div>
            <div class="hero-image">
                <img src="{{ asset('images/landing page 1.jpg') }}" alt="Hero Image">
            </div>
        </div>
    </section>

    <section class="feature">
        <div class="container">
            <div class="feature-item">
                <h2>Penilaian yang Mudah</h2>
                <p>Pengelolaan penilaian tidak pernah semudah ini Dengan fitur Penilaian yang terintegrasi dalam E-class, proses penilaian menjadi lebih mudah dan efisien bagi pendidik.</p>
                @auth
                  @if (Auth::user()->hasRole('siswa'))
                    <button class="cta rounded"><a href="{{ route('rapor.index') }}" class="text-decoration-none text-white">Lihat Rapor</a></button>
                  @else
                    <button class="cta rounded"><a href="{{ route('rapor_admin') }}" class="text-decoration-none text-white">Lihat Rapor</a></button>
                  @endif
                @else
                    <button class="cta rounded"><a href="{{ route('login') }}" class="text-decoration-none text-white">Mulai Sekarang</a></button>
                @endauth
            </div>
            <div class="feature-item">
                <img src="{{ asset('images/landing page 2.jpg') }}" alt="Hero Image">
                <h2>Informasi</h2>
                <p>E-class menyediakan berbagai informasi terkini mengenai proses belajar mengajar, perkembangan teknologi pendidikan, dan tips untuk memaksimalkan penggunaan LMS. Kami berkomitmen untuk selalu memberikan informasi yang berguna dan up-to-date bagi para pengguna kami.</p>
            </div>
        </div>
    </section>

    <footer id="footer" class="footer">

        <div class="footer-content">
          <div class="container">
            <div class="row">

              <div class="col-lg-3 col-md-6">
                <div class="footer-info">
                  <h3>E-class</h3>
                  <p>
                    Canggu,Bali,Indonesia <br>
                    80351<br><br>
                    <strong>Phone:</strong> +62 9872382902<br>
                    <strong>Email:</strong> eclass@gmail.com<br>
                  </p>
                </div>
              </div>

              <div class="col-lg-2 col-md-6 footer-links">
                <h4>Navigation</h4>
                <ul>
                  <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
                  <li><i class="bi bi-chevron-right"></i> <a href="{{ route('mapel.index') }}">Mapel</a></li>
                  <li><i class="bi bi-chevron-right"></i> <a href="{{ route('login') }}">Rapor</a></li>
                </ul>
              </div>
              <div class="copyright">
                &copy; Copyright <strong><span>E-class</span></strong>2024
              </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
