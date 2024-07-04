<!DOCTYPE html>
<html>
<head>
    <title>All Raport</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/rapor.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landingpage.css') }}">
</head>
<body>
    @include('siswa.partials.navbar')
    <section class="container">
        <div class="content">
            <p class="mb-4 fs-4">Halo admin, berikut adalah nilai semua siswa</p>
            <div class="row">
                <div class="col-md-3">
                    <form action="{{ route('rapor_searching') }}" method="GET">
                        <div class="input-group">
                            <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" placeholder="Cari Nama Siswa..." name="search" value="{{ request('search') }}">
                        </div>
                    </form>
                </div>
            </div>
            @if (!empty($angkatanNilais))
                @forelse($angkatanNilais as $angkatanNilai)
                    <div class="d-flex justify-content-between align-content-center">
                        <p class="mt-4 fs-5">Kelas {{ $angkatanNilai['angkatan']->class }} - <strong>Semester {{ $angkatanNilai['angkatan']->semester }}</strong></p>
                        <p class="mt-4 fs-5">Nama Siswa: <strong>{{ $angkatanNilai['siswa']->name }}</strong></p>
                    </div>
                    <div class="table-container">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>Mata Pelajaran</th>
                                    <th>Tugas 1</th>
                                    <th>Tugas 2</th>
                                    <th>Tugas 3</th>
                                    <th>Ujian</th>
                                    <th>Rata-rata</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($angkatanNilai['nilais'] as $nilai)
                                    <tr>
                                        <td>{{ $nilai->mapel->name }}</td>
                                        <td class="text-end">{{ $nilai->tugas1 }}</td>
                                        <td class="text-end">{{ $nilai->tugas2 }}</td>
                                        <td class="text-end">{{ $nilai->tugas3 }}</td>
                                        <td class="text-end">{{ $nilai->ujian }}</td>
                                        <td class="text-end">{{ number_format($nilai->average, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        <strong>Nilai Rata-rata Keseluruhan: {{ number_format($angkatanNilai['overallAverage'], 2) }}</strong>
                        <h4>Status:
                            <button class="btn {{ $angkatanNilai['status'] == 'Lulus' ? 'btn-success' : 'btn-danger' }}">
                                {{ $angkatanNilai['status'] }}
                            </button>
                        </h4>
                    </div>
                @empty
                    <strong class="text-secondary text-center align-items-center mt-4 mb-5">Belum Ada Data Nilai Siswa</strong>
                @endforelse
            @else
                <strong class="text-secondary text-center align-items-center mt-4 mb-5">Tidak Ada Hasil yang Ditemukan!</strong>
            @endif
            <div class="d-flex">
                {{ $angkatans->links() }}
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
