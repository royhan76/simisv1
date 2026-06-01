<div class="modal fade" id="modalTambah">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Tambah Nominal Pembayaran</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form id="formTambah">
                @csrf

                <div class="modal-body">

                    <div class="form-group">
                        <label>Unit Pembayaran</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Nominal</label>
                        <input type="text" name="nominal" id="nominal" class="form-control" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

            </form>

        </div>
    </div>
</div>


<!-- MODAL EDIT -->
<div class="modal fade" id="modalEdit">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Edit Nominal</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form id="formEdit">
                @csrf
                <input type="hidden" name="id" id="edit_id">

                <div class="modal-body">

                    <div class="form-group">
                        <label>Unit Pembayaran</label>
                        <input type="text" name="name" id="edit_name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Nominal</label>
                        <input type="text" name="nominal" id="edit_nominal" class="form-control">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

            </form>

        </div>
    </div>
</div>


@push('javascript')
    <script>
        let table;

        // ================= INIT =================
        $(document).ready(function() {

            loadTable();

            // FORMAT TAMBAH
            $('#nominal').on('keyup', function() {
                $(this).val(formatRupiah($(this).val(), 'Rp '));
            });

            // FORMAT EDIT
            $('#edit_nominal').on('keyup', function() {
                $(this).val(formatRupiah($(this).val(), 'Rp '));
            });

            // ================= TAMBAH =================
            $('#formTambah').submit(function(e) {
                e.preventDefault();

                let nominal = $('#nominal').val().replace(/[^0-9]/g, '');
                $('#nominal').val(nominal);

                $.ajax({
                    url: "/admin/bendahara/nominal/store",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(res) {
                        Swal.fire('Berhasil!', 'Data disimpan.', 'success');

                        $('#modalTambah').modal('hide');
                        $('#formTambah')[0].reset();

                        table.ajax.reload(); // 🔥 reload tanpa refresh
                    },
                    error: function(err) {
                        console.log(err);
                        Swal.fire('Gagal!', 'Data gagal disimpan.', 'error');
                    }
                });
            });

            // ================= EDIT =================
            $('#formEdit').submit(function(e) {
                e.preventDefault();

                let nominal = $('#edit_nominal').val().replace(/[^0-9]/g, '');
                $('#edit_nominal').val(nominal);

                $.ajax({
                    url: "/admin/bendahara/nominal/update",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(res) {
                        Swal.fire('Berhasil!', 'Data diupdate.', 'success');

                        $('#modalEdit').modal('hide');

                        table.ajax.reload(); // 🔥 reload tanpa refresh
                    },
                    error: function(err) {
                        console.log(err);
                        Swal.fire('Gagal!', 'Data gagal diupdate.', 'error');
                    }
                });
            });

        });

        // ================= LOAD TABLE =================
        function loadTable() {
            table = $('#tabel-user').DataTable({
                destroy: true,
                processing: true,
                ajax: '/admin/bendahara/nominal/data',
                columns: [{
                        data: null,
                        className: 'text-center'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'nominal',
                        className: 'text-right',
                        render: function(data) {
                            return 'Rp ' + parseInt(data).toLocaleString('id-ID');
                        }
                    },
                    {
                        data: 'id',
                        className: 'text-center',
                        orderable: false,
                        render: function(id, type, row) {
                            return `
                                    <div class="d-flex justify-content-center">
                                        <button class="btn btn-warning btn-sm mr-2"
                                            onclick="setEdit(${id}, '${row.name}', ${row.nominal})"
                                            data-toggle="modal" data-target="#modalEdit">
                                            Edit
                                        </button>

                                        <button class="btn btn-danger btn-sm"
                                            onclick="hapusData(${id})">
                                            Hapus
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

        // ================= SET EDIT =================
        function setEdit(id, name, nominal) {
            $('#edit_id').val(id);
            $('#edit_name').val(name);
            $('#edit_nominal').val(formatRupiah(nominal.toString(), 'Rp '));
        }

        // ================= HAPUS =================
        function hapusData(id) {
            Swal.fire({
                title: 'Yakin hapus?',
                text: "Data tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/admin/bendahara/nominal/delete',
                        method: 'POST',
                        data: {
                            id: id
                        },
                        success: function(res) {
                            Swal.fire('Berhasil!', 'Data dihapus.', 'success');

                            table.ajax.reload(); // 🔥 FIX utama
                        },
                        error: function(err) {
                            console.log(err);
                            Swal.fire('Error!', 'Gagal hapus.', 'error');
                        }
                    });
                }
            });
        }

        // ================= FORMAT RUPIAH =================
        function formatRupiah(angka, prefix) {
            let number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
        }
    </script>
@endpush
