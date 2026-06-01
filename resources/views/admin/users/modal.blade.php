<div class="modal fade" id="modalTambah">

    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Tambah Pengguna</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form id="formTambah">

                @csrf

                <div class="modal-body">

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Role</label>
                        <select name="role" class="form-control">

                            <option value="admin">Admin</option>
                            <option value="sekretaris">Sekretaris</option>
                            <option value="bendahara">Bendahara</option>
                            <option value="wali">wali</option>


                        </select>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">

                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>

                        </select>
                    </div>

                </div>

                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>


<div class="modal fade" id="modalEdit">

    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Edit Pengguna</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form id="formEdit">

                @csrf
                <input type="hidden" name="id" id="edit_id">

                <div class="modal-body">

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" id="edit_name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" id="edit_username" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Role</label>
                        <select name="role" id="edit_role" class="form-control">

                            <option value="admin">Admin</option>
                            <option value="sekretaris">Sekretaris</option>
                            <option value="bendahara">Bendahara</option>
                            <option value="wali">wali</option>


                        </select>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" >
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="edit_status" class="form-control">

                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>

                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

            </form>

        </div>
    </div>

</div>
