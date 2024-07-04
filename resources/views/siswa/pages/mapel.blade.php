<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/mapel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landingpage.css') }}">

</head>
<body>
    @include('siswa.partials.navbar')
    <main class="main-container">
        <div class="container">
            <h1 class="mb-5">Selamat Datang Di E-Class! 👋</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 ">
                @foreach($mapels as $mapel)
                    <div class="mapel-card show-mapel hover" data-id="{{ $mapel->id }}" style="cursor: pointer; transition: transform 0.3s;">
                        <img src="{{ asset($mapel->image) }}" alt="{{ $mapel->name }}" class="img-fluid">
                        <div class="p-4">
                            <h3 class="text-xl">{{ $mapel->name }}</h3>
                            <p>{{ Str::limit($mapel->desc, 80) }}</p>
                            <div class="flex items-center mt-4">
                                <i class="fas fa-user-graduate text-gray-500"></i>
                                <span class="ml-2 text-gray-600">{{ $mapel->guru->name }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>

    <!-- Modal Show -->
    <div class="modal fade" id="mapelModal" tabindex="-1" aria-labelledby="mapelModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mapelModalLabel">Detail Mata Pelajaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg">
                            <img id="mapelImage" class="img-fluid mb-4" src="" alt="Gambar Mapel" style="width:auto; height:auto; object-fit: cover; cursor: pointer;">
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-sm-4">Judul</div>
                        <div class="col-sm-1">:</div>
                        <div class="col-sm-6">
                            <h5 id="mapelName"></h5>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-sm-4">Guru</div>
                        <div class="col-sm-1">:</div>
                        <div class="col-sm-6">
                            <h5 id="guruName" class="text-muted mb-3"></h5>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-sm-4">Deskripsi</div>
                        <div class="col-sm-1">:</div>
                        <div class="col-sm-6">
                            <p id="mapelDesc" class="text-break"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

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
    <script>
        $(document).ready(function() {
            $('.show-mapel').on('click', function() {
                var mapelId = $(this).data('id');

                $.ajax({
                    url: '/mapel-show/' + mapelId,
                    method: 'GET',
                    success: function(data) {
                        $('#mapelImage').attr('src', data.mapel.image);
                        $('#mapelName').text(data.mapel.name);
                        $('#guruName').text(data.guru.name);
                        $('#mapelDesc').text(data.mapel.desc);

                        $('#mapelModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script>
</body>
</html>
