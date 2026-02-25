@extends('master')


@section('body')
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold">Data Santri</h2>
                    <h5 class="text-white op-7 mb-2">Pondok Pesantren Ma'hadul 'Ilmi Asy-Syar'ie</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-12">
                <div class="card full-height">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tabel-data" class="display table table-striped" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Nik</th>
                                        <th>Nisn</th>
                                        <th>Tempat Lahir</th>
                                        <th>Khos</th>
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
@endsection

@push('javascript')
    <script type="text/javascript">

        $(document).ready(function() {
            var table = $('#tabel-data').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('admin/dataSantri') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'nik',
                        name: 'nik'
                    },
                    {
                        data: 'nisn',
                        name: 'nisn'
                    },
                    {
                        data: 'tempat_lahir',
                        name: 'tempat_lahir'
                    },
                    {
                        data: 'khos',
                        name: 'khos'
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
                    },
                ]

            });

            $("#tabel-data").on("click", ".btn-hapus", function(e) {
                e.preventDefault();

                let santri_id = $(this).data("id");

                swal({
                    title: "Hapus data",
                    text: "Yakin hapus data ini?",
                    icon: "warning",
                    buttons: ["Batal", "Hapus"],
                    dangerMode: true,
                }).then((willDelete) => {

                    if (willDelete) {

                        $.ajax({
                            url: "/admin/" + santri_id,
                            type: "DELETE",
                            success: function(response) {
                                table.ajax.reload();
                                swal("Berhasil!", response.message, "success");
                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
                            }
                        });

                    }
                });
            });

        });
    </script>
@endpush
