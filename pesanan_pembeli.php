<?php
include('koneksi.php');
session_start();
if (!isset($_SESSION['login_user'])) {
  header("location: index.php");
} else {
?>
  <?php
  // if (empty($_SESSION["pesanan"]) or !isset($_SESSION["pesanan"])) {
  //   echo "<script>alert('Pesanan kosong, Silahkan Pesan dahulu');</script>";
  //   echo "<script>location= 'menu_pembeli.php'</script>";
  // }
  include('koneksi.php');
  $id_user = $_SESSION['id_user'];
  $pesanan = mysqli_query($koneksi, "SELECT * FROM pemesanan WHERE id_user='$id_user' AND status = 'pending'");
  $history = mysqli_query($koneksi, "SELECT * FROM pemesanan WHERE id_user='$id_user' AND status != 'pending'");
  $data = array();
  $dataHistory = array();
  if ($pesanan->num_rows > 0) {
    while ($row = $pesanan->fetch_assoc()) {
      $id_pemesanan = $row['id_pemesanan'];
    }
    $result = mysqli_query($koneksi, "SELECT * FROM pemesanan_produk WHERE id_pemesanan='$id_pemesanan'");
    while ($row = mysqli_fetch_assoc($result)) {
      $data[] = $row;
    }
  } else {
    // echo "<script>alert('Pesanan kosong, Silahkan Pesan dahulu');</script>";
    // echo "<script>location= 'menu_pembeli.php'</script>";
  }
  while ($row = mysqli_fetch_assoc($history)) {
    $dataHistory[] = $row;
  }
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            <a href="user.php" class="nav-item nav-link">Home</a>
            <a href="tentang.php" class="nav-item nav-link">About</a>
            <a href="menu_pembeli.php" class="nav-item nav-link">Daftar Menu</a>
            <a href="pesanan_pembeli.php" class="nav-item nav-link active">Pesanan Anda</a>
            <a href="logout.php" class="nav-item nav-link active">Logout</a>
          </ul>
      </nav>
    </div>
    <div class="container mt-0">
      <div class="judul-pesanan my-4">
        <h3 class="text-center font-weight-bold m-0">KERANJANG ANDA</h3>
      </div>
      <table class="table table-bordered" id="example">
        <thead class="thead-light">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Produk</th>
            <th scope="col">Harga</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Subharga</th>
            <th scope="col" class="text-center">Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php $nomor = 1; ?>
          <?php $totalbelanja = 0; ?>
          <?php foreach ($data as $d) : ?>
            <?php
            include('koneksi.php');
            $id_menu = $d['id_menu'];
            $jumlah = $d['jumlah'];
            $ambil = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_menu='$id_menu'");
            $pecah = $ambil->fetch_assoc();
            $subharga = $pecah["harga"] * $jumlah;
            ?>
            <tr>
              <td><?php echo $nomor; ?></td>
              <td><?php echo $pecah["nama_menu"]; ?></td>
              <td>Rp. <?php echo number_format($pecah["harga"]); ?></td>
              <td><?php echo $jumlah; ?></td>
              <td>Rp. <?php echo number_format($subharga); ?></td>
              <td class="text-center">
                <button onclick="hapusPesanan('<?= $d['id_pemesanan_produk'] ?>')" class="btn btn-sm btn-danger">Hapus</button>
                <button onclick="editPesanan('<?= $d['id_pemesanan_produk'] ?>','<?= $jumlah ?>')" class="btn btn-sm btn-primary">Edit</button>
              </td>
            </tr>
            <?php $nomor++; ?>
            <?php $totalbelanja += $subharga; ?>
          <?php endforeach ?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="4">Total Belanja</td>
            <td colspan="2">Rp. <?php echo number_format($totalbelanja) ?></td>
          </tr>
        </tfoot>
      </table><br>
      <a href="menu_pembeli.php" class="btn btn-primary btn-sm">Lihat Menu</a>
      <button class="btn btn-success btn-sm" onclick="order()">Konfirmasi Pesanan</button>
      <div class="judul-pesanan my-4">
        <h3 class="text-center font-weight-bold m-0">HISTORY PEMESANAN</h3>
      </div>
      <table class="table table-bordered" id="historyPesanan">
        <thead class="thead-light">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Id Pemesanan</th>
            <th scope="col">Tanggal Pemesanan</th>
            <th scope="col">Total</th>
            <th scope="col" class="text-center">Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php $nomor = 1; ?>
          <?php foreach ($dataHistory as $h) : ?>
            <tr>
              <td><?php echo $nomor; ?></td>
              <td><?php echo $h["id_pemesanan"]; ?></td>
              <td><?php echo $h["tanggal_pemesanan"]; ?></td>
              <td>Rp. <?php echo number_format($h["total_belanja"]); ?></td>
              <td class="text-center">
                <a class="btn btn-info btn-sm" href="detail_pesanan_pembeli.php?id=<?= $h['id_pemesanan'] ?>">Detail</a>
                <a class="btn btn-primary btn-sm" href="pemesanan/struk.php?id=<?= $h['id_pemesanan'] ?>" target="_blank">Print Struk</a>
              </td>
            </tr>
            <?php $nomor++ ?>
          <?php endforeach ?>
        </tbody>
      </table><br>
    </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="modalOrder">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Pesanan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="d-flex justify-content-between align-items-center">
                <label for="inputJumlah" class="text-nowrap mr-3 mb-0">Masukkan Jumlah</label>
                <div class="input-group" style="max-width: 200px;">
                  <div class="input-group-prepend">
                    <button onclick="decrement()" class="btn btn-success" type="button" id="button-addon1"><i class="fa-solid fa-minus"></i></button>
                  </div>
                  <input type="number" min="1" value="1" oninput="validity.valid||(value='');" class="form-control text-center" id="inputJumlah" placeholder="">
                  <div class="input-group-append">
                    <button onclick="increment()" class="btn btn-success" type="button" id="button-addon2"><i class="fa-solid fa-plus"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="footer-menyimpan" style="display: none;">
              <span>Menyimpan...</span>
            </div>
            <div class="footer-simpan">
              <button type="button" onclick="simpanOrder()" class="btn btn-primary">Simpan</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
      </div>
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
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script>
      $(document).ready(function() {
        $('#example').DataTable();
      });

      $(document).ready(function() {
        $('#historyPesanan').DataTable();
      });

      $('#modalOrder').on('hidden.bs.modal', function(e) {
        $('#modalOrder').data('id_pemesanan_produk', null)
        $('#inputJumlah').val(1)
      })

      function simpanOrder() {
        let id_pemesanan_produk = $('#modalOrder').data('id_pemesanan_produk')
        let jumlah = $('#inputJumlah').val()
        this.saveEdit(id_pemesanan_produk, jumlah)
      }

      function editPesanan(id_pemesanan_produk, jumlah) {
        $('#modalOrder').data('id_pemesanan_produk', id_pemesanan_produk)
        $('#inputJumlah').val(jumlah)
        $('#modalOrder').modal('show')
      }

      function saveEdit(id_pemesanan_produk, jumlah) {
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
          if (xhr.readyState == 4) {
            if (xhr.status == 200) {
              var response = JSON.parse(xhr.responseText);
              if (response.success) {
                alert(response.message)
                console.log("Success:", response.message);
                location.reload()
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

        let data = "id_pemesanan_produk=" + id_pemesanan_produk + "&jumlah=" + jumlah;

        xhr.open("POST", "pemesanan/save_edit_pesanan.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send(data);
      }

      function hapusPesanan(id_pemesanan_produk) {
        if (confirm('Hapus pesanan?')) {
          let xhr = new XMLHttpRequest();
          xhr.onreadystatechange = function() {
            if (xhr.readyState == 4) {
              if (xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                  alert(response.message)
                  console.log("Success:", response.message);
                  location.reload()
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

          let data = "id_pemesanan_produk=" + id_pemesanan_produk;

          xhr.open("POST", "pemesanan/hapus_pesanan.php", true);
          xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xhr.send(data);
        }
      }

      function increment() {
        var inputElement = $("#inputJumlah")
        var currentValue = parseInt(inputElement.val())
        console.log(currentValue)
        if (currentValue > 0) {
          inputElement.val(currentValue + 1)
        }
      }

      function decrement() {
        var inputElement = $("#inputJumlah")
        var currentValue = parseInt(inputElement.val())

        if (currentValue > 1) {
          inputElement.val(currentValue - 1)
        }
      }

      function order() {
        if (confirm('Konfirmasi pesanan?')) {
          let xhr = new XMLHttpRequest();
          xhr.onreadystatechange = function() {
            if (xhr.readyState == 4) {
              if (xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                  alert(response.message)
                  console.log("Success:", response.message);
                  location.reload()
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

          let data = "";

          xhr.open("POST", "pemesanan/konfirmasi_pesanan.php", true);
          xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xhr.send(data);
        }
      }
    </script>
  </body>

  </html>
<?php } ?>