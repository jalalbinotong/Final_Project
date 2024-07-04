<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}

    <link rel="stylesheet" href="{{ asset('css/account-settings.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landingpage.css') }}">
</head>
<body>
    @include('siswa.partials.navbar')
    <div class="container mt-5">
        <div class="account-settings">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <h2 class="text-center mb-4">Pengaturan Akun</h2>
            <form action="{{ route('siswa_update') }}"  method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-4 profile-photo">
                        <img class="profile-img rounded-circle" src="{{ $siswa->pas_foto ? asset($siswa->pas_foto) : asset('images/profile-picture.png') }}" alt="Profile Picture" id="profileImg" name="pas_foto" style="width:250px; height:250px; border-radius: 50%; object-fit: cover; cursor: pointer;">
                        <input type="file" class="form-control mt-2 @error('pas_foto') is-invalid @enderror" name="pas_foto" id="profileImageUpload" accept="image/*" style="display: none;">
                        @error('pas_foto')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <small class="form-text text-muted">Jika anda ingin ganti foto profile, ukuran gambar harus di bawah 2MB </small>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $siswa->name }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="NIS">NIS</label>
                                <input type="text" class="form-control" id="NIS" name="NIS" value="{{ $siswa->NIS }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $siswa->email }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-text text-muted">Ubah, jika anda ingin mengubah</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone">No Telp</label>
                                <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ $siswa->phone }}">
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-text text-muted">Ubah, jika anda ingin mengubah</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="gender">Jenis Kelamin</label>
                                <select class="form-control" id="gender" name="gender" disabled>
                                    <option value="male" {{ ($siswa->gender) == 'male' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="female" {{ ($siswa->gender) == 'female' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="agama">Agama</label>
                                <input type="text" class="form-control" id="agama" name="agama" value="{{ $siswa->agama }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="address">Alamat</label>
                                <textarea name="address" id="address" cols="30" rows="2" readonly>{{ $siswa->address }}</textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <script>
        $(document).ready(function() {
            $('#profileImg').click(function() {
                $('#profileImageUpload').click();
            });

            $('#profileImageUpload').change(function(event) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#profileImg').attr('src', e.target.result);
                }
                reader.readAsDataURL(event.target.files[0]);
            });
        });
    </script>
</body>
</html>
