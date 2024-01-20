<!DOCTYPE html>
<html>
  <head>
    <title>Struk Pembayaran D'Sugar</title>
    <style>
      body {
        font-family: Arial, sans-serif;
      }
      .container {
        width: 300px;
        margin: 0 auto;
      }
      .header {
        text-align: center;
        font-size: 24px;
        margin-bottom: 10px;
      }
      .content {
        border-top: 1px solid #000;
        border-bottom: 1px solid #000;
        padding: 10px 0;
      }
      .item {
        margin-bottom: 5px;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="header">Struk Pembayaran D'Sugar</div>
      <div class="content">
        <div class="item"><strong>Item:</strong> mochi</div>
        <div class="item"><strong>Jumlah:</strong> 2</div>
        <div class="item"><strong>Harga Satuan:</strong> Rp 20,000</div>
        <div class="item"><strong>Total:</strong> Rp 40,000</div>
      </div>
      <div class="content">
        <div class="item"><strong>Total Pembayaran:</strong> Rp 40,000</div>
        <div class="item"><strong>Metode Pembayaran:</strong> Tunai</div>
      </div>
      <div class="content">
        <div class="item">
          <strong>Tanggal:</strong> 16-10-2023
          <?php echo date('d/m/Y H:i:s'); ?>
        </div>
        <div class="item"><strong>Kasir:</strong> Tony Stark</div>
      </div>
    </div>
  </body>
</html>
