@extends('master')

@php
     $photo = !empty($foto?->path) ? 'storage/' . str_replace('public/', '', $foto->path) : 'storage/images/muslim.png';
@endphp

@section('body')
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold">Pembayaran Santri</h2>
                    <h5 class="text-white op-7 mb-2">
                        Data pembayaran santri pondok
                    </h5>
                </div>
            </div>
        </div>
    </div>

    <div class="page-inner mt--5">
        <div class="row">
            <div class="col-md-12">

                <div class="card full-height">

                    <div class="card-body">

                        <div class="table-responsive">

                            <table id="tabel-santri" class="display table table-striped table-hover">

                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Foto</th>
                                        <th>Nama</th>
                                        <th>Kamar</th>
                                        <th>Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>

                            </table>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>

    @include('layouts.pages.admin.bendahara.pembayaran.modal')

@endsection

@push('javascript')
    <script>
        let table;

        $(document).ready(function() {

            loadTable();

        });

        function loadTable() {

            table = $('#tabel-santri').DataTable({

                processing: true,
                destroy: true,

                ajax: '/admin/bendahara/pembayaran/data',

                columns: [

                    {
                        data: null,
                        className: 'text-center'
                    },

                    {
                        data: 'foto',
                        className: 'text-center',

                        render: function(data) {

                            if (!data) {

                                return `
                                <img src="{{ asset($photo) }}" alt="Avatar Santri" class="rounded-circle img-fluid shadow-sm"
                                style="width:110px; height:110px; object-fit:cover;">
                            `;
                            }

                            return `
                            <img src="/storage/${data}"
                            width="45"
                            height="45"
                            class="rounded-circle">
                        `;
                        }
                    },

                    {
                        data: 'nama'
                    },

                    {
                        data: 'khos'
                    },

                    {
                        data: 'status'
                    },

                    {
                        data: 'id',
                        className: 'text-center',

                        render: function(id, type, row) {

                            return `
                            <div class="d-flex justify-content-center">

                                <button class="btn btn-info btn-sm mr-2">
                                    Detail
                                </button>

                                <button class="btn btn-success btn-sm"
                                    onclick="openBayar(${row.santri_id})">
                                    Bayar
                                </button>

                            </div>
                        `;
                        }
                    }
                ],

                rowCallback: function(row, data, index) {

                    $('td:eq(0)', row).html(index + 1);

                }

            });

        }

        function bayar(id) {
            alert('Modal pembayaran santri id : ' + id);
        }


        function openBayar(santri_id) {
            $('#bayar_santri_id').val(santri_id);

            $.ajax({
                url: '/admin/bendahara/pembayaran/detail/' + santri_id,
                method: 'GET',

                success: function(res) {

    console.log(res);

    $('#nama').val(res.nama);
    $('#kk').val(res.nik);
    $('#khos').val(res.khos);
    $('#detail_kamar').val(
        res.kamar ?? '-'
    );

    $('#foto_santri').attr(
        'src',
        '/' + res.foto
    );

    $('#modalBayar').modal('show');
}
            });

            $.ajax({
                url: '/admin/bendahara/master-pembayaran/data',
                method: 'GET',

                success: function(res)
{
    $('#listPembayaran').html('');

    $.each(res.data, function(i, item){

        $('#listPembayaran').append(`

            <div class="border rounded p-3 mb-3">

                <div class="custom-control custom-checkbox">

                    <input type="checkbox"
                        class="custom-control-input pembayaran-check"
                        id="bayar_${item.id}"
                        name="pembayaran[]"
                        value="${item.id}"
                        data-nominal="${item.nominal}">

                    <label class="custom-control-label"
                        for="bayar_${item.id}">

                        <b>${item.name}</b>

                        <span class="ml-3 text-success">
                            Rp ${parseInt(item.nominal)
                                .toLocaleString('id-ID')}
                        </span>

                    </label>

                </div>

            </div>

        `);

    });

}
            });
        }

        $('#master_pembayaran_id').change(function() {

            let nominal = $(this)
                .find(':selected')
                .data('nominal');

            if (nominal) {
                $('#nominal').val(
                    'Rp ' + nominal.toLocaleString('id-ID')
                );
            }
        });
    </script>
@endpush
