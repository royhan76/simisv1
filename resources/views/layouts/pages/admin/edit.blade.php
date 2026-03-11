@extends('master')

@php
    use Carbon\Carbon;

    $tanggal_lahir = $santri->tgl_lahir ? Carbon::parse($santri->tgl_lahir)->format('Y-m-d') : '';

    $tahunMasuk = $thn_masuk?->thn_masuk ? Carbon::parse($thn_masuk->thn_masuk)->format('Y-m-d') : '';

    $tahunKeluar = $thn_keluar?->thn_keluar ? Carbon::parse($thn_keluar->thn_keluar)->format('Y-m-d') : '';

    $photo = $foto?->path ?? null;
    $dokKkPath = $dok_kk?->path ?? null;
    $selectedJenisKelamin = old(
        'jenis_kelamin',
        $santri->kelamin ?? ($santri->jenis_kelamin ?? ($santri->j_kelamin ?? 'Laki-laki')),
    );
@endphp

@section('body')
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold">Form Update Data Santri</h2>
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

                        <form action="{{ url('/admin/update/' . $santri->santri_id) }}" method="POST"
                            enctype="multipart/form-data">

                            @csrf
                            @method('PUT')

                            <ul class="nav nav-pills nav-secondary nav-pills-no-bd" id="pills-tab-without-border"
                                role="tablist">
                                <li class="nav-item submenu">
                                    <a class="nav-link active show" id="tab-santri" data-toggle="pill" href="#data_santri"
                                        role="tab" aria-controls="pills-datasantri-nobd" aria-selected="true"> DATA
                                        SANTRI</a>
                                </li>
                                <li class="nav-item submenu">
                                    <a class="nav-link" id="tab-ortu" data-toggle="pill" href="#data_ortu" role="tab"
                                        aria-controls="pills-dataortu-nobd" aria-selected="false">DATA ORANG TUA</a>
                                </li>
                                <li class="nav-item submenu">
                                    <a class="nav-link " id="tab-alamat" data-toggle="pill" href="#data_alamat"
                                        role="tab" aria-controls="pills-alamat-nobd" aria-selected="false">DATA
                                        ALAMAT</a>
                                </li>
                            </ul>

                            <div class="tab-content mt-3">

                                {{-- TAB 1 DATA SANTRI --}}
                                <div class="tab-pane fade show active" id="data_santri" role="tabpanel">

                                    <div class="row">
                                        <div class="col-md-4 mt-3">

                                            <div class="form-group">
                                                <label class="placeholder">No. Induk</label>
                                                <input id="no_induk" name="no_induk" type="text"
                                                    class="form-control input-full" value="{{ $santri->no_induk }}" readonly
                                                    required>
                                            </div>
                                            <div class="form-group ">
                                                <label for="inputFloatingLabel2" class="placeholder">Nama Lengkap</label>
                                                <input id="inputFloatingLabel2" id="nama_lengkap" name="nama_lengkap"
                                                    type="text" class="form-control input-full"
                                                    value="{{ $santri->nama }}" required="">
                                            </div>
                                            <div class="form-group ">
                                                <label for="inputFloatingLabel2" class="placeholder">KK</label>
                                                <input id="inputFloatingLabel2" id="kk" name="kk" type="text"
                                                    class="form-control input-full" value="{{ $santri->kk }}">
                                            </div>
                                            <div class="form-group ">
                                                <label for="inputFloatingLabel2" class="placeholder">NIK</label>
                                                <input id="inputFloatingLabel2" id="nik" name="nik" type="text"
                                                    class="form-control input-full" value="{{ $santri->nik }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Tempat Lahir</label>
                                                <select name="tempat_lahir" class="form-control tempat_lahir"></select>
                                            </div>
                                            <div class="form-group ">
                                                <label for="inputFloatingLabel2" class="placeholder">Tanggal Lahir</label>
                                                <input id="inputFloatingLabel2" id="tgl_lahir" name="tgl_lahir"
                                                    type="date" class="form-control input-full" required=""
                                                    placeholder="tanggal lahir" value="{{ $tanggal_lahir }}">
                                            </div>
                                            {{-- pendidikan_id --}}
                                            <div class="form-group">
                                                <label>Pendidikan Terakhir</label>
                                                <select name="pendidikan_id" class="form-control pendidikan_id"></select>
                                            </div>
                                            <div class="form-group">
                                                <label>Khos</label>
                                                <select name="khos" class="form-control khos"></select>
                                            </div>

                                            <div class="form-group">
                                                <label>Status Santri</label>
                                                <select name="status_santri" class="form-control status_santri"></select>
                                            </div>
                                        </div>
                                        {{-- tengah --}}
                                        <div class="col-md-4 mt-3">
                                            <div class="form-group ">
                                                <label for="inputFloatingLabel2" class="placeholder">Provinsi</label>
                                                <select class="propinsi_id form-control input-full required"
                                                    name="propinsi_id" style=" height: 62px;"></select>

                                            </div>
                                            <div class="form-group ">
                                                <label for="inputFloatingLabel2" class="placeholder">Kabupaten</label>
                                                <select class="kabupaten_id form-control input-full required"
                                                    name="kabupaten_id"></select>

                                            </div>
                                            <div class="form-group ">
                                                <label for="inputFloatingLabel2" class="placeholder">Kecamatan</label>
                                                <select class="kecamatan_id form-control input-full required"
                                                    name="kecamatan_id"></select>

                                            </div>
                                            <div class="form-group ">
                                                <label for="inputFloatingLabel2"
                                                    class="placeholder">Kelurahan/Desa</label>
                                                <select class="kelurahan_id form-control input-full required"
                                                    name="kelurahan_id"></select>

                                            </div>
                                            <div class="form-group">
                                                <label>Gang / RT / RW</label>
                                                <input type="text" name="jalan" value="{{ $santri->jalan }}"
                                                    class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>Nama Wali</label>
                                                <input type="text" name="ayah_display" value="{{ $wali->ayah ?? '' }}"
                                                    class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>No Telp</label>
                                                <input type="text" name="no_tlp" value="{{ $santri->no_tlp }}"
                                                    class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>Tahun Masuk</label>
                                                <input type="text" name="tahun_masuk" value="{{ $tahunMasuk }}"
                                                    class="form-control tanggal">
                                            </div>

                                            <div class="form-group">
                                                <label>Tahun Keluar</label>
                                                <input type="text" name="tahun_keluar" value="{{ $tahunKeluar }}"
                                                    class="form-control tanggal">
                                            </div>
                                        </div>
                                        {{-- kiri --}}
                                        <div class="col-md-4 mt-3">
                                            <div class="form-group ">
                                                <label for="inputFloatingLabel2"
                                                    class="placeholder">Kewarganegaraan</label>
                                                <select name="warganegara" class="form-control">

                                                    <option value="">-- pilih --</option>

                                                    <option value="WNI"
                                                        {{ $santri->warga_negara == 'WNI' ? 'selected' : '' }}>
                                                        WNI
                                                    </option>

                                                    <option value="WNA"
                                                        {{ $santri->warga_negara == 'WNA' ? 'selected' : '' }}>
                                                        WNA
                                                    </option>

                                                </select>
                                            </div>

                                            <div class="form-check">
                                                <label>Jenis Kelamin</label><br>
                                                <label class="form-radio-label">
                                                    <input class="form-radio-input" id="laki_laki" type="radio"
                                                        name="jenis_kelamin" value="Laki-laki"
                                                        {{ $selectedJenisKelamin === 'Laki-laki' ? 'checked' : '' }}>
                                                    <span class="form-radio-sign">Laki-laki</span>
                                                </label>
                                                <label class="form-radio-label ml-3">
                                                    <input class="form-radio-input" id="perempuan" type="radio"
                                                        name="jenis_kelamin" value="Perempuan"
                                                        {{ $selectedJenisKelamin === 'Perempuan' ? 'checked' : '' }}>
                                                    <span class="form-radio-sign">Perempuan</span>
                                                </label>
                                            </div>
                                            <div class="form-group ">
                                                <label>Agama</label>
                                                <select name="agama" class="form-control agama"></select>
                                            </div>

                                            <div class="form-group ">
                                                <label for="inputFloatingLabel2" class="placeholder">Jumlah
                                                    Saudara</label>
                                                <input id="inputFloatingLabel2" id="j_saudara" name="j_saudara"
                                                    type="number" class="form-control input-full"
                                                    value="{{ old('j_saudara', $santri->j_saudara ?? '') }}">
                                            </div>
                                            <div class="form-group ">
                                                <label for="inputFloatingLabel2" class="placeholder">Anak Ke</label>
                                                <input id="inputFloatingLabel2" id="anak_ke" name="anak_ke"
                                                    type="number" class="form-control input-full"
                                                    value="{{ old('anak_ke', $santri->anak_ke ?? '') }}">
                                            </div>
                                            <div class="form-group ">
                                                <label for="inputFloatingLabel2" class="placeholder">Dokumen
                                                    kk</label><br>
                                                <input type="file" name="dok_kk" id="dok_kk">
                                            </div>
                                            <div class="form-group ">
                                                <label for="inputFloatingLabel2" class="placeholder">Foto
                                                    Profil</label><br>
                                                <input type="file" name="image" id="image">
                                            </div>

                                        </div>
                                    </div>

                                </div>


                                {{-- TAB 2 DATA ORANG TUA --}}
                                <div class="tab-pane fade" id="data_ortu" role="tabpanel">

                                    <div class="row">
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label>Nama Ayah</label>
                                                <input type="text" name="ayah" value="{{ $wali->ayah ?? '' }}"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Status</label>
                                                <input type="text" name="status_ayah"
                                                    value="{{ $wali->status_ayah ?? '' }}" class="form-control"
                                                    placeholder="Masih Hidup">
                                            </div>

                                            <div class="form-group">
                                                <label>Kewarganegaraan</label>
                                                <input type="text" name="Kewarganegaraan"
                                                    value="{{ $wali->kewarganegaraan_ayah ?? '' }}" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>NIK</label>
                                                <input type="text" name="nik_ayah"
                                                    value="{{ $wali->ayah_nik ?? '' }}" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Tempat Lahir</label>
                                                <input type="text" name="tempat_lahir_ayah"
                                                    value="{{ $wali->tempat_lahir_ayah ?? '' }}" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Lahir</label>
                                                <input type="date" name="tgl_lahir_ayah"
                                                    value="{{ $wali->tgl_lahir_ayah ?? '' }}" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Pendidikan Terakhir</label>
                                                <input type="text" name="pend_ayah"
                                                    value="{{ $wali->pend_ayah ?? '' }}" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Pekerjaan Utama</label>
                                                <input type="text" name="pekerjaan_ayah"
                                                    value="{{ $wali->pekerjaan_ayah ?? '' }}" class="form-control">
                                            </div>

                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label>Nama Ibu</label>
                                                <input type="text" name="ibu" value="{{ $wali->ibu ?? '' }}"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Status</label>
                                                <input type="text" name="status_ibu"
                                                    value="{{ $wali->status_ibu ?? '' }}" class="form-control"
                                                    placeholder="Masih Hidup">
                                            </div>

                                            <div class="form-group">
                                                <label>Kewarganegaraan</label>
                                                <input type="text" name="Kewarganegaraan_ibu"
                                                    value="{{ $wali->kewarganegaraan_ibu ?? '' }}" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>NIK</label>
                                                <input type="text" name="nik_ibu" value="{{ $wali->nik_ibu ?? '' }}"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Tempat Lahir</label>
                                                <input type="text" name="tempat_lahir_ibu"
                                                    value="{{ $wali->tempat_lahir_ibu ?? '' }}" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Lahir</label>
                                                <input type="date" name="tgl_lahir_ibu"
                                                    value="{{ $wali->tgl_lahir_ibu ?? '' }}" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Pendidikan Terakhir</label>
                                                <input type="text" name="pend_ibu"
                                                    value="{{ $wali->pend_ibu ?? '' }}" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Pekerjaan Utama</label>
                                                <input type="text" name="pekerjaan_ibu"
                                                    value="{{ $wali->pekerjaan_ibu ?? '' }}" class="form-control">
                                            </div>

                                        </div>

                                    </div>

                                </div>


                                {{-- TAB 3 DATA ALAMAT --}}
                                <div class="tab-pane fade" id="data_alamat" role="tabpanel">

                                    <div class="row">

                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label>
                                                    <h2>Domisili Ayah</h2>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    {{-- <input class="form-check-input" type="checkbox" value="">
                                                    <span class="form-check-sign">Sama Dengan Ayah</span> --}}
                                                </label>
                                            </div>

                                            <div class="form-group">
                                                <label>Provinsi</label>
                                                <select name="ayah_propinsi_id" class="form-control propinsi_id"></select>
                                            </div>

                                            <div class="form-group">
                                                <label>Kabupaten</label>
                                                <select name="ayah_kabupaten_id"
                                                    class="form-control kabupaten_id"></select>
                                            </div>

                                            <div class="form-group">
                                                <label>Kecamatan</label>
                                                <select name="ayah_kecamatan_id"
                                                    class="form-control kecamatan_id"></select>
                                            </div>

                                            <div class="form-group">
                                                <label>Kelurahan</label>
                                                <select name="ayah_kelurahan_id"
                                                    class="form-control kelurahan_id"></select>
                                            </div>

                                            <div class="form-group">
                                                <label>Gang / RT / RW</label>
                                                <input type="text" name="jalan_ayah" value=""
                                                    class="form-control">
                                            </div>

                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label>
                                                    <h2>Domisili Ibu</h2>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                    <span class="form-check-sign">Sama Dengan Ayah</span>
                                                </label>
                                            </div>

                                            <div class="form-group">
                                                <label>Provinsi</label>
                                                <select name="ibu_propinsi_id" class="form-control propinsi_id"></select>
                                            </div>

                                            <div class="form-group">
                                                <label>Kabupaten</label>
                                                <select name="ibu_kabupaten_id"
                                                    class="form-control kabupaten_id"></select>
                                            </div>

                                            <div class="form-group">
                                                <label>Kecamatan</label>
                                                <select name="ibu_kecamatan_id"
                                                    class="form-control kecamatan_id"></select>
                                            </div>

                                            <div class="form-group">
                                                <label>Kelurahan</label>
                                                <select name="ibu_kelurahan_id"
                                                    class="form-control kelurahan_id"></select>
                                            </div>

                                            <div class="form-group">
                                                <label>Gang / RT / RW</label>
                                                <input type="text" name="jalan_ibu" value=""
                                                    class="form-control">
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <!-- Kiri -->
                                <button type="submit" class="btn btn-success">
                                    Simpan
                                </button>

                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    <script>
        function initSelect2(selector, url, placeholder, extra = null) {

            $(selector).select2({

                width: '100%',
                placeholder: placeholder,

                ajax: {
                    url: url,
                    dataType: 'json',
                    delay: 250,

                    data: function(params) {

                        let query = {
                            q: params.term,
                            page: 30
                        };

                        if (extra) {
                            Object.assign(query, extra());
                        }

                        return query;

                    },

                    processResults: function(data) {

                        return {
                            results: data.items
                        }

                    }

                }

            });

        }



        function setDefault(selector, value) {

            if (value) {

                let option = new Option(value, value, true, true);
                $(selector).append(option).trigger('change');

            }

        }



        $(document).ready(function() {

            initSelect2('.propinsi_id', '/provinsi', '-- Provinsi --');

            initSelect2('.kabupaten_id', '/kabupaten', '-- Kabupaten --', () => ({
                provinsi_id: $('.propinsi_id').val()
            }));

            initSelect2('.kecamatan_id', '/kecamatan', '-- Kecamatan --', () => ({
                kabupaten_id: $('.kabupaten_id').val()
            }));

            initSelect2('.kelurahan_id', '/alamat', '-- Kelurahan --', () => ({
                kecamatan_id: $('.kecamatan_id').val()
            }));

            initSelect2('.pendidikan_id', '/pendidikan', '-- Pendidikan --');

            initSelect2('.tempat_lahir', '/kabupaten', '-- Tempat Lahir --');

            initSelect2('.status_santri', '/status_santri', '-- Status Santri --');

            initSelect2('.khos', '/khos', '-- Khos');
            initSelect2('.agama', '/agama', '-- agama --');





            setDefault('.status_santri', "{{ old('status_santri', $santri->status) }}");
            setDefault('.khos', "{{ old('khos', $santri->khos) }}");
            setDefault('.pendidikan_id', "{{ old('pendidikan_id', $santri->pend_terakhir) }}");
            setDefault('.tempat_lahir', "{{ old('tempat_lahir', $santri->tempat_lahir) }}");
            setDefault('.agama', "{{ old('agama', $santri->agama ?? '') }}");


            setDefault('.propinsi_id', "{{ old('propinsi_id', $santri->provinsi) }}");
            setDefault('.kabupaten_id', "{{ old('kabupaten_id', $santri->kabupaten) }}");
            setDefault('.kecamatan_id', "{{ old('kecamatan_id', $santri->kecamatan) }}");
            setDefault('.kelurahan_id', "{{ old('kelurahan_id', $santri->kelurahan) }}");

        });


        $('.tanggal').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });
    </script>
@endpush
