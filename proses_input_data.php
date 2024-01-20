<?php
include "koneksi.php";

$id_pemesanan = $_POST['id pemesanan'];
$tanggal_pemesanan = $_POST['tanggal pemesanan'];
$total_belanja = $_POST['total belanja'];

$sql = "insert into pemesanan values ('$id_pemesanan', '$tanggal_pemesanan', '$total_belanja')";
$query = mysqli_query($koneksi, $sql);

if ($query) {
    header("location:tampil_input_siswa.php?simpan=sukses");
} else {
    header("location:tampil_input_siswa.php?simpan=gagal");
}


?>
