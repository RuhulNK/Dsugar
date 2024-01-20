<?php
include('koneksi.php');
session_start();
if (!isset($_SESSION['login_user'])) {
  header("location: index.php");
} else {
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>D'Sugar</title>
    <link rel="shortcut icon" type="image" href="./icon/logo.png.png" />
    <link rel="stylesheet" href="style.css" />
    <!-- bootstrap link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- bootstrap link -->
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet" />

    <!-- font -->
  </head>

  <body>

    <div id="cantainer-background">
      <nav class="navbar navbar-expand-md" id="navbar-color">
        <!-- Brand -->
        <a class="navbar-brand" href="#" id="logo-color"><i><img src="./icon/logo.png.png" alt="" /></i>D'Sugar</a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
          <span><i><img src="./icon/menu.png" alt="" id="menu-color" /></i></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav">
            <a href="admin.php" class="nav-item nav-link">Home</a>
            <a href="about.php" class="nav-item nav-link">About</a>
            <a href="daftar_menu.php" class="nav-item nav-link">Daftar Menu</a>
            <a href="pemesanan.php" class="nav-item nav-link active">Pesanan Anda</a>
            <a href="logout.php" class="nav-item nav-link active">Logout</a>
          </ul>
      </nav>
    </div>
    <div class="container mt-0">
      <div class="judul-pesanan my-4">
        <h3 class="text-center font-weight-bold">DETAIL PESANAN PELANGGAN</h3>
      </div>
      <table class="table table-bordered" id="example">
        <thead class="thead-light">
          <tr>
            <th scope="col">No.</th>
            <th scope="col">Nama Pesanan</th>
            <th scope="col">Harga</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Subharga</th>
          </tr>
        </thead>
        <tbody>
          <?php $nomor = 1; ?>
          <?php $id_pemesanan = null; ?>
          <?php $totalbelanja = 0; ?>
          <?php
          $ambil = $koneksi->query("SELECT * FROM pemesanan_produk JOIN produk ON pemesanan_produk.id_menu=produk.id_menu 
                WHERE pemesanan_produk.id_pemesanan='$_GET[id]'");
          ?>
          <?php while ($pecah = $ambil->fetch_assoc()) { ?>
            <?php $subharga1 = $pecah['harga'] * $pecah['jumlah']; ?>
            <tr>
              <th scope="row"><?php echo $nomor; ?></th>
              <td><?php echo $pecah['nama_menu']; ?></td>
              <td>Rp. <?php echo number_format($pecah['harga']); ?></td>
              <td><?php echo $pecah['jumlah']; ?></td>
              <td>
                Rp. <?php echo number_format($pecah['harga'] * $pecah['jumlah']); ?>
              </td>
            </tr>
            <?php $nomor++; ?>
            <?php $id_pemesanan = $pecah['id_pemesanan']; ?>
            <?php $totalbelanja += $subharga1; ?>
          <?php } ?>
        </tbody>
        <tfoot>
          <tr>
            <th colspan="4">Total Bayar</th>
            <th>Rp. <?php echo number_format($totalbelanja) ?></th>
          </tr>
        </tfoot>
      </table><br>

      <a href="pemesanan.php" class="btn btn-success btn-sm">Kembali</a>
      <button class="btn btn-primary btn-sm" onclick="pay('<?= $id_pemesanan ?>')">Konfirmasi Pembayaran</button>

    </div>
    <footer id="footer">
      <div class="container">
        <div class="row d-flex align-items-center">
          <div class="col-lg-6 text-lg-left text-center">
            <div class="copyright">
              &copy; Website <strong>D'Sugar</strong>. Dibuat Oleh:
              Ruhul Nur Kholif, Vivi Indriyani Mufti Afifah, dan Driono Purnomo
            </div>
          </div>
        </div>
      </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script>
      $(document).ready(function() {
        $('#example').DataTable();
      });

      function pay(id_pemesanan) {
      let xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
          if (xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
              alert(response.message)
              console.log("Success:", response.message);
              location.replace('pemesanan.php')
            } else {
              alert(response.message)
              console.error("Error:", response.message);
            }
          } else {
            alert(xhr.status)
            console.error("Request failed with status:", xhr.status);
          }
        }
      };

      let data = "id_pemesanan=" + id_pemesanan;

      xhr.open("POST", "pemesanan/pembayaran.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.send(data);
    }
    </script>
  </body>

  </html>
<?php } ?>