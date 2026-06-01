<style>
    .custom-control-label {
        width: 100%;
        cursor: pointer;
        font-size: 15px;
    }

    .border-payment:hover {
        background: #f8f9fa;
    }

    .bulan-table td {
        vertical-align: middle !important;
    }

    #modalDetailPembayaran .modal-dialog {
        max-width: 96vw;
        width: 96vw;
        margin: 1rem auto;
    }

    #modalDetailPembayaran .modal-content {
        min-height: 90vh;
    }

    #modalDetailPembayaran .modal-body {
        max-height: calc(90vh - 120px);
        overflow-y: auto;
    }

    #modalDetailPembayaran .card-body {
        padding: 1.25rem;
    }

    .detail-summary-card {
        border: 0;
        box-shadow: 0 0.25rem 1rem rgba(0, 0, 0, 0.06);
    }

    .detail-summary-label {
        font-size: .82rem;
        text-transform: uppercase;
        letter-spacing: .04em;
        color: #6c757d;
        margin-bottom: .35rem;
    }

    .detail-summary-value {
        font-size: 1.35rem;
        font-weight: 700;
        line-height: 1.1;
    }

    .detail-summary-total {
        font-size: 1.8rem;
        font-weight: 800;
        line-height: 1.05;
    }

    .detail-section-title {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
        padding-bottom: .5rem;
        border-bottom: 1px solid #e9ecef;
    }

    .detail-section-title h6 {
        margin: 0;
        font-weight: 700;
    }

    .detail-table th,
    .detail-table td {
        vertical-align: middle;
    }

    .detail-pill {
        display: inline-flex;
        align-items: center;
        gap: .35rem;
        padding: .28rem .6rem;
        border-radius: 999px;
        font-size: .8rem;
        font-weight: 600;
        white-space: nowrap;
    }

    .detail-pill-paid {
        background: #e8f8ee;
        color: #1f8f4a;
    }

    .detail-pill-unpaid {
        background: #fdecef;
        color: #c82333;
    }
</style>

@php
    $photo = !empty($foto?->path) ? 'storage/' . str_replace('public/', '', $foto->path) : 'storage/images/muslim.png';
@endphp

<!-- MODAL BAYAR -->
<div class="modal fade" id="modalBayar" tabindex="-1">
    <div class="modal-dialog" style="max-width:95%;">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h4 class="modal-title">Form Pembayaran Santri</h4>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>

            <form id="formBayar">
                @csrf
                <input type="hidden" name="santri_id" id="bayar_santri_id">

                <div class="modal-body">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <img src="{{ asset($photo) }}" class="img-fluid rounded shadow"
                                        style="height:220px; width:100%; object-fit:cover;">
                                </div>

                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label>Nama Santri</label>
                                            <input type="text" id="nama" class="form-control" readonly>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label>NIK</label>
                                            <input type="text" id="nik" class="form-control" readonly>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label>Khos</label>
                                            <input type="text" id="khos" class="form-control" readonly>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label>Kamar</label>
                                            <input type="text" id="kamar" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Pembayaran Unit</h5>
                        </div>
                        <div class="card-body">
                            <div id="listPembayaranUnit"></div>
                        </div>
                    </div>

                    <div class="card shadow-sm">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Pembayaran Syahriyah</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tahun Hijriyah</label>
                                        <input type="text" name="tahun_hijriyah" id="tahun_hijriyah"
                                            class="form-control" readonly>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nominal Syahriyah</label>
                                        <input type="text" name="nominal_syahriyah" id="nominal_syahriyah"
                                            class="form-control" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered bulan-table">
                                    <thead class="bg-primary text-white text-center">
                                        <tr>
                                            <th width="60">No</th>
                                            <th>Syawal</th>
                                            <th>Dzulqodah</th>
                                            <th>Dzulhijjah</th>
                                            <th>Muharram</th>
                                            <th>Shafar</th>
                                            <th>Rabiul Awal</th>
                                            <th>Rabiul Akhir</th>
                                            <th>Jumadil Awal</th>
                                            <th>Jumadil Akhir</th>
                                            <th>Rajab</th>
                                            <th>Syaban</th>
                                            <th>Ramadhan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center">
                                            <td>1</td>
                                            <td><input type="checkbox" name="bulan[]" class="bulan-check" value="Syawal"></td>
                                            <td><input type="checkbox" name="bulan[]" class="bulan-check" value="Dzulqodah"></td>
                                            <td><input type="checkbox" name="bulan[]" class="bulan-check" value="Dzulhijjah"></td>
                                            <td><input type="checkbox" name="bulan[]" class="bulan-check" value="Muharram"></td>
                                            <td><input type="checkbox" name="bulan[]" class="bulan-check" value="Shafar"></td>
                                            <td><input type="checkbox" name="bulan[]" class="bulan-check" value="Rabiul Awal"></td>
                                            <td><input type="checkbox" name="bulan[]" class="bulan-check" value="Rabiul Akhir"></td>
                                            <td><input type="checkbox" name="bulan[]" class="bulan-check" value="Jumadil Awal"></td>
                                            <td><input type="checkbox" name="bulan[]" class="bulan-check" value="Jumadil Akhir"></td>
                                            <td><input type="checkbox" name="bulan[]" class="bulan-check" value="Rajab"></td>
                                            <td><input type="checkbox" name="bulan[]" class="bulan-check" value="Syaban"></td>
                                            <td><input type="checkbox" name="bulan[]" class="bulan-check" value="Ramadhan"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="form-group mt-3">
                                <label>Keterangan</label>
                                <textarea name="keterangan" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Simpan Pembayaran</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL DETAIL -->
<div class="modal fade" id="modalDetailPembayaran" tabindex="-1">
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
                                <img id="detail_foto" src="{{ asset($photo) }}" class="img-fluid rounded shadow"
                                    style="height:260px; width:100%; object-fit:cover;">
                            </div>

                            <div class="col-md-8 col-lg-9">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label>Nama Santri</label>
                                        <input type="text" id="detail_nama" class="form-control" readonly>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>NIK</label>
                                        <input type="text" id="detail_nik" class="form-control" readonly>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Khos</label>
                                        <input type="text" id="detail_khos" class="form-control" readonly>
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
                                        <label>Tahun Hijriyah Aktif</label>
                                        <input type="text" id="detail_tahun_hijriyah" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-12 mb-3">
                        <div class="card detail-summary-card border-0">
                            <div class="card-body d-flex flex-column flex-md-row align-items-md-end justify-content-between">
                                <div class="mb-3 mb-md-0">
                                    <div class="detail-summary-label mb-2">Total Uang Dibayarkan</div>
                                    <div class="detail-summary-total text-primary" id="detail_summary_total_paid">Rp 0</div>
                                    <div class="small text-muted mt-1">Akumulasi semua pembayaran unit dan syahriyah</div>
                                </div>

                                <div class="d-flex flex-wrap justify-content-md-end">
                                    <div class="mr-4 mb-2 mb-md-0">
                                        <div class="detail-summary-label">Unit Dibayar</div>
                                        <div class="detail-summary-value text-success" id="detail_summary_unit_total_paid">Rp 0</div>
                                    </div>
                                    <div>
                                        <div class="detail-summary-label">Syahriyah Dibayar</div>
                                        <div class="detail-summary-value text-success" id="detail_summary_syahriyah_total_paid">Rp 0</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-lg-3 mb-3 mb-lg-0">
                        <div class="card detail-summary-card">
                            <div class="card-body">
                                <div class="detail-summary-label">Unit Lunas</div>
                                <div class="detail-summary-value text-success" id="detail_summary_unit_paid">0</div>
                                <div class="small text-muted">Item pembayaran yang sudah dibayar</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-lg-3 mb-3 mb-lg-0">
                        <div class="card detail-summary-card">
                            <div class="card-body">
                                <div class="detail-summary-label">Unit Sisa</div>
                                <div class="detail-summary-value text-danger" id="detail_summary_unit_unpaid">0</div>
                                <div class="small text-muted">Item pembayaran yang belum dibayar</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-lg-3">
                        <div class="card detail-summary-card">
                            <div class="card-body">
                                <div class="detail-summary-label">Syahriyah Lunas</div>
                                <div class="detail-summary-value text-success" id="detail_summary_syahriyah_paid">0</div>
                                <div class="small text-muted">Bulan yang sudah dibayar</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-lg-3">
                        <div class="card detail-summary-card">
                            <div class="card-body">
                                <div class="detail-summary-label">Syahriyah Sisa</div>
                                <div class="detail-summary-value text-danger" id="detail_summary_syahriyah_unpaid">0</div>
                                <div class="small text-muted">Bulan yang belum dibayar</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-header bg-success text-white">
                                <h5 class="mb-0">Sudah Dibayar</h5>
                            </div>

                            <div class="card-body">
                                <div class="detail-section-title">
                                    <h6>Pembayaran Unit</h6>
                                    <span class="detail-pill detail-pill-paid" id="detail_unit_paid_count_label">0 item</span>
                                </div>
                                <div id="detail_unit_sudah"></div>

                                <hr>

                                <div class="detail-section-title">
                                    <h6>Syahriyah</h6>
                                    <span class="detail-pill detail-pill-paid" id="detail_syahriyah_paid_count_label">0 bulan</span>
                                </div>
                                <div id="detail_syahriyah_sudah"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-header bg-danger text-white">
                                <h5 class="mb-0">Belum Dibayar</h5>
                            </div>

                            <div class="card-body">
                                <div class="detail-section-title">
                                    <h6>Pembayaran Unit</h6>
                                    <span class="detail-pill detail-pill-unpaid" id="detail_unit_unpaid_count_label">0 item</span>
                                </div>
                                <div id="detail_unit_belum"></div>

                                <hr>

                                <div class="detail-section-title">
                                    <h6>Syahriyah</h6>
                                    <span class="detail-pill detail-pill-unpaid" id="detail_syahriyah_unpaid_count_label">0 bulan</span>
                                </div>
                                <div id="detail_syahriyah_belum"></div>
                            </div>
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
