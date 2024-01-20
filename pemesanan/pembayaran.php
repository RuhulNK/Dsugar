<?php

// include $_SERVER['DOCUMENT_ROOT'] . '/koneksi.php';
include '../koneksi.php';
session_start();

$id_pemesanan = intval($_POST['id_pemesanan']);

if (!$id_pemesanan) {
    echo json_encode(array('success' => false, 'message' => 'Pastikan data lengkap!'));
    mysqli_close($koneksi);
    return;
}

mysqli_query($koneksi, "UPDATE pemesanan SET status = 'paid' WHERE id_pemesanan = '$id_pemesanan'");
echo json_encode(array('success' => true, 'message' => 'Berhasil memperbarui status.'));

mysqli_close($koneksi);
return;