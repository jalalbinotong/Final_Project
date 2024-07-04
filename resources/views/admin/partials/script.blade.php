<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
<script src="../assets/js/plugins/chartjs.min.js"></script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->

{{-- data siswa --}}
<script>
    $(document).ready(function() {
        // Saat tombol edit diklik
        $('.btn-edit').on('click', function() {
            var id = $(this).data('id');
            // Mengisi form di modal edit
            $.ajax({
                url: '/data-siswa/' + id + '/edit',
                method: 'GET',
                success: function(data) {
                    $('#editNIS').val(data.NIS);
                    $('#editName').val(data.name);
                    $('#editEmail').val(data.email);
                    $('#editAddress').val(data.address);
                    $('#editAgama').val(data.agama);
                    $('#editGender').val(data.gender);
                    $('#editPhone').val(data.phone);
                    $('#editSiswaForm').attr('action', '/data-siswa/' + id);
                }
            });
        });
    
        // Menangani submit form edit
        $('#editSiswaForm').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var actionUrl = form.attr('action');
    
            $.ajax({
                url: actionUrl,
                method: 'POST',
                data: form.serialize(),
                success: function(response) {
                    // Menutup modal dan merefresh halaman
                    $('#editSiswaModal').modal('hide');
                    alert(response.success);
                    location.reload();
                },
                error: function(xhr) {
                    // Menangani error
                    console.log(xhr.responseText);
                }
            });
        });

        // menangani delete data
        $('.btn-delete').on('click', function() {
            var id = $(this).data('id');
            var url = '/data-siswa/' + id;

            if (confirm('Apakah Anda yakin ingin menghapus data siswa ini?')) {
                $.ajax({
                    url: url,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert(response.success);
                        location.reload();
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan saat menghapus data.');
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    });
</script>

{{-- data guru --}}
<script>
    $(document).ready(function () {
        // Saat tombol edit diklik
        $('.btn-GuruEdit').on('click', function() {
            var id = $(this).data('id');
            // Mengisi form di modal edit
            $.ajax({
                url: '/data-guru/' + id + '/edit',
                method: 'GET',
                success: function(data) {
                    $('#editNIP').val(data.NIP);
                    $('#editName').val(data.name);
                    $('#editEmail').val(data.email);
                    $('#editAddress').val(data.address);
                    $('#editGender').val(data.gender);
                    $('#editPhone').val(data.phone);
                    $('#editGuruForm').attr('action', '/data-guru/' + id);
                }
            });
        });

        // Menangani submit form edit
        $('#editGuruForm').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var actionUrl = form.attr('action');
    
            $.ajax({
                url: actionUrl,
                method: 'POST',
                data: form.serialize(),
                success: function(response) {
                    // Menutup modal dan merefresh halaman
                    $('#editGuruModal').modal('hide');
                    alert(response.success);
                    location.reload();
                },
                error: function(xhr) {
                    // Menangani error
                    console.log(xhr.responseText);
                }
            });
        });

        // menangani delete data
        $('.btn-GuruDelete').on('click', function() {
            var id = $(this).data('id');
            var url = '/data-guru/' + id;

            if (confirm('Apakah Anda yakin ingin menghapus data guru ini?')) {
                $.ajax({
                    url: url,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.success);
                            location.reload();
                        }
                    },
                    error: function(xhr) {
                        var response = xhr.responseJSON;
                        if (response && response.error) {
                            alert(response.error);
                        } else {
                            alert('Terjadi kesalahan saat menghapus data.');
                        }
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    })
</script>

{{-- data mapel --}}
<script>
    // tambah data
    $(document).ready(function() {
        $('#addMapelForm').on('submit', function(e) {
            e.preventDefault();
    
            var formData = new FormData(this);
    
            $.ajax({
                url: '{{ route("data-mapel.store") }}',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#addMapelModal').modal('hide');
                    alert(response.success);
                    location.reload();
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });

        $('.btn-MapelEdit').on('click', function() {
            var id = $(this).data('id');
            // Mengisi form di modal edit
            $.ajax({
                url: '/data-mapel/' + id + '/edit',
                method: 'GET',
                success: function(data) {
                    $('#editMapelId').val(data.id);
                    $('#editGuruId').val(data.guru_id);
                    $('#editMapelName').val(data.name);
                    $('#editDesc').val(data.desc);
                    $('#editMapelImage').val(null); // Clear the file input
                    $('#editMapelForm').attr('action', '/data-mapel/' + id);
                }
            });
        });

        // Menangani submit form edit
        $('#editMapelForm').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var actionUrl = form.attr('action');

            var formData = new FormData(this);

            $.ajax({
                url: actionUrl,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Menutup modal dan merefresh halaman
                    $('#editMapelModal').modal('hide');
                    alert(response.success);
                    location.reload();
                },
                error: function(xhr) {
                    // Menangani error
                    console.log(xhr.responseText);
                }
            });
        });
    
        // Hapus data mapel
        $('.btn-MapelDelete').on('click', function() {
            var id = $(this).data('id');
            var url = '/data-mapel/' + id;

            if (confirm('Apakah Anda yakin ingin menghapus data mapel ini?')) {
                $.ajax({
                    url: url,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert(response.success);
                        location.reload();
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan saat menghapus data.');
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    });
</script>

{{-- data angkatan --}}
<script>
    $(document).ready(function() {
        // tambah data
        $('#addAngkatanForm').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var actionUrl = form.attr('action');

            $.ajax({
                url: '/data-angkatan',
                method: 'POST',
                data: form.serialize(),
                success: function(response) {
                    $('#addAngkatanModal').modal('hide');
                    alert(response.success);
                    location.reload();
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    alert('Terjadi kesalahan, silakan coba lagi.');
                }
            });
        });

        // edit data
        $('.btn-AngkatanEdit').on('click', function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/data-angkatan/' + id + '/edit',
                method: 'GET',
                success: function(data) {
                    $('#editClass').val(data.class);
                    $('#editSemester').val(data.semester);
                    $('#editAngkatanForm').attr('action', '/data-angkatan/' + id);
                }
            });
        });

        // Menangani submit form edit
        $('#editAngkatanForm').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var actionUrl = form.attr('action');
    
            $.ajax({
                url: actionUrl,
                method: 'POST',
                data: form.serialize(),
                success: function(response) {
                    // Menutup modal dan merefresh halaman
                    $('#editAngkatanModal').modal('hide');
                    alert(response.success);
                    location.reload();
                },
                error: function(xhr) {
                    // Menangani error
                    console.log(xhr.responseText);
                }
            });
        });

        // delete data
        $('.btn-AngkatanDelete').on('click', function() {
            var id = $(this).data('id');
            var url = '/data-angkatan/' + id;

            if (confirm('Apakah Anda yakin ingin menghapus data angkatan ini?')) {
                $.ajax({
                    url: url,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert(response.success);
                        location.reload();
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan saat menghapus data.');
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    });
</script>

{{-- data nilai --}}
<script>
    $(document).ready(function() {
        // tambah data
        $('#addNilaiForm').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var actionUrl = form.attr('action');

            $.ajax({
                url: '/data-nilai',
                method: 'POST',
                data: form.serialize(),
                success: function(response) {
                    $('#addNilaiModal').modal('hide');
                    alert(response.success);
                    location.reload();
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    // Menampilkan pesan error
                    alert('Terjadi kesalahan, silakan coba lagi.');
                }
            });
        });

        // Saat tombol edit diklik
        $('.btn-NilaiEdit').on('click', function() {
            var id = $(this).data('id');
            // Mengisi form di modal edit
            $.ajax({
                url: '/data-nilai/' + id + '/edit',
                method: 'GET',
                success: function(data) {
                    $('#editSiswaId').val(data.siswa_id);
                    $('#editMapelId').val(data.mapel_id);
                    $('#editAngkatanId').val(data.angkatan_id);
                    $('#editTugas1').val(data.tugas1);
                    $('#editTugas2').val(data.tugas2);
                    $('#editTugas3').val(data.tugas3);
                    $('#editUjian').val(data.ujian);
                    $('#editNilaiForm').attr('action', '/data-nilai/' + id);
                }
            });
        });

        // Menangani submit form edit
        $('#editNilaiForm').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var actionUrl = form.attr('action');
    
            $.ajax({
                url: actionUrl,
                method: 'POST',
                data: form.serialize(),
                success: function(response) {
                    // Menutup modal dan merefresh halaman
                    $('#editNilaiModal').modal('hide');
                    alert(response.success);
                    location.reload();
                },
                error: function(xhr) {
                    // Menangani error
                    console.log(xhr.responseText);
                }
            });
        });

        // menangani delete data
        $('.btn-NilaiDelete').on('click', function() {
            var id = $(this).data('id');
            var url = '/data-nilai/' + id;

            if (confirm('Apakah Anda yakin ingin menghapus data nilai ini?')) {
                $.ajax({
                    url: url,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert(response.success);
                        location.reload();
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan saat menghapus data.');
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    });

</script>