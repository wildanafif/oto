<h3>Update Mahasiswa</h3>
<table>
    <form action="<?php echo site_url()?>/mahasiswa/update" method="POST">
        <?php foreach ($data as $row): ?>
        <tr><td>NIM : </td><td><input type="text" name="nim" value="<?php echo $row->nim;?>" readonly="readonly"/></td></tr>
        <tr><td>NAMA : </td><td><input type="text" name="nama" value="<?php echo $row->nama;?>"/></td></tr>
        <tr><td>ALAMAT : </td><td><input type="text" name="alamat" value="<?php echo $row->alamat;?>"/></td></tr>
        <?php endforeach; ?>
        <tr><td>.</td><td><input type="submit" value="Update"/></td></tr>
    </form>
</table>