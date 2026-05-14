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
</style>

@php
     $photo = !empty($foto?->path) ? 'storage/' . str_replace('public/', '', $foto->path) : 'storage/images/muslim.png';
@endphp

<!-- MODAL BAYAR -->
<div class="modal fade" id="modalBayar" tabindex="-1">

    <div class="modal-dialog" style="max-width:95%;">

        <div class="modal-content">

            <!-- HEADER -->
            <div class="modal-header bg-success text-white">

                <h4 class="modal-title">
                    Form Pembayaran Santri
                </h4>

                <button type="button" class="close text-white" data-dismiss="modal">

                    &times;

                </button>

            </div>

            <!-- FORM -->
            <form id="formBayar">

                @csrf

                <input type="hidden" name="santri_id" id="bayar_santri_id">

                <div class="modal-body">

                    <!-- ========================= -->
                    <!-- CARD DETAIL SANTRI -->
                    <!-- ========================= -->

                    <div class="card shadow-sm mb-4">

                        <div class="card-body">

                            <div class="row">

                                <!-- FOTO -->
                                <div class="col-md-3 text-center">



                                        <img src="{{ asset($photo) }}" class="img-fluid rounded shadow"
                                        style="height:220px; width:100%; object-fit:cover;">

                                </div>

                                <!-- DETAIL -->
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

                    <!-- ========================= -->
                    <!-- PEMBAYARAN UNIT -->
                    <!-- ========================= -->

                    <div class="card shadow-sm mb-4">

                        <div class="card-header bg-light">

                            <h5 class="mb-0">
                                Pembayaran Unit
                            </h5>

                        </div>

                        <div class="card-body">

                            <div id="listPembayaranUnit"></div>

                        </div>

                    </div>

                    <!-- ========================= -->
                    <!-- SYAHRIYAH -->
                    <!-- ========================= -->

                    <div class="card shadow-sm">

                        <div class="card-header bg-light">

                            <h5 class="mb-0">
                                Pembayaran Syahriyah
                            </h5>

                        </div>

                        <div class="card-body">

                            <!-- TAHUN -->
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

                            <!-- TABEL BULAN -->
                            <div class="table-responsive">

                                <table class="table table-bordered bulan-table">

                                    <thead class="bg-primary text-white text-center">

                                        <tr>

                                            <th width="60">
                                                No
                                            </th>

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

                                            <td>
                                                1
                                            </td>

                                            <td>
                                                <input type="checkbox" name="bulan[]" class="bulan-check"
                                                    value="Syawal">
                                            </td>

                                            <td>
                                                <input type="checkbox" name="bulan[]" class="bulan-check"
                                                    value="Dzulqodah">
                                            </td>

                                            <td>
                                                <input type="checkbox" name="bulan[]" class="bulan-check"
                                                    value="Dzulhijjah">
                                            </td>

                                            <td>
                                                <input type="checkbox" name="bulan[]" class="bulan-check"
                                                    value="Muharram">
                                            </td>

                                            <td>
                                                <input type="checkbox" name="bulan[]" class="bulan-check"
                                                    value="Shafar">
                                            </td>

                                            <td>
                                                <input type="checkbox" name="bulan[]" class="bulan-check"
                                                    value="Rabiul Awal">
                                            </td>

                                            <td>
                                                <input type="checkbox" name="bulan[]" class="bulan-check"
                                                    value="Rabiul Akhir">
                                            </td>

                                            <td>
                                                <input type="checkbox" name="bulan[]" class="bulan-check"
                                                    value="Jumadil Awal">
                                            </td>

                                            <td>
                                                <input type="checkbox" name="bulan[]" class="bulan-check"
                                                    value="Jumadil Akhir">
                                            </td>

                                            <td>
                                                <input type="checkbox" name="bulan[]" class="bulan-check"
                                                    value="Rajab">
                                            </td>

                                            <td>
                                                <input type="checkbox" name="bulan[]" class="bulan-check"
                                                    value="Syaban">
                                            </td>

                                            <td>
                                                <input type="checkbox" name="bulan[]" class="bulan-check"
                                                    value="Ramadhan">
                                            </td>

                                        </tr>

                                    </tbody>

                                </table>

                            </div>

                            <!-- KETERANGAN -->
                            <div class="form-group mt-3">

                                <label>Keterangan</label>

                                <textarea name="keterangan" class="form-control" rows="3"></textarea>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- FOOTER -->
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">

                        Tutup

                    </button>

                    <button type="submit" class="btn btn-success">

                        Simpan Pembayaran

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
