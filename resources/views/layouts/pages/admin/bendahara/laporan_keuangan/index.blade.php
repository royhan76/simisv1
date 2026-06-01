@extends('master')

@section('body')
    <style>
        .report-shell {
            background: linear-gradient(180deg, #f7f9fc 0%, #eef3f8 100%);
        }

        .summary-card,
        .matrix-card,
        .rekap-card {
            border: 0;
            box-shadow: 0 0.45rem 1.2rem rgba(16, 24, 40, 0.08);
            border-radius: 18px;
        }

        .summary-label {
            font-size: .76rem;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: #6c757d;
            margin-bottom: .25rem;
            font-weight: 700;
        }

        .summary-value {
            font-size: 1.55rem;
            font-weight: 800;
            line-height: 1.08;
        }

        .matrix-table {
            white-space: nowrap;
        }

        .matrix-table thead th {
            font-size: .78rem;
            text-transform: uppercase;
            letter-spacing: .04em;
            background: #f8fafc;
            vertical-align: middle;
        }

        .matrix-table td,
        .matrix-table th {
            vertical-align: middle !important;
        }

        .matrix-table tbody tr:hover {
            background: rgba(13, 110, 253, 0.03);
        }

        .check-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 2rem;
            height: 2rem;
            padding: 0 .55rem;
            border-radius: 999px;
            font-weight: 800;
            font-size: .78rem;
            line-height: 1;
        }

        .check-pill--yes {
            background: #dcfce7;
            color: #166534;
        }

        .check-pill--no {
            background: #eef2f7;
            color: #94a3b8;
        }

        .check-pill--syah {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .check-pill--jumlah {
            background: #e2e8f0;
            color: #0f172a;
        }

        .rekap-table thead th {
            font-size: .78rem;
            text-transform: uppercase;
            letter-spacing: .04em;
            background: #f8fafc;
        }

        .rekap-table td,
        .rekap-table th {
            vertical-align: middle !important;
        }

        .legend-dot {
            display: inline-block;
            width: .75rem;
            height: .75rem;
            border-radius: 50%;
            margin-right: .45rem;
            transform: translateY(1px);
        }

        .legend-paid {
            background: #16a34a;
        }

        .legend-syah {
            background: #2563eb;
        }

        .table-scroll {
            overflow: auto;
            border-radius: 14px;
        }
    </style>

    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold">Laporan Keuangan</h2>
                    <h5 class="text-white op-7 mb-2">
                        Format checklist pembayaran santri per unit dan syahriyah
                    </h5>
                </div>
            </div>
        </div>
    </div>

    <div class="page-inner mt--5 report-shell">
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card summary-card h-100">
                    <div class="card-body">
                        <div class="summary-label">Total Santri</div>
                        <div class="summary-value text-primary" id="summary_total_santri">0</div>
                        <div class="small text-muted">Seluruh data santri yang tampil di laporan</div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card summary-card h-100">
                    <div class="card-body">
                        <div class="summary-label">Santri Sudah Bayar</div>
                        <div class="summary-value text-success" id="summary_santri_sudah_bayar">0</div>
                        <div class="small text-muted">Santri yang minimal punya 1 pembayaran</div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card summary-card h-100">
                    <div class="card-body">
                        <div class="summary-label">Total Pemasukan</div>
                        <div class="summary-value text-dark" id="summary_total_nominal">Rp 0</div>
                        <div class="small text-muted">Gabungan seluruh unit dan syahriyah</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-8 mb-4">
                <div class="card matrix-card h-100">
                    <div class="card-body">
                        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-3">
                            <div class="mb-2 mb-md-0">
                                <h4 class="mb-1">Data Pembayaran Komplek</h4>
                                <small class="text-muted">Checklist hijau menandakan pembayaran sudah masuk</small>
                            </div>

                            <div class="d-flex align-items-center">
                                <button type="button" class="btn btn-success btn-sm mr-2" id="btnExportLaporan">
                                    Export Excel
                                </button>
                                <button type="button" class="btn btn-outline-primary btn-sm" id="btnRefreshLaporan">
                                    Refresh Data
                                </button>
                            </div>
                        </div>

                        <div class="table-scroll">
                            <table id="tabel-laporan" class="table table-bordered table-hover matrix-table mb-0" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width:60px">No</th>
                                        <th style="min-width:220px">Nama</th>
                                        <th style="width:72px">DB</th>
                                        <th style="width:72px">DU</th>
                                        <th style="width:88px">SARP B</th>
                                        <th style="width:88px">SARP L</th>
                                        <th style="width:88px">PENG B</th>
                                        <th style="width:88px">PENG L</th>
                                        <th style="width:72px">RJB</th>
                                        <th style="width:72px">KAL</th>
                                        <th style="width:72px">KTS</th>
                                        <th style="width:72px">SER</th>
                                        <th style="width:90px">SYAH</th>
                                        <th style="width:72px">JML</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>

                        <div class="mt-3 pt-3 border-top d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                            <div class="mb-2 mb-md-0">
                                <strong>Jumlah keseluruhan santri yang sudah bayar: </strong>
                                <span id="footer_santri_sudah_bayar" class="text-success">0</span>
                            </div>
                            <div>
                                <strong>Total pemasukan keseluruhan: </strong>
                                <span id="footer_total_nominal" class="text-dark">Rp 0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 mb-4">
                <div class="card rekap-card h-100">
                    <div class="card-body">
                        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-3">
                            <div>
                                <h4 class="mb-1">Rekap Unit</h4>
                                <small class="text-muted">Nominal dihitung dari data master pembayaran</small>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-sm table-hover rekap-table mb-0">
                                <thead>
                                    <tr>
                                        <th>Unit Pembayaran</th>
                                        <th class="text-center">Satuan</th>
                                        <th class="text-right">Nominal</th>
                                        <th class="text-right">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody id="summary_body">
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">Memuat data...</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="font-weight-bold">
                                        <td colspan="3" class="text-right">JUMLAH</td>
                                        <td class="text-right" id="summary_total_jumlah">Rp 0</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="alert alert-light border mt-3 mb-0">
                            <div class="font-weight-bold mb-2">Keterangan</div>
                            <div class="small text-muted mb-1">
                                <span class="legend-dot legend-paid"></span>
                                Checklist hijau = sudah bayar
                            </div>
                            <div class="small text-muted">
                                <span class="legend-dot legend-syah"></span>
                                Kolom SYAH menampilkan total bulan syahriyah yang lunas
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    <script>
        let tableLaporan = null;
        let laporanRows = [];
        let laporanSummary = {};
        let laporanCodes = [];

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            loadLaporanKeuangan();
        });

        $('#btnRefreshLaporan').on('click', function() {
            loadLaporanKeuangan();
        });

        $('#btnExportLaporan').on('click', function() {
            window.location = '/admin/bendahara/laporan-keuangan/export';
        });

        function loadLaporanKeuangan() {
            $.ajax({
                url: '/admin/bendahara/laporan-keuangan/data',
                type: 'GET',
                beforeSend: function() {
                    $('#btnRefreshLaporan').prop('disabled', true).text('Memuat...');
                },
                success: function(res) {
                    laporanRows = res.data || [];
                    laporanSummary = res.summary || {};
                    laporanCodes = res.codes || [];

                    updateSummary(laporanSummary);
                    renderSummaryTable(laporanCodes);
                    renderMatrixTable(laporanRows);
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
            $('#summary_santri_sudah_bayar').text(summary.santri_sudah_bayar || 0);
            $('#summary_total_nominal').text(formatRupiah(summary.total_nominal || 0));

            $('#footer_santri_sudah_bayar').text(summary.santri_sudah_bayar || 0);
            $('#footer_total_nominal').text(formatRupiah(summary.total_nominal || 0));
            $('#summary_total_jumlah').text(formatRupiah(summary.total_nominal || 0));
        }

        function renderSummaryTable(codes) {
            if (!codes || !codes.length) {
                $('#summary_body').html('<tr><td colspan="4" class="text-center text-muted py-4">Tidak ada data</td></tr>');
                $('#summary_total_jumlah').text(formatRupiah(0));
                return;
            }

            const rows = codes.map(function(item) {
                return `
                    <tr>
                        <td>
                            <div class="font-weight-bold">${escapeHtml(item.label || '-')}</div>
                            <div class="small text-muted">${escapeHtml(item.code || '-')}</div>
                        </td>
                        <td class="text-center">${parseInt(item.satuan || 0).toLocaleString('id-ID')}</td>
                        <td class="text-right">${formatRupiah(item.nominal || 0)}</td>
                        <td class="text-right">${formatRupiah(item.jumlah || 0)}</td>
                    </tr>
                `;
            }).join('');

            $('#summary_body').html(rows);

            const totalJumlah = codes.reduce(function(total, item) {
                return total + parseInt(item.jumlah || 0);
            }, 0);

            $('#summary_total_jumlah').text(formatRupiah(totalJumlah));
        }

        function renderMatrixTable(rows) {
            if (tableLaporan) {
                tableLaporan.clear().destroy();
            }

            tableLaporan = $('#tabel-laporan').DataTable({
                data: rows,
                destroy: true,
                scrollX: true,
                autoWidth: false,
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
                        data: 'db',
                        className: 'text-center',
                        render: function(data, type) {
                            if (type === 'sort' || type === 'type') {
                                return data ? 1 : 0;
                            }
                            return renderChecklist(data);
                        }
                    },
                    {
                        data: 'du',
                        className: 'text-center',
                        render: function(data, type) {
                            if (type === 'sort' || type === 'type') {
                                return data ? 1 : 0;
                            }
                            return renderChecklist(data);
                        }
                    },
                    {
                        data: 'sarp_b',
                        className: 'text-center',
                        render: function(data, type) {
                            if (type === 'sort' || type === 'type') {
                                return data ? 1 : 0;
                            }
                            return renderChecklist(data);
                        }
                    },
                    {
                        data: 'sarp_l',
                        className: 'text-center',
                        render: function(data, type) {
                            if (type === 'sort' || type === 'type') {
                                return data ? 1 : 0;
                            }
                            return renderChecklist(data);
                        }
                    },
                    {
                        data: 'peng_b',
                        className: 'text-center',
                        render: function(data, type) {
                            if (type === 'sort' || type === 'type') {
                                return data ? 1 : 0;
                            }
                            return renderChecklist(data);
                        }
                    },
                    {
                        data: 'peng_l',
                        className: 'text-center',
                        render: function(data, type) {
                            if (type === 'sort' || type === 'type') {
                                return data ? 1 : 0;
                            }
                            return renderChecklist(data);
                        }
                    },
                    {
                        data: 'rjb',
                        className: 'text-center',
                        render: function(data, type) {
                            if (type === 'sort' || type === 'type') {
                                return data ? 1 : 0;
                            }
                            return renderChecklist(data);
                        }
                    },
                    {
                        data: 'kal',
                        className: 'text-center',
                        render: function(data, type) {
                            if (type === 'sort' || type === 'type') {
                                return data ? 1 : 0;
                            }
                            return renderChecklist(data);
                        }
                    },
                    {
                        data: 'kts',
                        className: 'text-center',
                        render: function(data, type) {
                            if (type === 'sort' || type === 'type') {
                                return data ? 1 : 0;
                            }
                            return renderChecklist(data);
                        }
                    },
                    {
                        data: 'ser',
                        className: 'text-center',
                        render: function(data, type) {
                            if (type === 'sort' || type === 'type') {
                                return data ? 1 : 0;
                            }
                            return renderChecklist(data);
                        }
                    },
                    {
                        data: 'syah_count',
                        className: 'text-center',
                        render: function(data, type) {
                            const count = parseInt(data || 0);
                            if (type === 'sort' || type === 'type') {
                                return count;
                            }

                            return count > 0
                                ? `<span class="check-pill check-pill--syah">✓ ${count}</span>`
                                : '<span class="check-pill check-pill--no">-</span>';
                        }
                    },
                    {
                        data: 'jml',
                        className: 'text-center',
                        render: function(data, type) {
                            const total = parseInt(data || 0);
                            if (type === 'sort' || type === 'type') {
                                return total;
                            }

                            return `<span class="check-pill check-pill--jumlah">${total}</span>`;
                        }
                    }
                ],
                rowCallback: function(row, data) {
                    if (parseInt(data.jml || 0) > 0) {
                        $(row).addClass('table-success');
                    }
                },
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

        function renderChecklist(value) {
            if (value) {
                return '<span class="check-pill check-pill--yes">✓</span>';
            }

            return '<span class="check-pill check-pill--no">-</span>';
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
