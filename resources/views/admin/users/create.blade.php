<form action="{{ route('users.store') }}" method="POST">

    @csrf

    <input type="text" name="name" placeholder="Nama">

    <input type="text" name="username" placeholder="Username">

    <select name="role">

        <option value="admin">Admin</option>

        <option value="sekretaris">Sekretaris</option>

        <option value="bendahara">Bendahara</option>

        <option value="maarif">Maarif</option>

        <option value="keamanan">Keamanan</option>

        <option value="wali">Wali</option>

    </select>

    <input type="password" name="password" placeholder="Password">

    <button type="submit">Simpan</button>

</form>
