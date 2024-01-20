<?php 
include('koneksi.php');

$id_menu = $_POST['id_menu'];
$nama_menu = $_POST['nama_menu'];
$jenis_menu = $_POST['jenis_menu'];
$stok = $_POST['stok'];
$harga = $_POST['harga'];
$folder = './upload/';


$edit = mysqli_query($koneksi, "UPDATE produk SET nama_menu='$nama_menu', jenis_menu='$jenis_menu', stok='$stok', harga='$harga'  WHERE id_menu='$id_menu' ");

if($edit)
	header('location: daftar_menu.php');
else
	echo "Edit Menu Gagal";


 ?>