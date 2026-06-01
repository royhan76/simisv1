@extends('master')

@section('body')
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold">Data Pengguna</h2>
                    <h5 class="text-white op-7 mb-2">Manajemen Akun Sistem</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-12">

                <div class="card full-height">
                    <div class="card-body">

                        <div class="row mb-3">

                            <div class="col-md-6">

                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambah">
                                    Tambah Pengguna
                                </button>

                            </div>

                        </div>

                        <div class="table-responsive">

                            <table id="tabel-user" class="display table table-striped table-hover" width="100%">

                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th class="text-center"><i class="icon-grid"></i></th>
                                    </tr>
                                </thead>

                            </table>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('admin.users.modal')
@endsection
@push('javascript')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {

            var table = $('#tabel-user').DataTable({

                processing: true,
                serverSide: true,

                ajax: "{{ url('admin/users') }}",

                columns: [

                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'username',
                        name: 'username'
                    },
                    {
                        data: 'role',
                        name: 'role'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }

                ]

            });


            $('#formTambah').submit(function(e) {

                e.preventDefault();

                $.ajax({

                    url: "{{ url('admin/users/store') }}",
                    type: "POST",
                    data: $(this).serialize(),

                    success: function(response) {

                        $('#modalTambah').modal('hide');

                        $('#formTambah')[0].reset();

                        $('#tabel-user').DataTable().ajax.reload();

                        swal("Berhasil!", response.message, "success");

                    },

                    error: function(xhr) {

                        console.log(xhr.responseText);

                    }

                });

            });

            $("#tabel-user").on("click", ".btn-edit", function() {

                let id = $(this).data("id");

                $.get("/admin/users/" + id + "/edit", function(data) {

                    $("#edit_id").val(data.id);
                    $("#edit_name").val(data.name);
                    $("#edit_username").val(data.username);
                    $("#edit_role").val(data.role);
                    $("#edit_status").val(data.status);

                    $("#modalEdit").modal("show");

                });

                $("#formEdit").submit(function(e) {

                    e.preventDefault();

                    $.ajax({

                        url: "/admin/users/update-user",
                        type: "POST",
                        data: $(this).serialize(),

                        success: function(response) {

                            $("#modalEdit").modal("hide");

                            $('#tabel-user').DataTable().ajax.reload();

                            swal("Berhasil!", response.message, "success");

                        }

                    });

                });



            });
            $("#tabel-user").on("click", ".btn-hapus", function(e) {

                e.preventDefault();

                let id = $(this).data("id");

                Swal.fire({
                    title: 'Hapus pengguna?',
                    text: "Data tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {

                    if (result.isConfirmed) {

                        $.ajax({

                            url: "/admin/users/" + id,
                            type: "DELETE",

                            success: function(response) {

                                $('#tabel-user').DataTable().ajax.reload();

                                Swal.fire(
                                    'Berhasil!',
                                    response.message,
                                    'success'
                                );

                            },

                            error: function(xhr) {
                                console.log(xhr.responseText);
                                Swal.fire('Error', 'Terjadi kesalahan',
                                    'error');
                            }

                        });

                    }

                });

            });



        });
    </script>
@endpush
