<?php
include "koneksi.php";
$sql = "select*from pemesanan";
$query = mysqli_query($koneksi, $sql);
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tampil Input Data</title>
</head>
<body>
<h1>Tampil Input Siswa</h1>
<a href="form.php">Tambah Data Siswa</a> <br><br>
<table border ="1">
    <tr>
        <th>id_pemesanan</th>
        <th>tanggal_pemesanan</th>
        <th>total_belanja</th>
        <th colspan="2">Keterangan</th>
    </tr>
    <?php
    while ($siswa = mysqli_fetch_array($query)){
    ?>
    <tr>
        <td><?=$siswa['id_pemesanan']?></td>
        <td><?=$siswa['tanggal_pemesanan']?></td>
        <td><?=$siswa['total_belanja']?></td>
        <td><a href='edit_siswa.php'?nis=".$siswa['id_pemesanan'].">Edit</a>
        <td><a href='hapus_siswa.php'?nis=".$siswa['id_pemesanan'].">Hapus</a>
    </tr>
    <?php }
    ?>
    
</table>
</body>
</html>
