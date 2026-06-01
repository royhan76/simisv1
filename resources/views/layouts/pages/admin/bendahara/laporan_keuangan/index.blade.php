@extends('master')

@section('body')
    <style>
        .summary-card {
            border: 0;
            box-shadow: 0 0.25rem 1rem rgba(0, 0, 0, 0.06);
        }

        .summary-label {
            font-size: .8rem;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: #6c757d;
            margin-bottom: .35rem;
        }

        .summary-value {
            font-size: 1.65rem;
            font-weight: 800;
            line-height: 1.05;
        }

        #modalDetailLaporan .modal-dialog {
            max-width: 96vw;
            width: 96vw;
            margin: 1rem auto;
        }

        #modalDetailLaporan .modal-content {
            min-height: 90vh;
        }

        #modalDetailLaporan .modal-body {
            max-height: calc(90vh - 120px);
            overflow-y: auto;
        }

        #modalDetailLaporan .detail-table th,
        #modalDetailLaporan .detail-table td {
            vertical-align: middle;
        }
    </style>

    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold">Laporan Keuangan</h2>
                    <h5 class="text-white op-7 mb-2">
                        Ringkasan pembayaran santri per nama
                    </h5>
                </div>
            </div>
        </div>
    </div>

    <div class="page-inner mt--5">
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card summary-card h-100">
                    <div class="card-body">
                        <div class="summary-label">Total Santri Bayar</div>
                        <div class="summary-value text-primary" id="summary_total_santri">0</div>
                        <div class="small text-muted">Santri yang memiliki transaksi pembayaran</div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card summary-card h-100">
                    <div class="card-body">
                        <div class="summary-label">Total Transaksi</div>
                        <div class="summary-value text-info" id="summary_total_transaksi">0</div>
                        <div class="small text-muted">Gabungan unit dan syahriyah</div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card summary-card h-100">
                    <div class="card-body">
                        <div class="summary-label">Total Pemasukan</div>
                        <div class="summary-value text-success" id="summary_total_nominal">Rp 0</div>
                        <div class="small text-muted">Akumulasi semua pembayaran</div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card summary-card h-100">
                    <div class="card-body">
                        <div class="summary-label">Rincian</div>
                        <div class="small text-muted mb-1">Unit: <span id="summary_unit_nominal">Rp 0</span></div>
                        <div class="small text-muted">Syahriyah: <span id="summary_syahriyah_nominal">Rp 0</span></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt--2">
            <div class="col-md-12">
                <div class="card full-height shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div>
                                <h4 class="mb-0">Data Laporan Keuangan</h4>
                                <small class="text-muted">Satu baris mewakili satu santri</small>
                            </div>

                            <button type="button" class="btn btn-outline-primary" id="btnRefreshLaporan">
                                Refresh Data
                            </button>
                        </div>

                        <div class="table-responsive">
                            <table id="tabel-laporan" class="display table table-striped table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Santri</th>
                                        <th>Kamar</th>
                                        <th>Status</th>
                                        <th class="text-right">Total Dibayar</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                        <div class="mt-3 pt-3 border-top d-flex flex-column flex-md-row justify-content-between">
                            <div class="mb-2 mb-md-0">
                                <strong>Total keseluruhan santri yang sudah bayar: </strong>
                                <span id="footer_total_santri" class="text-primary">0</span>
                            </div>
                            <div>
                                <strong>Total pemasukan keseluruhan: </strong>
                                <span id="footer_total_nominal" class="text-success">Rp 0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDetailLaporan" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h4 class="modal-title">Detail Pembayaran Santri</h4>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-lg-3 text-center mb-3 mb-md-0">
                                    <img id="detail_foto" src="{{ asset('storage/images/muslim.png') }}" class="img-fluid rounded shadow"
                                        style="height:260px; width:100%; object-fit:cover;">
                                </div>

                                <div class="col-md-8 col-lg-9">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label>Nama Santri</label>
                                            <input type="text" id="detail_nama" class="form-control" readonly>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label>Status</label>
                                            <input type="text" id="detail_status" class="form-control" readonly>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label>Kamar</label>
                                            <input type="text" id="detail_kamar" class="form-control" readonly>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label>Total Dibayar</label>
                                            <input type="text" id="detail_total_dibayar" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4 mb-3">
                            <div class="card summary-card h-100">
                                <div class="card-body">
                                    <div class="summary-label">Total Transaksi</div>
                                    <div class="summary-value text-primary" id="detail_total_transaksi">0</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="card summary-card h-100">
                                <div class="card-body">
                                    <div class="summary-label">Unit</div>
                                    <div class="summary-value text-info" id="detail_total_unit">Rp 0</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="card summary-card h-100">
                                <div class="card-body">
                                    <div class="summary-label">Syahriyah</div>
                                    <div class="summary-value text-warning" id="detail_total_syahriyah">Rp 0</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Histori Pembayaran</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-hover detail-table mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Jenis</th>
                                            <th>Detail</th>
                                            <th class="text-right">Nominal</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detail_laporan_body"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    <script>
        let tableLaporan = null;
        let laporanData = [];

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            loadLaporanKeuangan();
            $('#modalDetailLaporan').appendTo('body');
        });

        $('#btnRefreshLaporan').on('click', function() {
            loadLaporanKeuangan();
        });

        function loadLaporanKeuangan() {
            $.ajax({
                url: '/admin/bendahara/laporan-keuangan/data',
                type: 'GET',
                beforeSend: function() {
                    $('#btnRefreshLaporan').prop('disabled', true).text('Memuat...');
                },
                success: function(res) {
                    laporanData = res.data || [];
                    updateSummary(res.summary || {});
                    renderLaporanTable(laporanData);
                },
                error: function(xhr) {
                    console.log(xhr.responseJSON || xhr);
                    Swal.fire('Gagal!', 'Data laporan keuangan gagal dimuat', 'error');
                },
                complete: function() {
                    $('#btnRefreshLaporan').prop('disabled', false).text('Refresh Data');
                }
            });
        }

        function updateSummary(summary) {
            $('#summary_total_santri').text(summary.total_santri || 0);
            $('#summary_total_transaksi').text(summary.total_transaksi || 0);
            $('#summary_total_nominal').text(formatRupiah(summary.total_nominal || 0));
            $('#summary_unit_nominal').text(formatRupiah(summary.unit_nominal || 0));
            $('#summary_syahriyah_nominal').text(formatRupiah(summary.syahriyah_nominal || 0));

            $('#footer_total_santri').text(summary.total_santri || 0);
            $('#footer_total_nominal').text(formatRupiah(summary.total_nominal || 0));
        }

        function renderLaporanTable(rows) {
            if (tableLaporan) {
                tableLaporan.clear().destroy();
            }

            tableLaporan = $('#tabel-laporan').DataTable({
                data: rows,
                destroy: true,
                pageLength: 25,
                lengthMenu: [10, 25, 50, 100],
                order: [[1, 'asc']],
                columns: [
                    {
                        data: null,
                        className: 'text-center',
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'nama',
                        render: function(data) {
                            return `<div class="font-weight-bold">${escapeHtml(data || '-')}</div>`;
                        }
                    },
                    {
                        data: 'khos',
                        render: function(data) {
                            return escapeHtml(data || '-');
                        }
                    },
                    {
                        data: 'status',
                        render: function(data) {
                            const value = String(data || '-').toLowerCase();
                            const badge = value.includes('keluar') ? 'danger' : (value.includes('aktif') ? 'success' : 'secondary');
                            return `<span class="badge badge-${badge}">${escapeHtml(data || '-')}</span>`;
                        }
                    },
                    {
                        data: 'total_dibayar',
                        className: 'text-right',
                        render: function(data, type, row) {
                            if (type === 'sort' || type === 'type') {
                                return parseInt(data || 0);
                            }
                            return row.total_dibayar_rupiah || formatRupiah(data || 0);
                        }
                    },
                    {
                        data: 'santri_id',
                        className: 'text-center',
                        orderable: false,
                        render: function(data, type, row) {
                            return `
                                <button type="button" class="btn btn-info btn-sm" onclick="openDetailLaporan('${row.santri_id}')">
                                    Detail
                                </button>
                            `;
                        }
                    }
                ],
                language: {
                    search: 'Cari:',
                    lengthMenu: 'Tampilkan _MENU_ data',
                    zeroRecords: 'Tidak ada data yang cocok',
                    info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
                    infoEmpty: 'Tidak ada data',
                    infoFiltered: '(disaring dari _MAX_ data)',
                    paginate: {
                        previous: 'Sebelumnya',
                        next: 'Berikutnya'
                    }
                }
            });
        }

        window.openDetailLaporan = function(santri_id) {
            $('#detail_nama').val('-');
            $('#detail_status').val('-');
            $('#detail_kamar').val('-');
            $('#detail_total_dibayar').val('Rp 0');
            $('#detail_total_transaksi').text('0');
            $('#detail_total_unit').text('Rp 0');
            $('#detail_total_syahriyah').text('Rp 0');
            $('#detail_laporan_body').html('<tr><td colspan="5" class="text-muted">Memuat data...</td></tr>');

            $.ajax({
                url: '/admin/bendahara/laporan-keuangan/detail/' + santri_id,
                type: 'GET',
                success: function(res) {
                    if (!res.success) {
                        Swal.fire('Gagal!', res.message ?? 'Detail tidak ditemukan', 'error');
                        return;
                    }

                    $('#detail_foto').attr('src', res.santri.foto || '{{ asset("storage/images/muslim.png") }}');
                    $('#detail_nama').val(res.santri.nama ?? '-');
                    $('#detail_status').val(res.santri.status ?? '-');
                    $('#detail_kamar').val(res.santri.kamar ?? '-');
                    $('#detail_total_dibayar').val(formatRupiah(res.summary.total_nominal || 0));
                    $('#detail_total_transaksi').text(res.summary.total_transaksi || 0);
                    $('#detail_total_unit').text(formatRupiah(res.summary.unit_nominal || 0));
                    $('#detail_total_syahriyah').text(formatRupiah(res.summary.syahriyah_nominal || 0));

                    renderDetailRows(res.transaksi || []);
                    setTimeout(function() {
                        $('#modalDetailLaporan').modal('show');
                    }, 0);
                },
                error: function(xhr) {
                    console.log(xhr.responseJSON || xhr);
                    Swal.fire('Gagal!', 'Detail laporan gagal dimuat', 'error');
                }
            });
        };

        function renderDetailRows(items) {
            if (!items || items.length === 0) {
                $('#detail_laporan_body').html('<tr><td colspan="5" class="text-muted">Tidak ada transaksi</td></tr>');
                return;
            }

            const rows = items.map(function(item) {
                const badge = item.sumber === 'unit' ? 'info' : 'warning';
                return `
                    <tr>
                        <td>${escapeHtml(item.tanggal_bayar || '-')}</td>
                        <td><span class="badge badge-${badge}">${escapeHtml(item.jenis || '-')}</span></td>
                        <td>
                            <div class="font-weight-bold">${escapeHtml(item.detail || '-')}</div>
                        </td>
                        <td class="text-right">${escapeHtml(item.nominal_rupiah || formatRupiah(item.nominal || 0))}</td>
                        <td>${escapeHtml(item.keterangan || '-')}</td>
                    </tr>
                `;
            }).join('');

            $('#detail_laporan_body').html(rows);
        }

        function formatRupiah(value) {
            return 'Rp ' + parseInt(value || 0).toLocaleString('id-ID');
        }

        function escapeHtml(value) {
            return String(value ?? '')
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }
    </script>
@endpush
