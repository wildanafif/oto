<h1>CRUD CodeIgniter</h1>

<h3>Input Mahasiswa</h3>
<table>
    <form action="<?php echo site_url()?>/mahasiswa/insert" method="POST">
        <tr><td>NIM : </td><td><input type="text" name="nim"/></td></tr>
        <tr><td>NAMA : </td><td><input type="text" name="nama"/></td></tr>
        <tr><td>ALAMAT : </td><td><input type="text" name="alamat"/></td></tr>
        <tr><td>.</td><td><input type="submit" value="Input"/></td></tr>
    </form>
</table>

<table>

    <tr>
        <th>NIM</th><th>NAMA</th><th>ALAMAT</th><th>Update Delete</th>
    </tr>
    <?php foreach ($data as $row): ?>
        <tr>
            <td><?php echo $row->nim; ?></td>
            <td><?php echo $row->nama; ?></td>
            <td><?php echo $row->alamat; ?></td>
            <td><a href="<?php echo site_url()?>/mahasiswa/ubah/<?php echo $row->nim;?>">Update</a> || <a href="<?php echo site_url();?>/mahasiswa/delete/<?php echo $row->nim;?>">Delete</a></td>
        </tr>
    <?php endforeach; ?>
</table>
