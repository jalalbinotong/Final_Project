@extends('admin.main')

@section('content')
  <div class="container-fluid py-4">
    <div class="row">
      {{-- <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Money</p>
                  <h5 class="font-weight-bolder mb-0">
                    $53,000
                    <span class="text-success text-sm font-weight-bolder">+55%</span>
                  </h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                  <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> --}}
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Siswa</p>
                  <h5 class="font-weight-bolder mb-0">
                    {{ $jmlSiswa }}
                  </h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                  <i class="fa-solid fa-graduation-cap fa-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Guru</p>
                  <h5 class="font-weight-bolder mb-0">
                    {{ $jmlGuru }}
                  </h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                  <i class="fa-solid fa-chalkboard-user fa-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Mata Pelajaran</p>
                  <h5 class="font-weight-bolder mb-0">
                    {{ $jmlMapel }}
                    {{-- <span class="text-danger text-sm font-weight-bolder">-2%</span> --}}
                  </h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                  <i class="fa-solid fa-book-open-reader fa-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{-- <div class="col-xl-3 col-sm-6">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-capitalize font-weight-bold">Sales</p>
                  <h5 class="font-weight-bolder mb-0">
                    $103,430
                    <span class="text-success text-sm font-weight-bolder">+5%</span>
                  </h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                  <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> --}}
    <div class="row mt-4">
      <div class="col-lg-6 mb-lg-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-lg-6">
                <div class="d-flex flex-column h-100">
                  <h5 class="mb-1 pt-2 font-weight-bolder text-center">{{ $guru->name }}</h5>
                  <p class="text-bold text-center">{{ $guru->NIP }}</p>
                  <p class="mb-2">Email    : {{ $guru->email }}</p>
                  <p class="mb-2">Alamat   : {{ $guru->address }}</p>
                  <p class="mb-2">Phone    :  {{ $guru->phone }}</p>
                </div>
              </div>
              <div class="col-lg-5 ms-auto text-center mt-5 mt-lg-0">
                <div class="bg-gradient-primary border-radius-lg h-100">
                  <img src="https://i.pinimg.com/564x/5f/40/6a/5f406ab25e8942cbe0da6485afd26b71.jpg" class="position-relative h-100 w-100 top-0 " alt="waves">
                  {{-- <div class="position-relative d-flex align-items-center justify-content-center h-100">
                    <img class="w-100 position-relative z-index-2 pt-4" src="../assets/img/illustrations/rocket-white.png" alt="rocket">
                  </div> --}}
                </div>
              </div>
              <small class="text-muted text-center mt-4">Jika anda ingin mengubah profile, maka ubah di menu Data Guru!</small>
            </div>
          </div>
        </div>
      </div>
      {{-- <div class="col-lg-5">
        <div class="card h-100 p-3">
          <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100" style="background-image: url('../assets/img/ivancik.jpg');">
            <span class="mask bg-gradient-dark"></span>
            <div class="card-body position-relative z-index-1 d-flex flex-column h-100 p-3">
              <h5 class="text-white font-weight-bolder mb-4 pt-2">Work with the rockets</h5>
              <p class="text-white">Wealth creation is an evolutionarily recent positive-sum game. It is all about who take the opportunity first.</p>
              <a class="text-white text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="javascript:;">
                Read More
                <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
      </div> --}}
    </div>
    @include('../admin/partials/footer')
  </div>
@endsection
