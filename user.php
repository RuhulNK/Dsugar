<?php 
    session_start();
      if(!isset($_SESSION['login_user'])) {
        header("location: index.php");
      }else{
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
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
      crossorigin="anonymous"
    />
    <script
      src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
      integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
      integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
      integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
      crossorigin="anonymous"
    ></script>

    <!-- bootstrap link -->
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Kanit&display=swap"
      rel="stylesheet"
    />

    <!-- font -->
  </head>

  <body>
    <div id="cantainer-background">
      <nav class="navbar navbar-expand-md" id="navbar-color">
        <!-- Brand -->
        <a class="navbar-brand" href="#" id="logo-color"
          ><i><img src="./icon/logo.png.png" alt="" /></i>D'Sugar</a
        >
        <!-- Toggler/collapsibe Button -->
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#collapsibleNavbar"
        >
          <span
            ><i><img src="./icon/menu.png" alt="" id="menu-color" /></i
          ></span>
        </button>
 <!-- Navbar links -->
 <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <a href="user.php" class="nav-item nav-link active">Home</a>
      <a href="tentang.php" class="nav-item nav-link">About</a>
      <a href="menu_pembeli.php" class="nav-item nav-link">Daftar Menu</a>
      <a href="pesanan_pembeli.php" class="nav-item nav-link active">Pesanan Anda</a>
      <a href="logout.php" class="nav-item nav-link active">Logout</a>

    </ul>
  </div>
</nav>
      <div class="main-content">
        <div class="content">
          <h1>Toko</h1>
          <h2>D'Sugar</h2>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="best-card">
        <div class="row" style="margin-top: 100px">
          <div class="col-md-4 py-3 py-md-0">
            <div class="card">
              <img
                class="card-image-top"
                src="./images/escim.jpg.jpeg"
                alt=""
              />
              <div class="card-img-overlay">
                <h1 class="card-titel">ice cream</h1>
                <p class="card-text">Salah satu menu terbaik kami.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 py-3 py-md-0">
            <div class="card">
              <img
                class="card-image-top"
                src="./images/mashmelo.jpg.jpeg"
                alt=""
              />
              <div class="card-img-overlay">
                <h1 class="card-titel">marshmallow</h1>
                <p class="card-text">Salah satu menu terbaik kami.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 py-3 py-md-0">
            <div class="card">
              <img
                class="card-image-top"
                src="./images/macarone.jpg.jpeg"
                alt=""
              />
              <div class="card-img-overlay">
                <h1 class="card-titel">macaron</h1>
                <p class="card-text">Salah satu menu terbaik kami.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    

    <!-- new card -->

    <div class="container">
      <div class="card-content">
        <div class="row">
          <div class="col-md-6 py-3 py-md-0">
            <h1>Toko</h1>
            <h1>D'Sugar</h1>
            <p align="justify">
                Toko D'Sugar dibuat pada tahun 2023, yang berada di Purbalingga.
                Toko ini dibuat oleh 3 orang yaitu Ruhul Nur Kholif,
                Vivi Indriyani Mufti Afifah, dan Driono Purnomo.
                Toko kami menyediakan berbagai macam menu, dengan rasa yang enak
                dan harga yang terjangkau untuk kalangan pelajar.
                Kami juga menyediakan makanan dalam bentuk less sugar,
                sehingga, tidak masalah bagi anda yang memiliki diabetes.
            </p>
          </div>
          <div class="col-md-6 py-3 py-md-0">
            <div class="card">
              <img
                class="card-image-top"
                src="./images/cafe.jpg"
                alt=""
              />
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="banner">
        <h1>Produk kami: <span class="change-content"></span></h1>
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
    </body>
  </html>
<?php } ?>
