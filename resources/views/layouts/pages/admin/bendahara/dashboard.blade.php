@extends('master')

@section('body')

<div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold">Data Nominal Pembayaran</h2>
                    <h5 class="text-white op-7 mb-2">Manajemen Akun Sistem</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-12">

                <div class="card full-height">
                    <div class="card-body">

                        <div class="row mb-3">

                            <div class="col-md-6">

                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambah">
                                    Tambah Pengguna
                                </button>

                            </div>

                        </div>

                        <div class="table-responsive">

                            <table id="tabel-user" class="display table table-striped table-hover" width="100%">

                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Unit Pembayaran</th>
                                        <th>Nominal</th>
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
@include('layouts.pages.admin.bendahara.modal')

@endsection
