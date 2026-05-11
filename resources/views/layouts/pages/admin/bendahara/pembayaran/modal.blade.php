<style>

.custom-control-label{
    width:100%;
    cursor:pointer;
    font-size:16px;
}

.border:hover{
    background:#f8f9fa;
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
            <div class="modal-header bg-primary text-white">
                <h4 class="modal-title">
                    Form Pembayaran Santri
                </h4>

                <button type="button" class="close text-white" data-dismiss="modal">
                    &times;
                </button>
            </div>

            <form id="formBayar">

                @csrf

                <input type="hidden" name="santri_id" id="santri_id">

                <div class="modal-body">

                    <!-- ================= CARD SANTRI ================= -->
                    <div class="card shadow-sm mb-4">

                        <div class="card-body">

                            <div class="row">

                                <!-- FOTO -->
                                <div class="col-md-3 text-center">

                                   <img src="{{ asset($photo) }}" alt="Avatar Santri" class="rounded-circle img-fluid shadow-sm"
                                style="width:110px; height:110px; object-fit:cover;">

                                </div>

                                <!-- DETAIL -->
                                <div class="col-md-9">

                                    <div class="row">

                                        <div class="col-md-6 mb-3">
                                            <label>Nama Santri</label>
                                            <input type="text" id="nama" class="form-control" readonly>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label>NIS</label>
                                            <input type="text" id="kk" class="form-control" readonly>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label>Khos</label>
                                            <input type="text" id="khos" class="form-control" readonly>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label>Kamar</label>
                                            <input type="text" id="detail_kamar" class="form-control" readonly>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label>Status</label>
                                            <input type="text" id="status" class="form-control" readonly>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- ================= FORM PEMBAYARAN ================= -->
                    <div class="card shadow-sm">

                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                Detail Pembayaran
                            </h5>
                        </div>

                        <div class="card-body">

                            <div class="card">

                                <div class="card-header">
                                    <h4 class="card-title">
                                        Detail Pembayaran
                                    </h4>
                                </div>

                                <div class="card-body">

                                    <div id="listPembayaran">

                                    </div>

                                </div>

                            </div>

                            <!-- ================= TABEL BULAN ================= -->
                            <div class="table-responsive">

                                <table class="table table-bordered">

                                    <thead class="bg-primary text-white text-center">

                                        <tr>
                                            <th>No</th>
                                            <th>Syawal</th>
                                            <th>Dzulqo'dah</th>
                                            <th>Dzulhijjah</th>
                                            <th>Muharram</th>
                                            <th>Shafar</th>
                                            <th>Rabiul Awal</th>
                                            <th>Rabiul Akhir</th>
                                            <th>Jumadil Awal</th>
                                            <th>Jumadil Akhir</th>
                                            <th>Rajab</th>
                                            <th>Sya'ban</th>
                                            <th>Ramadhan</th>
                                        </tr>

                                    </thead>

                                    <tbody>

                                        <tr class="text-center">

                                            <td>1</td>

                                            <td>
                                                <input type="checkbox" name="bulan[]" value="Syawal">
                                            </td>

                                            <td>
                                                <input type="checkbox" name="bulan[]" value="Dzulqodah">
                                            </td>

                                            <td>
                                                <input type="checkbox" name="bulan[]" value="Dzulhijjah">
                                            </td>

                                            <td>
                                                <input type="checkbox" name="bulan[]" value="Muharram">
                                            </td>

                                            <td>
                                                <input type="checkbox" name="bulan[]" value="Shafar">
                                            </td>

                                            <td>
                                                <input type="checkbox" name="bulan[]" value="Rabiul Awal">
                                            </td>

                                            <td>
                                                <input type="checkbox" name="bulan[]" value="Rabiul Akhir">
                                            </td>

                                            <td>
                                                <input type="checkbox" name="bulan[]" value="Jumadil Awal">
                                            </td>

                                            <td>
                                                <input type="checkbox" name="bulan[]" value="Jumadil Akhir">
                                            </td>

                                            <td>
                                                <input type="checkbox" name="bulan[]" value="Rajab">
                                            </td>

                                            <td>
                                                <input type="checkbox" name="bulan[]" value="Syaban">
                                            </td>

                                            <td>
                                                <input type="checkbox" name="bulan[]" value="Ramadhan">
                                            </td>

                                        </tr>

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- FOOTER -->
                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary">
                        Simpan Pembayaran
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>
<!-- MODAL BAYAR -->
<div class="modal fade" id="modalBayar" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-success text-white">
                <h4 class="modal-title">
                    Form Pembayaran Santri
                </h4>

                <button type="button" class="close text-white" data-dismiss="modal">
                    &times;
                </button>
            </div>

            <form id="formPembayaran">

                @csrf

                <input type="hidden" name="santri_id" id="bayar_santri_id">

                <div class="modal-body">

                    <!-- CARD SANTRI -->
                    <div class="card mb-4">
                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-3 text-center">

                                    <img id="foto_santri" src="" class="img-fluid rounded"
                                        style="max-height:200px; object-fit:cover;">

                                </div>

                                <div class="col-md-9">

                                    <table class="table table-borderless">

                                        <tr>
                                            <td width="200">
                                                <b>Nama</b>
                                            </td>
                                            <td id="nama">-</td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <b>NIS</b>
                                            </td>
                                            <td id="kk">-</td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <b>Khos</b>
                                            </td>
                                            <td id="khos">-</td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <b>Kamar</b>
                                            </td>
                                            <td id="detail_kamar">-</td>
                                        </tr>

                                    </table>

                                </div>

                            </div>

                        </div>
                    </div>

                    <!-- FORM PEMBAYARAN -->
                    <div class="card">

                        <div class="card-header">
                            <h4 class="card-title">
                                Input Pembayaran
                            </h4>
                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Unit Pembayaran</label>

                                        <select name="master_pembayaran_id" id="master_pembayaran_id"
                                            class="form-control">

                                            <option value="">
                                                -- Pilih --
                                            </option>

                                        </select>
                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Nominal</label>

                                        <input type="text" id="nominal" class="form-control" readonly>
                                    </div>

                                </div>

                            </div>

                            <div class="form-group">

                                <label>Keterangan</label>

                                <textarea name="keterangan" class="form-control"></textarea>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="submit" class="btn btn-success">

                        Simpan Pembayaran

                    </button>

                </div>

            </form>

        </div>
    </div>
</div>
