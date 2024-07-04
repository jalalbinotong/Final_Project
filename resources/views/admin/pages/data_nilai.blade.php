@extends('admin.main')

@section('content')
<div class="container my-3">
    <div class="row">
        <div class="w-25 mb-3">
            <form action="{{ route('searching_nilai') }}" method="GET">
                <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="Cari Nama Siswa..." name="search" value="{{ request('search') }}">
                </div>
            </form>
        </div>
        <div class="justify-content-center">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="text-center">Data Nilai</h3>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNilaiModal">
                        <i class="fa-solid fa-plus fa-lg"></i> Tambah Data
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Nama Mapel</th>
                                    <th>Tugas 1</th>
                                    <th>Tugas 2</th>
                                    <th>Tugas 3</th>
                                    <th>Ujian</th>
                                    <th>Kelas</th>
                                    <th>Semester</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nilai as $n)
                                    <tr class="text-center">
                                        <td class="text-wrap">{{ $loop->iteration }}</td>
                                        <td class="text-wrap">{{ $n->siswa->name }}</td>
                                        <td class="text-wrap">{{ $n->mapel->name }}</td>
                                        <td class="text-wrap">{{ $n->tugas1 }}</td>
                                        <td class="text-wrap">{{ $n->tugas2 }}</td>
                                        <td class="text-wrap">{{ $n->tugas3 }}</td>
                                        <td class="text-wrap">{{ $n->ujian }}</td>
                                        <td class="text-wrap">{{ $n->angkatan->class }}</td>
                                        <td class="text-wrap">{{ $n->angkatan->semester }}</td>
                                        <td class="d-flex gap-1 justify-content-center">
                                            <button class="btn btn-warning text-white btn-NilaiEdit" data-id="{{ $n->id }}" data-toggle="modal" data-target="#editNilaiModal"><i class="fa-regular fa-pen-to-square fa-lg"></i></button>
                                            <button class="btn btn-danger btn-NilaiDelete" data-id="{{ $n->id }}"><i class="fa-regular fa-trash-can fa-lg"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if (!isset($search))
                            <div class="d-flex">
                                {{ $nilai->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.partials.footer')
</div>

{{-- modal tambah --}}
<div class="modal fade" id="addNilaiModal" tabindex="-1" aria-labelledby="addNilaiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="addNilaiForm" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNilaiModalLabel">Tambah Data Nilai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="siswa_id">Nama Siswa</label>
                        <select class="form-select @error('siswa_id') is-invalid @enderror" id="siswa_id" name="siswa_id" required>
                            <option value="">Pilih siswa</option>
                            @foreach ($siswa as $s)
                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                            @endforeach
                            @error('siswa_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="mapel_id">Nama Mapel</label>
                        <select class="form-select @error('mapel_id') is-invalid @enderror" id="mapel_id" name="mapel_id" required>
                            <option value="">Pilih mapel</option>
                            @foreach ($mapel as $m)
                                <option value="{{ $m->id }}">{{ $m->name }}</option>
                            @endforeach
                            @error('mapel_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="angkatan_id">Kelas & Semester</label>
                        <select class="form-select @error('angkatan_id') is-invalid @enderror" id="angkatan_id" name="angkatan_id" required>
                            <option value="">Pilih angkatan</option>
                            @foreach ($angkatan as $a)
                                <option value="{{ $a->id }}">{{ $a->class }} - {{ $a->semester }}</option>
                            @endforeach
                            @error('angkatan_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tugas1">Tugas 1</label>
                        <input type="number" step="0.01" class="form-control @error('tugas1') is-invalid @enderror" id="tugas1" name="tugas1" required>
                        @error('tugas1')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tugas2">Tugas 2</label>
                        <input type="number" step="0.01" class="form-control @error('tugas2') is-invalid @enderror" id="tugas2" name="tugas2" required>
                        @error('tugas2')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tugas3">Tugas 3</label>
                        <input type="number" step="0.01" class="form-control @error('tugas3') is-invalid @enderror" id="tugas3" name="tugas3" required>
                        @error('tugas3')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="ujian">Ujian</label>
                        <input type="number" step="0.01" class="form-control @error('ujian') is-invalid @enderror" id="ujian" name="ujian" required>
                        @error('ujian')
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

{{-- modal ubah --}}
<div class="modal fade" id="editNilaiModal" tabindex="-1" aria-labelledby="editNilaiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editNilaiForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editNilaiModalLabel">Edit Data Angkatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editSiswaId">Siswa</label>
                        <select class="form-select" id="editSiswaId" name="siswa_id">
                            <option value="">Pilih siswa</option>
                            @foreach ($siswa as $s)
                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editMapelId">Mapel</label>
                        <select class="form-select" id="editMapelId" name="mapel_id">
                            <option value="">Pilih mapel</option>
                            @foreach ($mapel as $m)
                                <option value="{{ $m->id }}">{{ $m->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editAngkatanId">Kelas & Semester</label>
                        <select class="form-select" id="editAngkatanId" name="angkatan_id">
                            <option value="">Pilih kelas & semester</option>
                            @foreach ($angkatan as $a)
                                <option value="{{ $a->id }}">{{ $a->class }} - {{ $a->semester }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editTugas1">Tugas 1</label>
                        <input type="number" step="0.01" class="form-control" id="editTugas1" name="tugas1">
                    </div>
                    <div class="form-group">
                        <label for="editTugas2">Tugas 2</label>
                        <input type="number" step="0.01" class="form-control" id="editTugas2" name="tugas2">
                    </div>
                    <div class="form-group">
                        <label for="editTugas3">Tugas 3</label>
                        <input type="number" step="0.01" class="form-control" id="editTugas3" name="tugas3">
                    </div>
                    <div class="form-group">
                        <label for="editUjian">Ujian</label>
                        <input type="number" step="0.01" class="form-control" id="editUjian" name="ujian">
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