@extends('admin.main')

@section('content')
<div class="container my-3">
    <div class="row">
        <div class="w-25 mb-3">
            <form action="{{ route('searching_angkatan') }}" method="GET">
                <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="number" class="form-control" placeholder="Cari Kelas..." name="search" value="{{ request('search') }}">
                </div>
            </form>
        </div>
        <div class="justify-content-center">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="text-center">Data Angkatan</h3>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAngkatanModal">
                        <i class="fa-solid fa-plus fa-lg"></i> Tambah Data
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Kelas</th>
                                    <th>Semester</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($angkatan as $a)
                                    <tr class="text-center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $a->class }}</td>
                                        <td>{{ $a->semester }}</td>                              
                                        <td class="d-flex gap-1 justify-content-center">
                                            <button class="btn btn-warning text-white btn-AngkatanEdit" data-id="{{ $a->id }}" data-toggle="modal" data-target="#editAngkatanModal"><i class="fa-regular fa-pen-to-square fa-lg"></i></button>
                                            <button class="btn btn-danger btn-AngkatanDelete" data-id="{{ $a->id }}"><i class="fa-regular fa-trash-can fa-lg"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex">
                            {{ $angkatan->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.partials.footer')
</div>

{{-- MODAL TAMBAH --}}
<div class="modal fade" id="addAngkatanModal" tabindex="-1" aria-labelledby="addAngkatanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="addAngkatanForm" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAngkatanModalLabel">Tambah Data Guru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="class" class="fw-bold">Kelas</label>
                        <select name="class" id="class" class="form-select @error('class') is-invalid @enderror" >
                            <option value="Pilih class" >Pilih kelas</option>
                            <option value="1" {{ old('class') == '1' ? 'selected' : '' }}>Kelas 1</option>
                            <option value="2" {{ old('class') == '2' ? 'selected' : '' }}>Kelas 2</option>
                            <option value="3" {{ old('class') == '3' ? 'selected' : '' }}>Kelas 3</option>
                        </select>
                        @error('class')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <input type="text" class="form-control @error('semester') is-invalid @enderror" id="semester" name="semester" value="{{ old('semester') }}" >
                        @error('semester')
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
<div class="modal fade" id="editAngkatanModal" tabindex="-1" aria-labelledby="editAngkatanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editAngkatanForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAngkatanModalLabel">Edit Data Angkatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editClass">Kelas</label>
                        <select class="form-select" id="editClass" name="class" >
                            <option value="Pilih kelas">Pilih kelas</option>
                            <option value="1">Kelas 1</option>
                            <option value="2">Kelas 2</option>
                            <option value="3">Kelas 3</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editSemester">Semester</label>
                        <input type="text" class="form-control" id="editSemester" name="semester" >
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