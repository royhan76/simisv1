@extends('master')

@php
    $tLahir = str_replace('KABUPATEN', '', $santri->tempat_lahir);
    $tLahir_ayah = str_replace('KABUPATEN', '', optional($wali)->tempat_lahir_ayah ?? '');
    $tLahir_ibu = str_replace('KABUPATEN', '', optional($wali)->tempat_lahir_ibu ?? '');

    $tanggal_lahir = str_replace('00:00:00', '', $santri->tgl_lahir ?? '');

    $thn_masuk_santri = str_replace('00:00:00', '', $thn_masuk?->thn_masuk ?? '');
    $thn_keluar_santri = str_replace('00:00:00', '', $thn_keluar?->thn_keluar ?? '');

    // cek foto
    $photo = !empty($foto?->path) ? 'storage/' . str_replace('public/', '', $foto->path) : 'storage/images/muslim.png';
@endphp

@section('body')
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left flex-column">
                <h2 class="text-white pb-2 fw-bold">Detail Santri</h2>
                <h5 class="text-white op-7 mb-3">
                    Pondok Pesantren Ma'hadul 'Ilmi Asy-Syar'ie (MIS)
                </h5>
            </div>
        </div>
    </div>

    <div class="page-inner mt--5">
        <div class="row mt--2">

            {{-- PROFILE --}}
            <div class="col-md-4">
                <div class="card full-height">
                    <div class="card-body text-center d-flex flex-column align-items-center">

                        <div class="mb-3">
                            <img src="{{ asset($photo) }}" alt="Avatar Santri" class="rounded-circle img-fluid shadow-sm"
                                style="width:110px; height:110px; object-fit:cover;">
                        </div>

                        <h4 class="fw-bold mb-1">{{ $santri->nama }}</h4>

                        <div class="text-muted mb-1">
                            <i class="fas fa-calendar-alt"></i> {{ $tanggal_lahir }}
                        </div>

                        <div class="text-muted">
                            <i class="fas fa-home"></i> {{ $tLahir }}
                        </div>

                        <div class="dropdown-divider w-100 mt-3"></div>

                    </div>
                </div>
            </div>

            {{-- DETAIL SANTRI --}}
            <div class="col-md-8">
                <div class="card full-height">
                    <div class="card-body">

                        <div class="card-title fw-bold">Detail Santri</div>
                        <div class="dropdown-divider"></div>

                        <div class="row py-2">

                            <div class="col-md-6">
                                <h5>No. Induk : {{ $santri->no_induk }}</h5>
                                <h5>No. KK : {{ $santri->kk }}</h5>
                                <h5>NIK : {{ $santri->nik }}</h5>
                                <h5>Ayah : {{ optional($wali)->ayah }}</h5>
                                <h5>Khos/Kamar : {{ $santri->khos }}</h5>
                                <h5>Status : {{ $santri->status }}</h5>
                                <h5>Pend. Terakhir : {{ $santri->pend_terakhir }}</h5>
                            </div>

                            <div class="col-md-6">
                                <h5>Provinsi : {{ $santri->provinsi }}</h5>
                                <h5>Kabupaten : {{ $santri->kabupaten }}</h5>
                                <h5>Kecamatan : {{ $santri->kecamatan }}</h5>
                                <h5>Kelurahan/Desa : {{ $santri->kelurahan }}</h5>
                                <h5>Jl/Gang : {{ $santri->jalan }}</h5>
                                <h5>Tahun Masuk : {{ $thn_masuk_santri }}</h5>
                                <h5>Tahun Keluar : {{ $thn_keluar_santri }}</h5>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            {{-- DOKUMEN KK --}}
            <div class="col-md-12">
                <div class="card full-height">

                    <div class="card-body">

                        <div class="card-title fw-bold">Detail KK</div>
                        <div class="dropdown-divider"></div>

                        @if (optional($dok_kk)->path)
                            <img src="{{ asset('storage/' . optional($dok_kk)->path) }}"
                                class="img-fluid rounded shadow-sm" alt="Dokumen KK">
                        @else
                            <p class="text-muted">Dokumen KK belum tersedia.</p>
                        @endif

                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
