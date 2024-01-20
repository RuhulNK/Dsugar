<?php
// include $_SERVER['DOCUMENT_ROOT'] . '/koneksi.php';
include '../koneksi.php';
session_start();
?>
<html>

<head>
    <title>Struk Pesanan</title>
    <style>
        #tabel {
            border-collapse: collapse;
        }

        #tabel td {
            padding-left: 5px;
            border: 1px solid black;
        }
    </style>
</head>

<body style='font-family:tahoma;' onload="javascript:window.print()">
    <center>
        <table style='width:650px; font-family:calibri; border-collapse: collapse;' border='0'>
            <td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
                <span style='font-size:12pt'><b>D'Sugar</b></span></br>
                Alamat : </br>
                Telp : 
            </td>
            <?php
            $pesanan = $koneksi->query("SELECT * FROM pemesanan WHERE id_pemesanan='$_GET[id]'");
            $row = $pesanan->fetch_assoc();
            ?>
            <td style='vertical-align:top' width='30%' align='left'>
                <b><span style='font-size:12pt'>Struk Pesanan</span></b></br>
                ID Pesanan. : <?= $row['id_pemesanan'] ?></br>
                Tanggal :<?= $row['tanggal_pemesanan'] ?></br>
            </td>
        </table>
        <table cellspacing='0' style='width:650px; font-family:calibri;  border-collapse: collapse; margin-top: 15px;' border='1'>
            <tr align='center'>
                <td width='20%'>Nama Barang</td>
                <td width='13%'>Harga</td>
                <td width='4%'>Jumlah</td>
                <td width='13%'>Total Harga</td>
            </tr>
            <?php $nomor = 1; ?>
            <?php $totalbelanja = 0; ?>
            <?php
            $ambil = $koneksi->query("SELECT * FROM pemesanan_produk JOIN produk ON pemesanan_produk.id_menu=produk.id_menu 
                WHERE pemesanan_produk.id_pemesanan='$_GET[id]'");
            ?>
            <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                <?php $subharga1 = $pecah['harga'] * $pecah['jumlah']; ?>
                <tr>
                    <td><?= $pecah['nama_menu']; ?></td>
                    <td>Rp. <?= number_format($pecah['harga']); ?></td>
                    <td><?= $pecah['jumlah']; ?></td>
                    <td style='text-align:right'>Rp. <?= number_format($subharga1); ?></td>
                </tr>
                <?php $nomor++; ?>
                <?php $totalbelanja += $subharga1; ?>
            <?php } ?>

            <tr>
                <td colspan='3'>
                    <div style='text-align:right'>Total Yang Harus Di Bayar Adalah : </div>
                </td>
                <td style='text-align:right'>Rp. <?= number_format($totalbelanja); ?></td>
            </tr>
        </table>

        <table style='width:650; margin-top: 15px;' cellspacing='2'>
            <tr>
                <td align='center'>Diterima Oleh,</br></br><u>(............)</u></td>
                <td align='center'>TTD,</br></br><u>(...........)</u></td>
            </tr>
        </table>
    </center>
</body>

</html>
<?php mysqli_close($koneksi); ?>