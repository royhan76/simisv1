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

                        <!-- FILTER AREA -->
                        <div class="row mb-3">

                            <div class="col-md-8">

                                <button id="filter-lengkap" class="btn btn-success btn-sm">
                                    Data Lengkap
                                </button>

                                <button id="filter-belum" class="btn btn-danger btn-sm">
                                    Belum Lengkap
                                </button>

                                <a id="btn-export" class="btn btn-primary btn-sm ml-2 text-white">
                                    Export Excel
                                </a>
                                <select id="filter-tahun" class="form-control form-control-sm d-inline-block ml-2"
                                    style="width:150px;">

                                    <option value="">Tahun Masuk</option>

                                    @for ($i = date('Y'); $i >= 2005; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor

                                </select>

                            </div>

                        </div>

                        <div class="table-responsive">
                            <table id="tabel-data" class="display table table-striped table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Nik</th>
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

            var statusFilter = '';
            var tahunFilter = '';

            var table = $('#tabel-data').DataTable({

                processing: true,
                serverSide: true,

                ajax: {
                    url: "{{ url('admin/dataSantri') }}",
                    data: function(d) {

                        d.status = statusFilter;
                        d.tahun = tahunFilter;

                    }
                },

                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
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
                    }
                ]

            });


            // FILTER SEMUA
            $('#filter-semua').click(function() {

                statusFilter = '';
                tahunFilter = '';

                $('#filter-tahun').val('');

                table.ajax.reload();

            });


            // FILTER DATA LENGKAP
            $('#filter-lengkap').click(function() {

                statusFilter = 'lengkap';

                table.ajax.reload();

            });


            // FILTER DATA BELUM LENGKAP
            $('#filter-belum').click(function() {

                statusFilter = 'belum';

                table.ajax.reload();

            });


            // FILTER TAHUN MASUK
            $('#filter-tahun').change(function() {

                tahunFilter = $(this).val();

                table.ajax.reload();

            });


            // HAPUS DATA
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

            $('#btn-export').click(function(e) {

                e.preventDefault();

                let url = "{{ url('admin/exportSantri') }}";

                url += "?status=" + statusFilter + "&tahun=" + tahunFilter;

                window.location.href = url;

            });

        });
    </script>
@endpush
