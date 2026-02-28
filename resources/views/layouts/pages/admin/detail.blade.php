@extends('master')

@php
    $tLahir = str_replace("KABUPATEN","",$santri->tempat_lahir);
    $tLahir_ayah = str_replace("KABUPATEN","",$wali->tempat_lahir_ayah);
    $tLahir_ibu = str_replace("KABUPATEN","",$wali->tempat_lahir_ibu);
    $tanggal_lahir = str_replace("00:00:00","", $santri->tgl_lahir);

    $photo = $foto ? str_replace("public", "", $foto->path) : 'default.png';
@endphp

@section('body')
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold">Detail Santri</h2>
                    <h5 class="text-white op-7 mb-3">
                        Pondok Pesantren Ma'hadul 'Ilmi Asy-Syar'ie (MIS)
                    </h5>
                </div>
            </div>
        </div>
    </div>

    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-4">
                <div class="card full-height">
                    <div class="card-body">
                        <div class="avatar avatar-xxl">
                            <img src="{{ asset('storage/'.$photo) }}" class="avatar-img rounded-circle">
                        </div>
                        {{-- {{$foto}} --}}
                        <div class="card-title"><h2></span>{{$santri->nama}}</h2></div>
                        <div class="card-category"><span><i class="fas fa-calendar-alt"></i></span> {{$tanggal_lahir}}</div>
                        <div class="card-category"><span><i class="fas fa-home"></i> {{$tLahir}}</div>
                        <div class="dropdown-divider"></div>

                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card full-height">
                    <div class="card-body">
                        <div class="card-title font-weight-bold" >Detail Santri</div>
                        <div class="dropdown-divider"></div>

                        <div class="row py-2">
                            <div class="col-md-6">
                                <h5>No. Induk   : {{$santri->no_induk}}</h5>
                                <h5>No. Kk      : {{$santri->kk}}</h5>
                                <h5>Nik: {{$santri->nik}}</h5>
                                 <h5>Ayah      : {{$wali->ayah}}</h5>
                                <h5>Khos/Kamar: {{$santri->khos}}</h5>
                                <h5>Status: {{$santri->status}}</h5>
                                <h5>Pend. Terakhir: {{$santri->pend_terakhir}}</h5>
                            </div>
                            <div class="col-md-6">
                                <h5>Provinsi : {{$santri->provinsi}}</h5>
                                <h5>Kabupaten : {{$santri->kabupaten}}</h5>
                                <h5>Kecamatan : {{$santri->kecamatan}}</h5>
                                <h5>Kelurahan/Desa : {{$santri->kelurahan}}</h5>
                                <h5>Jl/Gang : {{$santri->jalan}}</h5>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card full-height">

                    <div class="card-body">
                        <div class="card-title font-weight-bold" >Detail KK</div>
                        <div class="dropdown-divider"></div>
                        <img src="{{ asset('storage/'.$dok_kk->path) }}" class="img-fluid" alt="...">
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="row mt--2">
            <div class="col-md-12">
                <div class="card full-height">
                    <div class="card-body">
                        <div class="card-title font-weight-bold" >Wali Santri</div>
                        <div class="dropdown-divider"></div>

                        <div class="row py-2">
                            <div class="col-md-4">
                                <h5>Ayah      : {{$wali->ayah}}</h5>
                                <h5>Nik: {{$wali->ayah_nik}}</h5>
                                <h5>Pend. Terakhir: {{$wali->pend_terakhir_id_ayah}}</h5>
                                <h5>Tempat Lahir Ayah: {{$tLahir_ayah}}</h5>
                                <h5>Tanggal Lahir Ayah: {{$wali->tgl_lahir_ayah}}</h5>
                                <h5>Pekerjaan Ayah: {{$wali->pekerjaan_ayah}}</h5>
                            </div>
                            <div class="col-md-4">
                                <h5>Ibu: {{$wali->ibu}}</h5>
                                <h5>Nik: {{$wali->nik_ibu}}</h5>
                                <h5>Pend. Terakhir Ibu: {{$wali->pend_terakhir_id_ibu}}</h5>
                                <h5>Tempat Lahir Ibu:{{$tLahir_ibu}}</h5>
                                <h5>Tanggal Lahir Ibu:{{$wali->tgl_lahir_ibu}}</h5>
                                <h5>Pekerjaan Ibu: {{$wali->pekerjaan_ibu}}</h5>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

    </div>
@endsection
