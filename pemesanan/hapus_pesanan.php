<?php

// include $_SERVER['DOCUMENT_ROOT'] . '/koneksi.php';
include '../koneksi.php';
session_start();

$id_pemesanan_produk = intval($_POST['id_pemesanan_produk']);

if (!$id_pemesanan_produk) {
    echo json_encode(array('success' => false, 'message' => 'Pastikan data lengkap!'));
    mysqli_close($koneksi);
    return;
}

mysqli_query($koneksi, "DELETE FROM pemesanan_produk WHERE id_pemesanan_produk = '$id_pemesanan_produk'");
echo json_encode(array('success' => true, 'message' => 'Berhasil menghapus pesanan.'));

mysqli_close($koneksi);
return;