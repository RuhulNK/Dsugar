
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  </head>
  <body>
    <h1>Form Input Data</h1>
    <form action="tampil_input_siswa.php" method="POST">
      <table>
        <tr>
          <td>id_pemesanan</td>
          <td>:</td>
          <td><input type="text" name="id_pemesanan" required /></td>
        </tr>
        <tr>
          <td>tanggal_pemesanan</td>
          <td>:</td>
          <td><input type="text" name="tanggal_pemesanan" required /></td>
        </tr>
        <tr>
          <td>total_belanja</td>
          <td>:</td>
          <td><input type="text" name="total_belanja" required /></td>
        </tr>
        <tr>
          <td>
            <button type="submit" name="submit" value="simpan">Submit</button>
          </td>
        </tr>
      </table>
    </form>
  </body>
</html>
