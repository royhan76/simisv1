@extends('master')

@php

    $tanggal_lahir = str_replace('00:00:00', '', $santri->tgl_lahir);
    $photo = str_replace("public", "", $foto->path);
@endphp



@section('body')
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold">Edit Data Santri</h2>
                    <h5 class="text-white op-7 mb-3">
                        Pondok Pesantren Ma'hadul 'Ilmi Asy-Syar'ie (MIS)


                    </h5>
                </div>
            </div>
        </div>
    </div>
    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-12">
                <div class="card full-height">
                    <div class="card-body">

                        <form action="{{ url('/admin/update/'. $santri->santri_id) }}" method="POST" id="form_edit" class="form_edit"  enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-4 mt-3">

                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">No. Induk</label>
                                        <input id="inputFloatingLabel2" id="no_induk" name="no_induk" type="text"
                                            class="form-control input-full" readonly="readonly" required=""
                                            value="{{ $santri->santri_id }}">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Nama Lengkap</label>
                                        <input id="inputFloatingLabel2" id="nama_lengkap" name="nama_lengkap" type="text"
                                            class="form-control input-full" required="" value="{{ $santri->nama }}">
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
                                            class="form-control input-full" required="" value="{{ $santri->khos }}">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Kk</label>
                                        <input id="inputFloatingLabel2" id="kk" name="kk" type="text"
                                            class="form-control input-full" required="" value="{{ $santri->kk }}">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Nik</label>
                                        <input id="inputFloatingLabel2" id="nik" name="nik" type="text"
                                            class="form-control input-full" required="" value="{{ $santri->nik }}">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Tempat Lahir</label>
                                        <select class="tempat_lahir form-control input-full required"
                                            name="tempat_lahir"></select>
                                        <input type="hidden" class="form-control input-full" id="tempat_lahir"
                                            name="tempat_lahir" value="">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Tanggal Lahir</label>
                                        <input type="text" id="tgl_lahir" name="tgl_lahir"
                                            class="form-control required input-full tanggal" placeholder="Tanggal Lahir"
                                            value="{{ date('Y-m-d', strtotime($santri->tgl_lahir)) }}" onchange="#">
                                    </div>

                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Nisn</label>
                                        <input id="inputFloatingLabel2" id="nisn" name="nisn" type="text"
                                            class="form-control input-full" required="" value="{{$santri->nisn}}">
                                    </div>
                                    {{-- pendidikan_id --}}

                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Pendidikan Terakhir</label>
                                        <select class="pendidikan_id form-control input-full required"
                                            name="pendidikan_id"></select>
                                        <input type="hidden" class="form-control input-full" id="pendidikan_id"
                                            name="pendidikan_id" value="{{ $santri->pend_terakhir }}">
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
                                            class="form-control input-full" required="" value="{{$santri->jalan}}">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Kode Pos</label>
                                        <input id="inputFloatingLabel2" id="kode_pos" name="kode_pos" type="text"
                                            class="form-control input-full" required="" value="{{$santri->kodepos}}">
                                    </div>

                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Ayah</label>
                                        <input id="inputFloatingLabel2" id="ayah" name="ayah" type="text"
                                            class="form-control input-full" required="" value="{{$wali->ayah}}">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Nik Ayah</label>
                                        <input id="inputFloatingLabel2" id="nik_ayah" name="nik_ayah" type="text"
                                            class="form-control input-full" required="" value="{{$wali->ayah_nik}}">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Pekerjaan Ayah</label>
                                        <input id="inputFloatingLabel2" id="pekerjaan_ayah" name="pekerjaan_ayah"
                                            type="text" class="form-control input-full" required="" value="{{$wali->pekerjaan_ayah}}">
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
                                            type="text" class="form-control input-full tanggal" required=""
                                            placeholder="tanggal lahir"  value="{{ date('Y-m-d', strtotime($wali->tgl_lahir_ayah)) }}">
                                    </div>
                                    {{-- pendidikan_id_ayah --}}
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Pendidikan Terakhir ayah</label>
                                        <select class="pendidikan_id_ayah form-control input-full "
                                            name="pendidikan_id_ayah"></select>
                                        <input type="hidden" class="form-control input-full" id="pendidikan_id_ayah"
                                            name="pendidikan_id_ayah" >
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Ibu</label>
                                        <input id="inputFloatingLabel2" id="ibu" name="ibu" type="text"
                                            class="form-control input-full" required="" value="{{$wali->ibu}}">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Nik Ibu</label>
                                        <input id="inputFloatingLabel2" id="nik_ibu" name="nik_ibu" type="text"
                                            class="form-control input-full" required="" value="{{$wali->nik_ibu}}">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Pekerjaan Ibu</label>
                                        <input id="inputFloatingLabel2" id="pekerjaan_ibu" name="pekerjaan_ibu"
                                            type="text" class="form-control input-full" required="" value="{{$wali->pekerjaan_ibu}}">
                                    </div>

                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Tempat lahir ibu</label>
                                        <select class="tempat_lahir_ibu form-control input-full required"
                                            name="tempat_lahir_ibu"></select>
                                        <input type="hidden" class="form-control input-full" id="tempat_lahir_ibu"
                                            name="tempat_lahir_ibu" >
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Tanggal Lahir Ibu</label>
                                        <input id="inputFloatingLabel2" id="tgl_lahir_ibu" name="tgl_lahir_ibu"
                                            type="text" class="form-control input-full tanggal" required=""
                                            placeholder="tanggal lahir"  value="{{ date('Y-m-d', strtotime($wali->tgl_lahir_ibu)) }}">
                                    </div>
                                    {{-- pend_id_ibu --}}
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Pendidikan Terakhir Ibu</label>
                                        <select class="pend_id_ibu form-control input-full " name="pend_id_ibu"></select>
                                        <input type="hidden" class="form-control input-full" id="pend_id_ibu"
                                            name="pend_id_ibu">
                                    </div>

                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Photo</label><br>
                                        <input type="file" name="photo">

                                        {{-- <div class="my-2">
                                            <input type="file" name="image" id="image" accept="image/*" class="form-control @error('file') is-invalid @enderror">
                                            <input type="text" name="hidden_image" id="hidden_image" value="{{$foto->path}}">
                                            @error('file')
                                              <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                          </div> --}}
                                    </div>
                                    <div class="form-group">
                                        <div class="avatar avatar-xxl">
                                            {{-- {{$foto->path}} --}}
                                            {{-- <img  class="avatar-img rounded-circle"> --}}
                                            <img src="{{ asset('storage/images/'.$photo) }}" alt="..." class="avatar-img rounded-circle">
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-inline">
                                        <div class="btn-group" style="margin-top: 20px;">
                                            <a id="btn-batal" href="{{url('admin')}}"
                                                class="btn btn-lg btn-primary">Batal</a>
                                            <button id="btn-simpan" type="submit"
                                                class="btn btn-lg btn-success">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <button type="submit" class="btn btn-success">Simpan</button> --}}
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection


@push('javascript')
    <script type="text/javascript">
        $(document).ready(function() {

            $('.propinsi_id').append('<option value="{{ $santri->provinsi }}" title="{{ $santri->provinsi }}">{{ $santri->provinsi }}</option>');
            $('.kabupaten_id').append('<option value="{{ $santri->kabupaten }}" title="{{ $santri->kabupaten }}">{{ $santri->kabupaten }}</option>');
            $('.kecamatan_id').append('<option value="{{ $santri->kecamatan }}" title="{{ $santri->kecamatan }}">{{ $santri->kecamatan }}</option>');
            $('.kelurahan_id').append('<option value="{{ $santri->kelurahan }}" title="{{ $santri->kelurahan }}">{{ $santri->kelurahan }}</option>');
            $('.status_santri').append('<option value="{{ $santri->status }}" title="{{ $santri->status }}">{{ $santri->status }}</option>');
            $('.tempat_lahir').append('<option value="{{ $santri->tempat_lahir }}" title="{{ $santri->tempat_lahir }}">{{ $santri->tempat_lahir }}</option>');
            $('.pendidikan_id').append('<option value="{{ $santri->pend_terakhir }}" title="{{ $santri->pend_terakhir }}">{{ $santri->pend_terakhir }}</option>');
            $('.pendidikan_id_ayah').append('<option value="{{ $wali->	pend_terakhir_id_ayah }}" title="{{ $wali->	pend_terakhir_id_ayah }}">{{ $wali->	pend_terakhir_id_ayah }}</option>');
            $('.pend_id_ibu').append('<option value="{{ $wali->pend_terakhir_id_ibu }}" title="{{ $wali->pend_terakhir_id_ibu }}">{{ $wali->pend_terakhir_id_ibu }}</option>');
            $('.tempat_lahir_ayah').append('<option value="{{ $wali->tempat_lahir_ayah }}" title="{{ $wali->tempat_lahir_ayah }}">{{ $wali->tempat_lahir_ayah }}</option>');
            $('.tempat_lahir_ibu').append('<option value="{{ $wali->tempat_lahir_ibu }}" title="{{ $wali->tempat_lahir_ibu }}">{{ $wali->tempat_lahir_ibu }}</option>');

            $('.status_santri').val("{{ $santri->status }}").trigger('change');
            $('.tempat_lahir').val("{{ $santri->tempat_lahir }}").trigger('change');
            $('.pendidikan_id').val("{{ $santri->pend_terakhir }}").trigger('change');
            $('.tempat_lahir').val("{{ $santri->tempat_lahir }}").trigger('change');
            $('.propinsi_id').val("{{ $santri->provinsi }}").trigger('change');
            $('.kabupaten_id').val("{{ $santri->kabupaten }}").trigger('change');
            $('.kecamatan_id').val("{{ $santri->kecamatan }}").trigger('change');
            $('.kelurahan_id').val("{{ $santri->kelurahan }}").trigger('change');
            $('.pendidikan_id_ayah').val("{{ $wali->pend_terakhir_id_ayah }}").trigger('change');
            $('.pend_id_ibu').val("{{ $wali->pend_terakhir_id_ibu }}").trigger('change');
            $('.tempat_lahir_ayah').val("{{ $wali->tempat_lahir_ayah }}").trigger('change');
            $('.tempat_lahir_ibu').val("{{ $wali->tempat_lahir_ibu }}").trigger('change');
        });
        $('.tanggal').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true

        });
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
            console.log(data);
            $('#propinsi_id').val(data);
            console.log($('#propinsi_id').val(data));

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
            $('#propinsi_nama').val(data);
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
                url: '/kabupatenLahir',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        // q: params.term, // search term
                        // provinsi_id: $('.propinsi_id').val(),
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
                url: '/kabupatenLahir',
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
                url: '/kabupatenLahir',
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
            console.log("test", $('#tempat_lahir').val(data));
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

    //     $('#btn-simpan').on('click', function () {
    //     if (validate()) {
    //         swal({
    //             title: "Simpan data pasien?",
    //             type: "info",
    //             icon: "info",
    //             showCancelButton: true,
    //             showLoaderOnConfirm: true,
    //             buttons: {
    //                 cancel: {
    //                     visible: true,
    //                     text: 'Tidak',
    //                     className: 'btn btn-warning'
    //                 },
    //                 confirm: {
    //                     text: 'Simpan',
    //                     className: 'btn btn-success'
    //                 }
    //             }
    //         }).then((Confirm) => {
    //             if (Confirm) {
    //                 var dataForm = $("#form_edit").serialize();
    //                 $.ajax({
    //                     headers: {
    //                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //                     },
    //                     url: "{{ url('/admin/santri/update/'. $santri->santri_id) }}",
    //                     type: "POST",
    //                     data: dataForm,
    //                     success: function(res) {
    //                         location.replace("{{url('admin/santri')}}");
    //                     },
    //                     error: function(res) {
    //                         var errors = JSON.parse(res.responseText);
    //                         var messageError = '';
    //                         $.each(errors.errors, function(idx, val) {
    //                             messageError += val[0] + '. ';
    //                         });
    //                         swal({
    //                             title: errors.message,
    //                             text: messageError,
    //                             type: "error",
    //                             icon: "error",
    //                         })
    //                     }
    //                 });
    //             } else {
    //                 $('#overlay').hide();
    //                 swal.close();
    //             }
    //         });
    //     } else {
    //         swal({
    //             title: "Pastikan semua data telah terisi dengan baik",
    //             type: "error",
    //             icon: "error",
    //         })
    //     }
    // });

    // function validate() {
    //     var validated = true;
    //     $('.required').each(function (i, el) {
    //         var data = $(el).val();
    //         var len = data.length;
    //         if (len<1) {
    //             validated = false;
    //         }
    //     });

    //     return validated;
    // }



    </script>
@endpush
