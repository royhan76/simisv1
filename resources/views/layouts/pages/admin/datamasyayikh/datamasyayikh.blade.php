@extends('master')

@section('body')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Data Masyayikh</h2>
            </div>
            <div class="ml-md-auto py-2 py-md-0">
                <button type="button" id="btn-tambah" class="btn btn-white btn-border btn-round mr-2"
                    style="border: 2px solid white !important; margin-bottom: 10px;">
                    Tambah Data
                </button>
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
                                    <th style="text-align: center; vertical-align: middle;">No</th>
                                    <!-- <th style="text-align: center; vertical-align: middle;">ID Anggota</th> -->
                                    <th style="text-align: center; vertical-align: middle;">Nama</th>
                                    <th style="text-align: center; vertical-align: middle;">Domisili</th>
                                    <th style="text-align: center; vertical-align: middle;">Sebagai</th>
                                    <th style="text-align: center; vertical-align: middle;"><i class="icon-grid"></i>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- Modal --}}

<div class="modal" id="modal-detail">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="header-modal" class="modal-header">
                <h4 class="modal-title" id="modal-title">Data Detail</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-detail" data-parsley-validate method="POST" action="">
                    {{ csrf_field() }} {{ method_field('POST') }}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-inline">
                                <label class="col-md-4 col-form-label" style="text-align: left;">Nama</label>
                                <div class="col-md-8 p-0">
                                    <input id="id" name="id" type="hidden">
                                    <input type="text" id="nomor_induk" name="nomor_induk"
                                        class="form-control input-full required" placeholder="Nama" required
                                        data-parsley-errors-messages-disabled>
                                </div>
                            </div>
                            <div class="form-group form-inline">
                                <label class="col-md-4 col-form-label" style="text-align: left;">Domisili</label>
                                <div class="col-md-8 p-0">
                                    <input type="text" id="nama" name="nama" class="form-control input-full required"
                                        placeholder="Domisili" required data-parsley-errors-messages-disabled>
                                </div>
                            </div>
                            <div class="form-group form-inline">
                                <label class="col-md-4 col-form-label" style="text-align: left;">Sebagai</label>
                                <div class="col-md-8 p-0">
                                    <select name="tipe" id="tipe" class="w-100 form-control" placeholder="Tipe Karyawan"
                                        required data-parsley-errors-messages-disabled>
                                        <option value="" disabled selected>Sebagai</option>
                                        <option id="opsi-dokter" value="Dokter">Pengasuh</option>
                                        <option id="opsi-karyawan" value="Karyawan">Pembina</option>
                                        <option id="opsi-perawat" value="Perawat">Penasehat</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                {{-- <span>Catatan : <br>Untuk karyawan baru secara otomatis password default sama dengan Username.</span> --}}
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Kembali</button>
                <button id="btn-simpan" type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('javascript')
<script>
    $(document).ready(function(){

        $('#btn-tambah').click(function () {
            $('#header-modal').css('background-color', '#1572e8');
            $('#header-modal').css('color', '#fff');
            $('#modal-title').html('Tambah Data');
            $('#btn-simpan').html('Simpan');
            $('#btn-simpan').attr('class', 'btn btn-success');
            $('#btn-simpan').attr('disabled', 'disabled');
            $('#modal-detail').modal('show');
            $('#nomor_induk').select();
            $('#nomor_induk').focus();
            console.log("cek");
        });

    })

</script>
@endpush
