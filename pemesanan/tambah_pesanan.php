<?php

// include $_SERVER['DOCUMENT_ROOT'] . '/koneksi.php';
include '../koneksi.php';
session_start();

// Mengambil data dari user
$id_user = intval($_SESSION['id_user']);
$id_menu = intval($_POST['id_menu']);
$jumlah = intval($_POST['jumlah']);

if (!$id_user || !$id_menu || !$jumlah) {
    echo json_encode(array('success' => false, 'message' => 'Pastikan data lengkap!'));
    mysqli_close($koneksi);
    return;
}

// $stok = 0;
// $cekProduk = mysqli_query($koneksi, "SELECT stok FROM produk WHERE id_menu = '$id_menu'");
// if ($cekProduk->num_rows > 0) {
//     while ($row = $cekProduk->fetch_assoc()) {
//         $stok = $row['stok'];
//     }
// }
// if ($stok < $jumlah) {
//     echo json_encode(array('success' => false, 'message' => 'Stok tidak mencukupi!'));
//     mysqli_close($koneksi);
//     return;
// }

function getTotalHarga($id_menu, $jml, $koneksi) {
    $cekMenu = mysqli_query($koneksi, "SELECT harga FROM produk WHERE id_menu = '$id_menu'");
    while ($row = $cekMenu->fetch_assoc()) {
        $harga = $row['harga'];
    }
    return $harga * $jml;
}

$cekPesanan = mysqli_query($koneksi, "SELECT id_pemesanan FROM pemesanan WHERE id_user = '$id_user' AND status = 'pending'");

$id_pemesanan = null;
if ($cekPesanan->num_rows > 0) {
    while ($row = $cekPesanan->fetch_assoc()) {
        $id_pemesanan = $row['id_pemesanan'];
    }
} else {
    // Tidak ada data yang sesuai kriteria
    $tanggal = date('Y-m-d');
    $total = getTotalHarga($id_menu, $jumlah, $koneksi);
    mysqli_query($koneksi, "INSERT INTO pemesanan (tanggal_pemesanan, id_user, status, total_belanja) VALUES ('$tanggal', '$id_user', 'pending', '$total')");
    $id_pemesanan = mysqli_insert_id($koneksi);
}

if ($id_pemesanan != 0) {
    $cekProduk = mysqli_query($koneksi, "SELECT id_pemesanan_produk FROM pemesanan_produk WHERE id_pemesanan = '$id_pemesanan' AND id_menu = '$id_menu'");
    $total = getTotalHarga($id_menu, $jumlah, $koneksi);
    mysqli_query($koneksi, "UPDATE pemesanan SET total_belanja = total_belanja + '$total' WHERE id_pemesanan = '$id_pemesanan'");
    // mysqli_query($koneksi, "UPDATE produk SET stok = stok - '$jumlah' WHERE id_menu = '$id_menu'");
    if ($cekProduk->num_rows > 0) {
        while ($row = $cekProduk->fetch_assoc()) {
            $id_pemesanan_produk = $row['id_pemesanan_produk'];
        }
        mysqli_query($koneksi, "UPDATE pemesanan_produk SET jumlah = jumlah + '$jumlah' WHERE id_pemesanan_produk = $id_pemesanan_produk");
        echo json_encode(array('success' => true, 'message' => 'Berhasil menambah pesanan.'));
    } else {
        mysqli_query($koneksi, "INSERT INTO pemesanan_produk (id_pemesanan, id_menu, jumlah) VALUES ('$id_pemesanan', '$id_menu', '$jumlah')");
        echo json_encode(array('success' => true, 'message' => 'Berhasil menambah pesanan.'));
    }
} else {
    echo json_encode(array('success' => false, 'message' => mysqli_error($koneksi)));
}
mysqli_close($koneksi);
return;
