@extends('master')



@section('body')
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold">Form Pendaftaran Santri Baru</h2>
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
                                        <label for="inputFloatingLabel2" class="placeholder">KK</label>
                                        <input id="inputFloatingLabel2" id="kk" name="kk" type="text"
                                            class="form-control input-full" required="">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">NIK</label>
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
                                    {{-- pendidikan_id --}}
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Pendidikan Terakhir</label>
                                        <select class="pendidikan_id form-control input-full" name="pendidikan_id"></select>
                                        <input type="hidden" class="form-control input-full" id="pendidikan_id"
                                            name="pendidikan_id" value="">
                                    </div>
                                </div>
                                {{-- tengah --}}
                                <div class="col-md-4 mt-3">

                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Khos</label>
                                        <select class="khos form-control input-full required" name="khos"></select>
                                        <input type="hidden" class="form-control input-full" id="khos" name="khos"
                                            value="">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Status Santri</label>
                                        <select class="status_santri form-control input-full required"
                                            name="status_santri"></select>
                                        <input type="hidden" class="form-control input-full" id="status_santri"
                                            name="status_santri" value="">
                                    </div>

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
                                        <label for="inputFloatingLabel2" class="placeholder">Kelurahan/Desa</label>
                                        <select class="kelurahan_id form-control input-full required"
                                            name="kelurahan_id"></select>
                                        <input type="hidden" class="form-control input-full" id="kelurahan_id"
                                            name="kelurahan_id">
                                    </div>
                                </div>
                                {{-- kiri --}}
                                <div class="col-md-4 mt-3">

                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Gang/Rt/Rw</label>
                                        <input id="inputFloatingLabel2" id="jalan" name="jalan" type="text"
                                            class="form-control input-full">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Nama Wali</label>
                                        <input id="inputFloatingLabel2" id="ayah" name="ayah" type="text"
                                            class="form-control input-full" required="">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">No. Tlpn</label>
                                        <input id="inputFloatingLabel2" id="no_tlp" name="no_tlp" type="number"
                                            class="form-control input-full">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Tahun Masuk</label>
                                        <input id="inputFloatingLabel2" id="tahun_masuk" name="tahun_masuk"
                                            type="date" class="form-control input-full" placeholder="Tahun Masuk">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Tahun Keluar</label>
                                        <input id="inputFloatingLabel2" id="tahun_keluar" name="tahun_keluar"
                                            type="date" class="form-control input-full" placeholder="Tahun keluar">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Dokumen kk</label><br>
                                        <input type="file" name="dok_kk" id="dok_kk">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputFloatingLabel2" class="placeholder">Foto Profil</label><br>
                                        <input type="file" name="image" id="image">
                                    </div>

                                </div>
                            </div>

                            <!-- TABLE PEMBAYARAN SEMENTARA -->
                            <div class="card mt-4" id="tablePembayaranCard" style="display:none;">
                                <div class="card-body">
                                    <h5 class="mb-3"><b>Ringkasan Pembayaran</b></h5>

                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th width="5%">✔</th>
                                                    <th>Jenis Pembayaran</th>
                                                    <th class="text-right">Nominal</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tablePembayaranBody">
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="2" class="text-right">TOTAL</th>
                                                    <th class="text-right" id="grandTotal">Rp 0</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">

                                <!-- Kiri -->
                                <button type="submit" class="btn btn-success">
                                    Simpan
                                </button>

                                <!-- Kanan -->
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#modalPembayaran">
                                    Pembayaran
                                </button>

                            </div>
                        </form>

                        <!-- Modal Pembayaran -->
                        <div class="modal fade" id="modalPembayaran" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title">Detail Pembayaran Santri</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="row">

                                            <div class="col-md-6 mb-3">
                                                <label><b>Daftar Pondok</b></label>
                                                <input type="number" id="daftar_pondok" name="daftar_pondok"
                                                    class="form-control" value="100000">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label><b>Sarana & Prasarana</b></label>
                                                <input type="number" id="sarana_prasarana" name="sarana_prasarana"
                                                    class="form-control" value="150000">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label><b>Pengairan</b></label>
                                                <input type="number" id="pengairan" name="pengairan"
                                                    class="form-control" value="85000">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label><b>Kalender</b></label>
                                                <input type="number" id="kalender" name="kalender"
                                                    class="form-control" value="30000">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label><b>ROJABIYAH</b></label>
                                                <input type="number" id="rojabiyah" name="rojabiyah"
                                                    class="form-control" value="80000">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label><b>Syahriyah 3 Bulan</b></label>
                                                <input type="number" id="syahriyah" name="syahriyah_3bulan"
                                                    class="form-control" value="60000">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label><b>KTS</b></label>
                                                <input type="number" id="kts" name="kts" class="form-control"
                                                    value="10000">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label><b>Seragam</b></label>
                                                <input type="number" id="seragam" name="seragam" class="form-control"
                                                    value="100000">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label><b>Haul</b></label>
                                                <input type="number" id="haul" name="haul" class="form-control"
                                                    value="50000">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            Batal
                                        </button>
                                        <button type="button" class="btn btn-success" id="savePembayaran">
                                            Simpan
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
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

        $('.status_mukim').select2({
            width: '100%',
            ajax: {
                url: '/status_mukim',
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
            placeholder: '-- Status Mukim --',
            minimumInputLength: 0,

        }).on('change', function() {
            var data = $(this).find('option:selected').text();
            $('#status_mukim').val(data);
            console.log($('#status_mukim').val(data));
        });

        $('.khos').select2({
            width: '100%',
            ajax: {
                url: '/khos',
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
            placeholder: '-- Khos --',
            minimumInputLength: 0,

        }).on('change', function() {
            var data = $(this).find('option:selected').text();
            $('#khos').val(data);
            console.log($('#khos').val(data));
        });
    </script>

    <script>
        function formatRupiah(angka) {
    return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

$('#savePembayaran').click(function () {

    let dataPembayaran = [
        { nama: "Daftar Pondok", nilai: $('#daftar_pondok').val() },
        { nama: "Sarana & Prasarana", nilai: $('#sarana_prasarana').val() },
        { nama: "Pengairan", nilai: $('#pengairan').val() },
        { nama: "Kalender", nilai: $('#kalender').val() },
        { nama: "Rojabiyah/Akhirus Sanah", nilai: $('#rojabiyah').val() },
        { nama: "Syahriyah 3 Bulan", nilai: $('#syahriyah').val() },
        { nama: "KTS", nilai: $('#kts').val() },
        { nama: "Seragam", nilai: $('#seragam').val() },
        { nama: "Haul", nilai: $('#haul').val() }
    ];

    let total = 0;
    let html = "";

    dataPembayaran.forEach(function(item) {

        let nominal = parseInt(item.nilai) || 0;
        total += nominal;

        html += `
            <tr>
                <td><input type="checkbox" checked></td>
                <td>${item.nama}</td>
                <td class="text-right">${formatRupiah(nominal)}</td>
            </tr>
        `;
    });

    $('#tablePembayaranBody').html(html);
    $('#grandTotal').html(formatRupiah(total));
    $('#tablePembayaranCard').show();

    $('#modalPembayaran').modal('hide');
});
    </script>
@endpush
