@extends('master')



@section('body')
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold">Form Pendaftaran Santri</h2>
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

                        <form action="{{ route('add_santri_baru') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4 mt-3">

                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">No. Induk</label>
                                        <input id="inputFloatingLabel2" id="no_induk" name="no_induk" type="text"
                                            class="form-control input-full" required="">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Nama Lengkap</label>
                                        <input id="inputFloatingLabel2" id="nama_lengkap" name="nama_lengkap" type="text"
                                            class="form-control input-full" required="">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Status Santri</label>
                                        <select class="status_santri form-control input-full required"
                                            name="status_santri"></select>
                                        <input type="hidden" class="form-control input-full" id="status_santri"
                                            name="status_santri" value="">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Khos</label>
                                        <input id="inputFloatingLabel2" id="khos" name="khos" type="text"
                                            class="form-control input-full" required="">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Kk</label>
                                        <input id="inputFloatingLabel2" id="kk" name="kk" type="text"
                                            class="form-control input-full" required="">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Nik</label>
                                        <input id="inputFloatingLabel2" id="nik" name="nik" type="text"
                                            class="form-control input-full" required="">
                                    </div>


                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Tempat lahir</label>
                                        <select class="tempat_lahir form-control input-full required"
                                            name="tempat_lahir"></select>
                                        <input type="hidden" class="form-control input-full" id="tempat_lahir"
                                            name="tempat_lahir" value="">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Tanggal Lahir</label>
                                        <input id="inputFloatingLabel2" id="tgl_lahir" name="tgl_lahir" type="date"
                                            class="form-control input-full" required="" placeholder="tanggal lahir">
                                    </div>

                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Nisn</label>
                                        <input id="inputFloatingLabel2" id="nisn" name="nisn" type="text"
                                            class="form-control input-full" required="">
                                    </div>
                                    {{-- pendidikan_id --}}

                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Pendidikan Terakhir</label>
                                        <select class="pendidikan_id form-control input-full required"
                                            name="pendidikan_id"></select>
                                        <input type="hidden" class="form-control input-full" id="pendidikan_id"
                                            name="pendidikan_id" value="">
                                    </div>

                                </div>
                                {{-- tengah --}}
                                <div class="col-md-4 mt-3">
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Provinsi</label>
                                        <select class="propinsi_id form-control input-full required" name="propinsi_id"
                                            style=" height: 62px;"></select>
                                        <input type="hidden" class="form-control input-full" id="propinsi_id"
                                            name="propinsi_id" value="">

                                    </div>
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Kabupaten</label>
                                        <select class="kabupaten_id form-control input-full required"
                                            name="kabupaten_id"></select>
                                        <input type="hidden" class="form-control input-full" id="kabupaten_id"
                                            name="kabupaten_id" value="">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Kecamatan</label>
                                        <select class="kecamatan_id form-control input-full required"
                                            name="kecamatan_id"></select>
                                        <input type="hidden" class="form-control input-full" id="kecamatan_id"
                                            name="kecamatan_id">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Kelurahan</label>
                                        <select class="kelurahan_id form-control input-full required"
                                            name="kelurahan_id"></select>
                                        <input type="hidden" class="form-control input-full" id="kelurahan_id"
                                            name="kelurahan_id">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Gang/Rt/Rw</label>
                                        <input id="inputFloatingLabel2" id="jalan" name="jalan" type="text"
                                            class="form-control input-full" required="">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Kode Pos</label>
                                        <input id="inputFloatingLabel2" id="kode_pos" name="kode_pos" type="text"
                                            class="form-control input-full" required="">
                                    </div>

                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Ayah</label>
                                        <input id="inputFloatingLabel2" id="ayah" name="ayah" type="text"
                                            class="form-control input-full" required="">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Nik Ayah</label>
                                        <input id="inputFloatingLabel2" id="nik_ayah" name="nik_ayah" type="text"
                                            class="form-control input-full" required="">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Pekerjaan Ayah</label>
                                        <input id="inputFloatingLabel2" id="pekerjaan_ayah" name="pekerjaan_ayah"
                                            type="text" class="form-control input-full" required="">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Tempat lahir ayah</label>
                                        <select class="tempat_lahir_ayah form-control input-full required"
                                            name="tempat_lahir_ayah"></select>
                                        <input type="hidden" class="form-control input-full" id="tempat_lahir_ayah"
                                            name="tempat_lahir_ayah" value="">
                                    </div>
                                </div>
                                {{-- kiri --}}
                                <div class="col-md-4 mt-3">
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Tanggal Lahir ayah</label>
                                        <input id="inputFloatingLabel2" id="tgl_lahir_ayah" name="tgl_lahir_ayah"
                                            type="date" class="form-control input-full" required=""
                                            placeholder="tanggal lahir">
                                    </div>
                                    {{-- pendidikan_id_ayah --}}
                                    <div class="form-group ">
                                        <select class="pendidikan_id_ayah form-control input-full "
                                            name="pendidikan_id_ayah"></select>
                                        <input type="hidden" class="form-control input-full" id="pendidikan_id_ayah"
                                            name="pendidikan_id_ayah" value="">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Ibu</label>
                                        <input id="inputFloatingLabel2" id="ibu" name="ibu" type="text"
                                            class="form-control input-full" required="">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Nik Ibu</label>
                                        <input id="inputFloatingLabel2" id="nik_ibu" name="nik_ibu" type="text"
                                            class="form-control input-full" required="">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Pekerjaan Ibu</label>
                                        <input id="inputFloatingLabel2" id="pekerjaan_ibu" name="pekerjaan_ibu"
                                            type="text" class="form-control input-full" required="">
                                    </div>

                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Tempat lahir ayah</label>
                                        <select class="tempat_lahir_ibu form-control input-full required"
                                            name="tempat_lahir_ibu"></select>
                                        <input type="hidden" class="form-control input-full" id="tempat_lahir_ibu"
                                            name="tempat_lahir_ibu" value="">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Tanggal Lahir Ibu</label>
                                        <input id="inputFloatingLabel2" id="tgl_lahir_ibu" name="tgl_lahir_ibu"
                                            type="date" class="form-control input-full" required=""
                                            placeholder="tanggal lahir">
                                    </div>
                                    {{-- pend_id_ibu --}}
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Pendidikan Ibu</label>
                                        <select class="pend_id_ibu form-control input-full " name="pend_id_ibu"></select>
                                        <input type="hidden" class="form-control input-full" id="pend_id_ibu"
                                            name="pend_id_ibu">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Photo</label><br>
                                        <input type="file" name="image" id="image" required>

                                    </div>

                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Simpanm</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    <script type="text/javascript">
        $('.propinsi_id').select2({
            width: '100%',
            placeholder: '-- Pilih Provinsi --',
            ajax: {
                url: '/provinsi',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: 30
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;
                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            }
        }).on('change', function() {
            var data = $(this).find('option:selected').text();
            // console.log(data);
            $('#propinsi_id').val(data);
            console.log($('#provinsi_id').val(data));

        });

        $('.kabupaten_id').select2({
            width: '100%',
            ajax: {
                url: '/kabupaten',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        provinsi_id: $('.propinsi_id').val(),
                        page: 30
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;

                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            placeholder: '-- Pilih Kota --',
            minimumInputLength: 0,

        }).on('change', function() {
            var data = $(this).find('option:selected').text();
            $('#kabupaten_id').val(data);
            console.log($('#kabupaten_id').val(data));
        });

        $('.kecamatan_id').select2({
            width: '100%',

            ajax: {
                url: '/kecamatan',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        kabupaten_id: $('.kabupaten_id').val(),
                        page: 30
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;

                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            placeholder: '-- Pilih Kecamatan --',
            minimumInputLength: 0,

        }).on('change', function() {
            var data = $(this).find('option:selected').text();
            $('#kecamatan_id').val(data);
            console.log($('#kecamatan_id').val(data));
        });
        // kelurahan
        $('.kelurahan_id').select2({
            width: '100%',
            ajax: {
                url: '/alamat',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        kecamatan_id: $('.kecamatan_id').val(),
                        page: 30
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;

                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            placeholder: '-- Pilih Kelurahan --',
            minimumInputLength: 0,

        }).on('change', function() {
            var data = $(this).find('option:selected').text();
            $('#kelurahan_id').val(data);
            console.log($('#kelurahan_id').val(data));
        });

        // pendidikan santri

        $('.pendidikan_id').select2({
            width: '100%',
            ajax: {
                url: '/pendidikan',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        pendidikan_id: $('.pendidikan_id').val(),
                        page: 30
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;

                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            placeholder: '-- Pendidikan Terakhir --',
            minimumInputLength: 0,

        }).on('change', function() {
            var data = $(this).find('option:selected').text();
            $('#pendidikan_id').val(data);
            console.log($('#pendidikan_id').val(data));
        });

        // pendidikan ayah

        $('.pendidikan_id_ayah').select2({
            width: '100%',

            ajax: {
                url: '/pendidikan',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        pendidikan_id_ayah: $('.pendidikan_id_ayah').val(),
                        page: 30
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;

                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            placeholder: '-- Pendidikan Terakhir Ayah--',
            minimumInputLength: 0,

        }).on('change', function() {
            var data = $(this).find('option:selected').text();
            $('#pendidikan_id_ayah').val(data);
            console.log($('#pendidikan_id_ayah').val(data));
        });

        // pendidikan_id_ibu

        $('.pend_id_ibu').select2({
            width: '100%',

            ajax: {
                url: '/pendidikan',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        pend_id_ibu: $('.pend_id_ibu').val(),
                        page: 30
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;

                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            placeholder: '-- Pendidikan Terakhir Ibu --',
            minimumInputLength: 0,

        }).on('change', function() {
            var data = $(this).find('option:selected').text();
            $('#pend_id_ibu').val(data);
            console.log($('#pend_id_ibu').val(data));
        });

        // Tempat lahir ayah

        $('.tempat_lahir_ayah').select2({
            width: '100%',
            ajax: {
                url: '/kabupaten',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        provinsi_id: $('.propinsi_id').val(),
                        page: 30
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;

                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            placeholder: '-- Pilih Tempat lahir ayah --',
            minimumInputLength: 0,

        }).on('change', function() {
            var data = $(this).find('option:selected').text();
            $('#tempat_lahir_ayah').val(data);
            console.log($('#tempat_lahir_ayah').val(data));
        });

        // Tempat lahir ibu

        $('.tempat_lahir_ibu').select2({
            width: '100%',
            ajax: {
                url: '/kabupaten',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        provinsi_id: $('.propinsi_id').val(),
                        page: 30
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;

                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            placeholder: '-- Pilih Tempat lahir ibu --',
            minimumInputLength: 0,

        }).on('change', function() {
            var data = $(this).find('option:selected').text();
            $('#tempat_lahir_ibu').val(data);
            console.log($('#tempat_lahir_ibu').val(data));
        });

        // tempat_lahir
        $('.tempat_lahir').select2({
            width: '100%',
            ajax: {
                url: '/kabupaten',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        provinsi_id: $('.propinsi_id').val(),
                        page: 30
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;

                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            placeholder: '-- Pilih Tempat lahir --',
            minimumInputLength: 0,

        }).on('change', function() {
            var data = $(this).find('option:selected').text();
            $('#tempat_lahir').val(data);
            console.log("test",$('#tempat_lahir').val(data));
        });
        // status santri

        $('.status_santri').select2({
            width: '100%',
            ajax: {
                url: '/status_santri',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        id: $('.id').val(),
                        page: 30
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;

                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            placeholder: '-- Status Santri --',
            minimumInputLength: 0,

        }).on('change', function() {
            var data = $(this).find('option:selected').text();
            $('#status_santri').val(data);
            console.log($('#status_santri').val(data));
        });
    </script>
@endpush
