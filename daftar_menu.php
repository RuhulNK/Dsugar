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
            <a href="daftar_menu.php" class="nav-item nav-link active">Daftar Menu</a>
            <a href="pemesanan.php" class="nav-item nav-link">Pesanan</a>
            <a href="logout.php" class="nav-item nav-link active">Logout</a>
          </ul>
      </nav>
    </div>
    <div class="container mt-0">
      <h3 class="text-center font-weight-bold my-4">DAFTAR MENU</h3>
      <a href="tambah_menu.php" class="btn btn-success mt-3">TAMBAH DAFTAR MENU</a>
      <div class="row">
        <?php
        include('koneksi.php');
        $query = mysqli_query($koneksi, 'SELECT * FROM produk');
        $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
        ?>
        <?php foreach ($result as $result) : ?>
          <div class="col-md-3 mt-4">
            <div class="card brder-dark">
              <img src="upload/<?php echo $result['gambar'] ?>" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title font-weight-bold"><?php echo $result['nama_menu'] ?></h5>
                <label class="card-text harga"><strong>Rp.</strong> <?php echo number_format($result['harga']); ?></label><br>
                <a href="edit_menu.php?id_menu=<?php echo $result['id_menu']  ?>" class="btn btn-success btn-sm btn-block">EDIT</a>
                <a href="hapus_menu.php?id_menu=<?php echo $result['id_menu']  ?>" class="btn btn-danger btn-sm btn-block text-light">HAPUS</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <footer id="footer">
      <div class="container">
        <div class="row d-flex align-items-center">
          <div class="col-lg-6 text-lg-left text-center">
            <div class="copyright">
              &copy; Website <strong>D'Sugar</strong>. Dibuat Oleh:
              Ruhul Nur Kholif, Vivi Indriyani Mufti Afifah, dan Drino Purnomo
            </div>
          </div>
        </div>
      </div>
    </footer>
  </body>

  </html>
<?php } ?>