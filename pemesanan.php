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
            <a href="pemesanan.php" class="nav-item nav-link active">Pesanan</a>
            <a href="logout.php" class="nav-item nav-link active">Logout</a>
          </ul>
      </nav>
    </div>
    <div class="container mt-0">
      <div class="judul-pesanan my-4">
        <h3 class="text-center font-weight-bold">DATA PESANAN PELANGGAN</h3>
      </div>
      <table class="table table-bordered" id="example">
        <thead class="thead-light">
          <tr>
            <th scope="col">No.</th>
            <th scope="col">ID Pemesanan</th>
            <th scope="col">Tanggal Pesan</th>
            <th scope="col">Total Bayar</th>
            <th scope="col" class="text-center">Status</th>
            <th scope="col" class="text-center">Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php $nomor = 1; ?>
          <?php
          $ambil = mysqli_query($koneksi, 'SELECT * FROM pemesanan WHERE status != "pending" ORDER BY id_pemesanan DESC');
          $result = mysqli_fetch_all($ambil, MYSQLI_ASSOC);
          ?>
          <?php foreach ($result as $result) : ?>

            <tr>
              <th scope="row"><?php echo $nomor; ?></th>
              <td><?php echo $result["id_pemesanan"]; ?></td>
              <td><?php echo $result["tanggal_pemesanan"]; ?></td>
              <td>Rp. <?php echo number_format($result["total_belanja"]); ?></td>
              <?php if ($result['status'] == 'order') { ?>
                <td class="text-center"><span class="badge badge-warning">Belum dibayar</span></td>
              <?php } else if (($result['status'] == 'paid')) { ?>
                <td class="text-center"><span class="badge badge-success">Dibayar</span></td>
              <?php } else { ?>
                <td></td>
              <?php } ?>
              <td class="text-center">
                <a href="detail_pesanan.php?id=<?php echo $result['id_pemesanan'] ?>" class="btn btn-sm btn-info">Detail</a>
                <a class="btn btn-primary btn-sm" href="pemesanan/struk.php?id=<?= $result['id_pemesanan'] ?>" target="_blank">Print Struk</a>
                <a href="clear_pesanan.php?id=<?php echo $result['id_pemesanan'] ?>" class="btn btn-sm btn-danger">Hapus Data</a>
              </td>
            </tr>
            <?php $nomor++; ?>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>


    <script>
      function sendMessage() {
        // Dapatkan nilai dari input Nama, Pesanan, dan No.Meja
        var nama = document.getElementById("usr").value;
        var pesanan = document.getElementById("psn").value;
        var noMeja = document.getElementById("nomj").value;

        // Periksa apakah semua input telah diisi
        if (nama.trim() === '' || pesanan.trim() === '' || noMeja.trim() === '') {
          alert("Harap isi semua kolom sebelum mengirim pesan.");
        } else {
          // Jika semua input diisi, Anda dapat mengirim pesan ke server atau melakukan tindakan lainnya di sini.
          alert("Pesan telah dikirim!");
          // Di sini, Anda dapat menambahkan kode untuk mengirim pesan ke server atau melakukan tindakan lainnya sesuai kebutuhan.
        }
      }
    </script>

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
    </script>
  </body>

  </html>
<?php } ?>