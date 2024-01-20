<?php

// include $_SERVER['DOCUMENT_ROOT'] . '/koneksi.php';
include '../koneksi.php';
session_start();

$id_pemesanan_produk = intval($_POST['id_pemesanan_produk']);
$jumlah = intval($_POST['jumlah']);

if (!$id_pemesanan_produk || !$jumlah) {
    echo json_encode(array('success' => false, 'message' => 'Pastikan data lengkap!'));
    mysqli_close($koneksi);
    return;
}

mysqli_query($koneksi, "UPDATE pemesanan_produk SET jumlah = '$jumlah' WHERE id_pemesanan_produk = '$id_pemesanan_produk'");
echo json_encode(array('success' => true, 'message' => 'Berhasil memperbarui pesanan.'));

mysqli_close($koneksi);
return;