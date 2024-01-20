<?php

// include $_SERVER['DOCUMENT_ROOT'] . '/koneksi.php';
include '../koneksi.php';
session_start();

$id_user = intval($_SESSION['id_user']);
if (!$id_user) {
    echo json_encode(array('success' => false, 'message' => 'Pastikan data lengkap!'));
    mysqli_close($koneksi);
    return;
}

$pesanan = mysqli_query($koneksi, "SELECT * FROM pemesanan WHERE id_user = '$id_user' AND status = 'pending'");
$row = $pesanan->fetch_assoc();
$id_pemesanan = $row['id_pemesanan'];

$pesanan_produk = mysqli_query($koneksi, "SELECT * FROM pemesanan_produk WHERE id_pemesanan = '$id_pemesanan'");
$data = array();
while ($row = mysqli_fetch_assoc($pesanan_produk)) {
    $data[] = $row;
}

if (!$data) {
    echo json_encode(array('success' => false, 'message' => 'Tidak ada data!'));
    mysqli_close($koneksi);
    return;
}

$total = 0;
foreach ($data as $d) {
    $jumlah = $d['jumlah'];
    $id_menu = $d['id_menu'];
    mysqli_query($koneksi, "UPDATE produk SET stok = stok - '$jumlah' WHERE id_menu = '$id_menu'");
    $produk = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_menu = '$id_menu'");
    $row = $produk->fetch_assoc();
    $subtotal = $row['harga'] * $jumlah;
    $total += $subtotal;
}

mysqli_query($koneksi, "UPDATE pemesanan SET total_belanja = '$total', status = 'order' WHERE id_pemesanan = '$id_pemesanan'");
echo json_encode(array('success' => true, 'message' => 'Berhasil membuat order.'));
mysqli_close($koneksi);
return;