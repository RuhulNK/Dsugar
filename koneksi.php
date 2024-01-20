<?php 
// cara 1 $koneksi = mysqli_connect('localhost','root','','latihan');

// cara 2
$server = 'localhost';
$user = 'root';
$password = '';
$nama_database = 'dbpemesanan';
$port = 3306;


$koneksi = mysqli_connect($server, $user, $password, $nama_database);


if( !$koneksi ){
    die("Gagal terhubung dengan database: " . mysqli_connect_error() . mysqli_get_client_version());
}
?>
