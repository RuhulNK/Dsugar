<?php 
include 'koneksi.php';
?>

<!doctype html>
<html lang="en">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"> -->

    <title>Verifikasi</title>
  </head>
  <body>
  <!-- Form Login -->
    <div class="container">
      <h4 class="text-center">Verifikasi Registrasi Admin</h4>
      <hr>
      <form method="POST" action="">
        <div class="form-group">
          <label for="exampleInputEmail1">Kode Verifikasi</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-user"></i></div>
              </div>
              <input type="password" class="form-control" placeholder="Masukkan Kode Verifikasi" name="PassKode">
            </div>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Masukkan Kembali Kode Verifikasi</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-unlock-alt"></i></div>
              </div>
              <input type="password" class="form-control" placeholder="Masukkan Kode Verifikasi" name="PassKode">
          </div>
        </div>
        
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        <button type="reset" name="reset" class="btn btn-danger">RESET</button>
        <br></br>
        <a href="index.php" class="btn btn-secondary" name="Kembali">Kembali</a>

      </form>
  <!-- Akhir Form Login -->

  <!-- Eksekusi Form Login -->
      <?php 
        if(isset($_POST['submit'])) {
          $PK = $_POST['PassKode'];
		

          // Query untuk memilih tabel
          $cek_data = mysqli_query($koneksi, "SELECT * FROM passadmin WHERE PassKode = '$PK'");
          $hasil = mysqli_fetch_array($cek_data);
          $status = $hasil['PassKode'];
          $login_user = $hasil['username'];
          $row = mysqli_num_rows($cek_data);

          // Pengecekan Kondisi Login Berhasil/Tidak
            if ($status == '123567890') {
				header('location: reg_admin.php');
			}else{
                header('location: index.php'); 
				}
        }
       ?>
    </div>
  <!-- Akhir Eksekusi Form Login -->







    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
  </body>
</html>