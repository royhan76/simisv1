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
                                        {{-- <th>Foto</th> --}}
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

        // =========================================
        // CSRF TOKEN
        // =========================================
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // =========================================
        // READY
        // =========================================
        $(document).ready(function() {

            loadTable();

        });

        // =========================================
        // LOAD DATATABLE
        // =========================================
        function loadTable() {

            table = $('#tabel-santri').DataTable({

                processing: true,
                destroy: true,

                ajax: '/admin/bendahara/pembayaran/data',

                columns: [

                    {
                        data: null,
                        className: 'text-center',

                        render: function(data, type, row, meta) {
                            return meta.row + 1;
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

                                <button type="button" class="btn btn-info btn-sm mr-2"
                                    onclick="openDetail(${row.santri_id})">
                                    Detail
                                </button>

                                <button type="button" class="btn btn-success btn-sm"
                                    onclick="openBayar(${row.santri_id})">

                                    Bayar

                                </button>

                            </div>
                        `;
                        }
                    }

                ]

            });

        }

        // =========================================
        // OPEN MODAL DETAIL
        // =========================================
        function openDetail(santri_id) {

            $('#detail_nama').val('-');
            $('#detail_nik').val('-');
            $('#detail_khos').val('-');
            $('#detail_status').val('-');
            $('#detail_kamar').val('-');

            $('#detail_unit_sudah').html('<div class="text-muted">Memuat data...</div>');
            $('#detail_unit_belum').html('<div class="text-muted">Memuat data...</div>');
            $('#detail_syahriyah_sudah').html('<div class="text-muted">Memuat data...</div>');
            $('#detail_syahriyah_belum').html('<div class="text-muted">Memuat data...</div>');
            $('#detail_tahun_hijriyah').text('');

            $.ajax({
                url: '/admin/bendahara/pembayaran/detail/' + santri_id,
                type: 'GET',

                success: function(res) {

                    if (!res.success) {
                        Swal.fire('Gagal!', res.message ?? 'Detail tidak ditemukan', 'error');
                        return;
                    }

                    $('#detail_foto').attr('src', res.santri.foto);
                    $('#detail_nama').val(res.santri.nama ?? '-');
                    $('#detail_nik').val(res.santri.nik ?? '-');
                    $('#detail_khos').val(res.santri.khos ?? '-');
                    $('#detail_status').val(res.santri.status ?? '-');
                    $('#detail_kamar').val(res.santri.kamar ?? '-');
                    $('#detail_tahun_hijriyah').text(res.tahun_hijriyah ?? '');

                    const unitSudahBayar = res.unit_sudah_bayar || [];
                    const unitBelumBayar = res.unit_belum_bayar || [];
                    const syahriyahSudahBayar = res.syahriyah_sudah_bayar || [];
                    const syahriyahBelumBayar = res.syahriyah_belum_bayar || [];
                    const syahriyahNominal = parseInt(res.syahriyah_nominal || 0);
                    const totalDibayar = parseInt(res.total_dibayar || 0);
                    const unitTotalDibayar = parseInt(res.unit_total_dibayar || 0);
                    const syahriyahTotalDibayar = parseInt(res.syahriyah_total_dibayar || 0);

                    $('#detail_summary_total_paid').text(formatRupiah(totalDibayar));
                    $('#detail_summary_unit_total_paid').text(formatRupiah(unitTotalDibayar));
                    $('#detail_summary_syahriyah_total_paid').text(formatRupiah(syahriyahTotalDibayar));
                    $('#detail_summary_unit_paid').text(unitSudahBayar.length);
                    $('#detail_summary_unit_unpaid').text(unitBelumBayar.length);
                    $('#detail_summary_syahriyah_paid').text(syahriyahSudahBayar.length);
                    $('#detail_summary_syahriyah_unpaid').text(syahriyahBelumBayar.length);

                    $('#detail_unit_paid_count_label').text(unitSudahBayar.length + ' item');
                    $('#detail_unit_unpaid_count_label').text(unitBelumBayar.length + ' item');
                    $('#detail_syahriyah_paid_count_label').text(syahriyahSudahBayar.length + ' bulan');
                    $('#detail_syahriyah_unpaid_count_label').text(syahriyahBelumBayar.length + ' bulan');

                    $('#detail_unit_sudah').html(renderUnitList(unitSudahBayar, true));
                    $('#detail_unit_belum').html(renderUnitList(unitBelumBayar, false));
                    $('#detail_syahriyah_sudah').html(renderSyahriyahList(syahriyahSudahBayar, syahriyahNominal));
                    $('#detail_syahriyah_belum').html(renderMonthList(syahriyahBelumBayar));

                    $('#modalDetailPembayaran').modal('show');
                },

                error: function(xhr) {
                    console.log(xhr.responseJSON);
                    Swal.fire('Gagal!', 'Detail pembayaran gagal dimuat', 'error');
                }
            });
        }

        // =========================================
        // OPEN MODAL BAYAR
        // =========================================
        function openBayar(santri_id) {

            // RESET FORM
            $('#formBayar')[0].reset();
            // =====================================
            // SET TAHUN HIJRIYAH
            // =====================================
            $('#tahun_hijriyah').val(getHijriYear());



            // SET SANTRI ID
            $('#bayar_santri_id').val(santri_id);

            // =====================================
            // LOAD NOMINAL SYAHRIYAH
            // =====================================
            $.ajax({

                url: '/admin/bendahara/pembayaran/nominal/syahriyah',
                type: 'GET',

                success: function(res) {

                    if (res) {

                        $('#nominal_syahriyah').val(
                            parseInt(res.nominal)
                            .toLocaleString('id-ID')
                        );

                    }

                }

            });



            // RESET CHECKBOX BULAN
            $('.bulan-check')
                .prop('checked', false)
                .prop('disabled', false);

            $('.bulan-table td')
                .removeClass('bg-success text-white');

            // =====================================
            // DETAIL SANTRI
            // =====================================
            $.ajax({

                url: '/admin/bendahara/pembayaran/detail/' + santri_id,
                type: 'GET',

                success: function(res) {

                    console.log(res);

                    // FOTO
                    $('#foto_santri').attr(
                        'src',
                        res.foto ?
                        '/storage/' + res.foto :
                        '/assets/img/default.png'
                    );

                    // DETAIL
                    $('#nama').val(res.nama ?? '-');
                    $('#nik').val(res.nik ?? '-');
                    $('#khos').val(res.khos ?? '-');
                    $('#kamar').val(res.kamar ?? '-');

                    // SHOW MODAL
                    $('#modalBayar').modal('show');

                },

                error: function(err) {

                    console.log(err);

                    Swal.fire(
                        'Gagal!',
                        'Detail santri gagal dimuat',
                        'error'
                    );

                }

            });

            // =====================================
            // LOAD MASTER PEMBAYARAN
            // =====================================
            $.ajax({

                url: '/admin/bendahara/master-pembayaran/data',
                type: 'GET',

                success: function(res) {

                    $('#listPembayaranUnit').html('');

                    // ============================
                    // CEK PEMBAYARAN UNIT
                    // ============================
                    $.ajax({

                        url: '/admin/bendahara/pembayaran/unit/cek/' + santri_id,
                        type: 'GET',

                        success: function(unitSudahBayar) {

                            $.each(res.data, function(i, item) {

                                let checked = '';
                                let disabled = '';

                                // CEK SUDAH BAYAR
                                if (unitSudahBayar.includes(item.name)) {

                                    checked = 'checked';
                                    disabled = 'disabled';

                                }

                                $('#listPembayaranUnit').append(`

                    <div class="border border-payment rounded p-3 mb-3
                        ${checked ? 'bg-success text-white' : ''}">

                        <div class="custom-control custom-checkbox">

                            <input type="checkbox"
                                class="custom-control-input pembayaran-check"

                                id="unit_${item.id}"

                                data-name="${item.name}"
                                data-nominal="${item.nominal}"
                                data-bulanan="${item.bulanan}"

                                name="unit_id[]"
                                value="${item.id}"

                                ${checked}
                                ${disabled}
                            >

                            <label class="custom-control-label"
                                for="unit_${item.id}">

                                <div class="d-flex justify-content-between">

                                    <div>
                                        <b>${item.name}</b>
                                    </div>

                                    <div class="${checked ? 'text-white' : 'text-success'}">

                                        Rp ${parseInt(item.nominal)
                                            .toLocaleString('id-ID')}

                                    </div>

                                </div>

                            </label>

                        </div>

                    </div>

                `);

                            });

                        }

                    });

                }

            });

            // =====================================
            // CEK BULAN YANG SUDAH DIBAYAR
            // =====================================
            $.ajax({

                url: '/admin/bendahara/pembayaran/cek/' + santri_id,
                type: 'GET',

                success: function(res) {

                    console.log(res);

                    $.each(res, function(i, item) {

                        $('.bulan-check').each(function() {

                            let valueCheckbox = $(this).val().trim().toLowerCase();
                            let bulanDb = item.bulan.trim().toLowerCase();

                            if (valueCheckbox === bulanDb) {

                                $(this)
                                    .prop('checked', true)
                                    .prop('disabled', true);

                                $(this)
                                    .closest('td')
                                    .addClass('bg-success text-white');

                            }

                        });

                    });

                },

                error: function(err) {

                    console.log(err);

                }

            });

        }

        // =========================================
        // SUBMIT FORM
        // =========================================
        $('#formBayar').submit(function(e) {

            e.preventDefault();

            console.log($(this).serialize());

            $.ajax({

                url: '/admin/bendahara/pembayaran/store',
                type: 'POST',
                data: $(this).serialize(),

                beforeSend: function() {

                    $('.btn-success').prop('disabled', true);

                },

                success: function(res) {

                    console.log(res);

                    Swal.fire(
                        'Berhasil!',
                        res.message,
                        'success'
                    );

                    $('#modalBayar').modal('hide');

                    $('#formBayar')[0].reset();

                    table.ajax.reload();

                },

                error: function(xhr) {

                    console.log(xhr.responseJSON);

                    Swal.fire(
                        'Gagal!',
                        'Terjadi kesalahan saat menyimpan pembayaran',
                        'error'
                    );

                },

                complete: function() {

                    $('.btn-success').prop('disabled', false);

                }

            });

        });

        // =========================================
        // GET TAHUN HIJRIYAH
        // =========================================
        function getHijriYear() {

            const today = new Date();

            // KONVERSI KASAR MASEHI -> HIJRIYAH
            const hijriYear = Math.floor(
                ((today.getFullYear() - 622) * 33) / 32
            );

            return hijriYear + ' H';

        }

        function escapeHtml(value) {
            return String(value ?? '')
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        function formatRupiah(value) {
            return 'Rp ' + parseInt(value || 0).toLocaleString('id-ID');
        }

        function renderUnitList(items, sudahBayar) {
            if (!items || items.length === 0) {
                return '<div class="text-muted py-2">Tidak ada data</div>';
            }

            return `
                <div class="table-responsive">
                    <table class="table table-sm table-hover detail-table mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Nama Unit</th>
                                <th class="text-right">Nominal</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${items.map(function(item) {
                                const label = escapeHtml(item.name);
                                const nominal = parseInt(item.nominal || 0).toLocaleString('id-ID');
                                const tanggal = item.tanggal_bayar ? escapeHtml(item.tanggal_bayar) : '';

                                return `
                                    <tr>
                                        <td>
                                            <div class="font-weight-bold">${label}</div>
                                            ${sudahBayar && tanggal ? `<div class="small text-muted">Bayar: ${tanggal}</div>` : ''}
                                        </td>
                                        <td class="text-right">Rp ${nominal}</td>
                                        <td class="text-center">
                                            <span class="badge badge-${sudahBayar ? 'success' : 'danger'}">
                                                ${sudahBayar ? 'Lunas' : 'Belum'}
                                            </span>
                                        </td>
                                    </tr>
                                `;
                            }).join('')}
                        </tbody>
                    </table>
                </div>
            `;
        }

        function renderSyahriyahList(items, nominalDefault) {
            if (!items || items.length === 0) {
                return '<div class="text-muted py-2">Tidak ada data</div>';
            }

            return `
                <div class="table-responsive">
                    <table class="table table-sm table-hover detail-table mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Bulan</th>
                                <th>Tahun</th>
                                <th class="text-right">Nominal</th>
                                <th class="text-center">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${items.map(function(item) {
                                const bulan = escapeHtml(item.bulan);
                                const nominalAngka = parseInt(nominalDefault || item.nominal || 0);
                                const nominal = nominalAngka.toLocaleString('id-ID');
                                const tahun = escapeHtml(item.tahun_hijriyah || '-');
                                const tanggal = item.tanggal_bayar ? escapeHtml(item.tanggal_bayar) : '-';

                                return `
                                    <tr>
                                        <td class="font-weight-bold">${bulan}</td>
                                        <td>${tahun}</td>
                                        <td class="text-right">Rp ${nominal}</td>
                                        <td class="text-center">${tanggal}</td>
                                    </tr>
                                `;
                            }).join('')}
                        </tbody>
                    </table>
                </div>
            `;
        }

        function renderMonthList(items) {
            if (!items || items.length === 0) {
                return '<div class="text-success font-weight-bold py-2">Semua bulan pada tahun ini sudah lunas</div>';
            }

            return `
                <div class="d-flex flex-wrap">
                    ${items.map(function(item) {
                        return `
                            <span class="badge badge-danger mr-2 mb-2 px-3 py-2">
                                ${escapeHtml(item)}
                            </span>
                        `;
                    }).join('')}
                </div>
            `;
        }
    </script>
@endpush
