@extends('master')

@php
    use Carbon\Carbon;

    $tanggal_lahir = $santri->tgl_lahir ? Carbon::parse($santri->tgl_lahir)->format('Y-m-d') : '';

    $tahunMasuk = $thn_masuk?->thn_masuk ? Carbon::parse($thn_masuk->thn_masuk)->format('Y-m-d') : '';

    $tahunKeluar = $thn_keluar?->thn_keluar ? Carbon::parse($thn_keluar->thn_keluar)->format('Y-m-d') : '';

    $photo = $foto?->path ?? null;
    $dokKkPath = $dok_kk?->path ?? null;
@endphp


@section('body')
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <h2 class="text-white fw-bold">Edit Data Santri</h2>
            <h5 class="text-white op-7">Pondok Pesantren Ma'hadul 'Ilmi Asy-Syar'ie (MIS)</h5>
        </div>
    </div>

    <div class="page-inner mt--5">
        <div class="card">
            <div class="card-body">

                <form action="{{ url('/admin/update/' . $santri->santri_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        {{-- KOLOM 1 --}}
                        <div class="col-md-4">

                            <div class="form-group">
                                <label>No Induk</label>
                                <input type="text" name="no_induk" value="{{ $santri->no_induk }}" class="form-control"
                                    readonly>
                            </div>

                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" value="{{ $santri->nama }}" class="form-control"
                                    required>
                            </div>

                            <div class="form-group">
                                <label>KK</label>
                                <input type="text" name="kk" value="{{ $santri->kk }}" class="form-control"
                                    required>
                            </div>

                            <div class="form-group">
                                <label>NIK</label>
                                <input type="text" name="nik" value="{{ $santri->nik }}" class="form-control"
                                    required>
                            </div>

                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <select name="tempat_lahir" class="form-control tempat_lahir"></select>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="text" name="tgl_lahir" value="{{ $tanggal_lahir }}"
                                    class="form-control tanggal">
                            </div>

                            <div class="form-group">
                                <label>Pendidikan Terakhir</label>
                                <select name="pendidikan_id" class="form-control pendidikan_id"></select>
                            </div>

                        </div>


                        {{-- KOLOM 2 --}}
                        <div class="col-md-4">

                            <div class="form-group">
                                <label>Khos</label>
                                <select name="khos" class="form-control khos"></select>
                            </div>

                            <div class="form-group">
                                <label>Status Santri</label>
                                <select name="status_santri" class="form-control status_santri"></select>
                            </div>

                            <div class="form-group">
                                <label>Provinsi</label>
                                <select name="propinsi_id" class="form-control propinsi_id"></select>
                            </div>

                            <div class="form-group">
                                <label>Kabupaten</label>
                                <select name="kabupaten_id" class="form-control kabupaten_id"></select>
                            </div>

                            <div class="form-group">
                                <label>Kecamatan</label>
                                <select name="kecamatan_id" class="form-control kecamatan_id"></select>
                            </div>

                            <div class="form-group">
                                <label>Kelurahan</label>
                                <select name="kelurahan_id" class="form-control kelurahan_id"></select>
                            </div>

                        </div>


                        {{-- KOLOM 3 --}}
                        <div class="col-md-4">

                            <div class="form-group">
                                <label>Gang / RT / RW</label>
                                <input type="text" name="jalan" value="{{ $santri->jalan }}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Nama Wali</label>
                                <input type="text" name="ayah" value="{{ $wali->ayah ?? '' }}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>No Telp</label>
                                <input type="text" name="no_tlp" value="{{ $santri->no_tlp }}" class="form-control">
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


                            <div class="form-group">
                                <label>Dokumen KK</label>

                                @if ($dokKkPath)
                                    <a href="{{ asset('storage/' . $dokKkPath) }}" target="_blank"
                                        class="btn btn-info btn-sm mb-2">
                                        Lihat Dokumen
                                    </a>
                                @endif

                                <input type="file" name="dok_kk" class="form-control">

                            </div>


                            <div class="form-group">
                                <label>Photo</label>

                                @if ($photo)
                                    <img src="{{ asset('storage/' . $photo) }}" width="150" class="img-thumbnail mb-2">
                                @endif

                                <input type="file" name="photo" class="form-control">

                            </div>

                        </div>

                    </div>


                    <div class="mt-3">

                        <a href="{{ url('admin') }}" class="btn btn-primary btn-lg">
                            Batal
                        </a>

                        <button class="btn btn-success btn-lg">
                            Simpan
                        </button>

                    </div>

                </form>

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
                            page: 1
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

            initSelect2('.tempat_lahir', '/kabupatenLahir', '-- Tempat Lahir --');

            initSelect2('.status_santri', '/status_santri', '-- Status Santri');

            initSelect2('.khos', '/khos', '-- Khos');



            setDefault('.status_santri', "{{ $santri->status }}");
            setDefault('.khos', "{{ $santri->khos }}");
            setDefault('.pendidikan_id', "{{ $santri->pend_terakhir }}");
            setDefault('.tempat_lahir', "{{ $santri->tempat_lahir }}");

            setDefault('.propinsi_id', "{{ $santri->provinsi }}");
            setDefault('.kabupaten_id', "{{ $santri->kabupaten }}");
            setDefault('.kecamatan_id', "{{ $santri->kecamatan }}");
            setDefault('.kelurahan_id', "{{ $santri->kelurahan }}");

        });


        $('.tanggal').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });
    </script>
@endpush
