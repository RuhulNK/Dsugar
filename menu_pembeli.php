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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- font -->
    <style>
      /* Chrome, Safari, Edge, Opera */
      input::-webkit-outer-spin-button,
      input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
      }

      /* Firefox */
      input[type=number] {
        -moz-appearance: textfield;
      }
    </style>
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
            <a href="menu_pembeli.php" class="nav-item nav-link active">Daftar Menu</a>
            <a href="pesanan_pembeli.php" class="nav-item nav-link">Pesanan Anda</a>
            <a href="logout.php" class="nav-item nav-link active">Logout</a>
          </ul>
      </nav>
    </div>
    <div class="container mt-0">
      <h3 class="text-center my-4" style="font-weight: bold;">
        DAFTAR MENU
      </h3>
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
                <label class="card-text harga">Stok: <?php echo number_format($result['stok']); ?></label><br>
                <label class="card-text harga">Rp. <?php echo number_format($result['harga']); ?></label><br>
                <button class="btn btn-success btn-sm btn-block" onclick="order('<?= $result['id_menu'] ?>')">BELI</button>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="modalOrder">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Pesanan</h5>
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
              &copy; Website <strong>D'Sugar</strong>. Dibuat Oleh
              Ruhul Nur Kholif, Vivi Indriyani Mufti Afifah, dan Driono Purnomo
            </div>
          </div>
        </div>
      </div>
    </footer>
  </body>

  <script>
    var id_menu = null

    $('#modalOrder').on('hidden.bs.modal', function(e) {
      $('#modalOrder').data('id_menu', null)
      $('#inputJumlah').val(1)
      $('.footer-menyimpan').hide()
      $('.footer-simpan').show()
    })

    function order(id_menu) {
      $('#modalOrder').data('id_menu', id_menu)
      $('#modalOrder').modal('show')
    }

    function simpanOrder() {
      id_menu = $('#modalOrder').data('id_menu')
      let jumlah = $('#inputJumlah').val()
      if (jumlah) {
        this.makeRequest(id_menu, jumlah)
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

    function makeRequest(id_menu, jumlah) {
      $('.footer-menyimpan').show()
      $('.footer-simpan').hide()
      let xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
          if (xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
              alert(response.message)
              console.log("Success:", response.message);
              $('#modalOrder').modal('hide')
              location.reload()
            } else {
              alert(response.message)
              console.error("Error:", response.message);
              $('#modalOrder').modal('hide')
            }
          } else {
            alert(xhr.status)
            console.error("Request failed with status:", xhr.status);
            $('#modalOrder').modal('hide')
          }
        }
      };

      let data = "id_menu=" + id_menu + "&jumlah=" + jumlah;

      xhr.open("POST", "pemesanan/tambah_pesanan.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.send(data);
    }
  </script>

  </html>
<?php } ?>