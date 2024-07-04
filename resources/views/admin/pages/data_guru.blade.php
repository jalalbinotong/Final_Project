@extends('admin.main')

@section('content')
<div class="container my-3">
    <div class="row">
        <div class="w-25 mb-3">
            <form action="{{ route('searching_guru') }}" method="GET">
                <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="Cari Nama Guru..." name="search" value="{{ request('search') }}">
                </div>
            </form>
        </div>
        <div class="justify-content-center">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="text-center">Data Guru</h3>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addGuruModal">
                        <i class="fa-solid fa-user-plus fa-lg"></i> Tambah Data
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($guru as $g)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $g->NIP }}</td>
                                        <td>{{ $g->name }}</td>
                                        <td>{{ $g->email }}</td>
                                        <td class="text-wrap">{{ $g->address }}</td>                               
                                        <td class="d-flex gap-1 justify-content-center">
                                            <button class="btn btn-warning text-white btn-GuruEdit" data-id="{{ $g->id }}" data-toggle="modal" data-target="#editGuruModal"><i class="fa-regular fa-pen-to-square fa-lg"></i></button>
                                            <button class="btn btn-danger btn-GuruDelete" data-id="{{ $g->id }}"><i class="fa-regular fa-trash-can fa-lg"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex">
                            {{ $guru->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.partials.footer')
</div>

{{-- MODAL TAMBAH GURU --}}
<div class="modal fade" id="addGuruModal" tabindex="-1" aria-labelledby="addGuruModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('data-guru.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addGuruModalLabel">Tambah Data Guru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="NIP">NIP</label>
                        <input type="number" class="form-control @error('NIP') is-invalid @enderror" id="NIP" name="NIP" value="{{ old('NIP') }}" required>
                        @error('NIP')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" required>
                        @error('address')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="gender" class="fw-bold">Gender</label>
                        <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror" required>
                            <option value="Pilih gender" >Pilih gender</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                        @error('gender')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
                        @error('phone')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- MODAL UBAH --}}
<div class="modal fade" id="editGuruModal" tabindex="-1" aria-labelledby="editGuruModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editGuruForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSiswaModalLabel">Edit Data Guru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editNIP">NIP</label>
                        <input type="number" class="form-control" id="editNIP" name="NIP">
                    </div>
                    <div class="form-group">
                        <label for="editName">Nama</label>
                        <input type="text" class="form-control " id="editName" name="name">
                    </div>
                    <div class="form-group">
                        <label for="editEmail">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="email">
                    </div>
                    <div class="form-group">
                        <label for="editAddress">Alamat</label>
                        <input type="text" class="form-control" id="editAddress" name="address">
                    </div>
                    <div class="form-group">
                        <label for="editGender">Gender</label>
                        <select class="form-select" id="editGender" name="gender">
                            <option value="Pilih gender">Pilih gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editPhone">Phone</label>
                        <input type="text" class="form-control" id="editPhone" name="phone">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection