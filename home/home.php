<?php
require '../functions.php';
$penjualan = tampil("
    SELECT pembelian.id_pembelian, pembeli.nama_pembeli, pembeli.no_hp, pembeli.alamat,
           barang.nama_barang, barang.stok, pembelian.jml_beli, pembelian.total_harga, pembelian.tgl_pembelian
    FROM pembelian
    JOIN pembeli ON pembelian.id_pembeli = pembeli.id_pembeli
    JOIN barang ON pembelian.id_barang = barang.id_barang
    ORDER BY pembelian.tgl_pembelian DESC
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kasir - Penjualan</title>
  <style>
    body {
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #fde2e4, #f8bbd0);
      margin: 0;
      padding: 0;
    }
    .container {
      width: 95%;
      max-width: 1100px;
      margin: 40px auto;
      background: #fff;
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      color: #ad1457;
      margin-bottom: 25px;
      font-size: 26px;
      font-weight: 700;
    }
    .btn {
      padding: 10px 18px;
      border-radius: 10px;
      text-decoration: none;
      font-size: 14px;
      font-weight: 600;
      transition: 0.3s;
      display: inline-block;
    }
    .btn:hover {
      opacity: 0.9;
      transform: scale(1.05);
    }
    .btn-tambah {
      background: #ec407a;
      color: #fff;
      margin-bottom: 15px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 3px 8px rgba(0,0,0,0.05);
    }
    table th, table td {
      padding: 14px 12px;
      text-align: center;
      font-size: 14px;
    }
    table th {
      background: #f06292;
      color: #fff;
      text-transform: uppercase;
      font-size: 14px;
      letter-spacing: 0.5px;
    }
    tr:nth-child(even) { background: #fde2e4; }
    tr:nth-child(odd) { background: #ffffff; }
    tr:hover { background: #f8bbd0; transition: 0.2s; }
  </style>
</head>
<body>
<?php include '../navbar.php'; ?>
<div class="container">
  <h2>💰 Data Penjualan</h2>
  <a href="tambah_penjualan.php" class="btn btn-tambah">+ Tambah Penjualan</a>  
  <table>
    <tr>
      <th>ID</th>
      <th>Pembeli</th>
      <th>No HP</th>
      <th>Alamat</th>
      <th>Barang</th>
      <th>Stok</th>
      <th>Jumlah Beli</th>
      <th>Total Harga</th>
      <th>Tanggal</th>
    </tr>
    <?php foreach ($penjualan as $row): ?>
    <tr>
      <td><?= $row['id_pembelian']; ?></td>
      <td><?= $row['nama_pembeli']; ?></td>
      <td><?= $row['no_hp']; ?></td>
      <td><?= $row['alamat']; ?></td>
      <td><?= $row['nama_barang']; ?></td>
      <td><?= $row['stok']; ?></td>
      <td><?= $row['jml_beli']; ?></td>
      <td>Rp <?= number_format($row['total_harga'], 0, ',', '.'); ?></td>
      <td><?= $row['tgl_pembelian']; ?></td>
    </tr>
    <?php endforeach; ?>
  </table>
</div>
</body>
</html>