<?php
require '../functions.php';
if (!isset($_GET['id'])) {
    header("Location: pembeli.php");
    exit;
}
$id = (int)$_GET['id'];
$pembeli = tampil("SELECT * FROM pembeli WHERE id_pembeli = $id");
if (!$pembeli) {
    echo "<script>alert('Data pembeli tidak ditemukan'); window.location='pembeli.php';</script>";
    exit;
}
$pembeli = $pembeli[0];
$transaksi = tampil("
    SELECT p.id_pembelian, p.jml_beli, p.total_harga, p.tgl_pembelian,
           b.nama_barang, b.harga
    FROM pembelian p
    JOIN barang b ON p.id_barang = b.id_barang
    WHERE p.id_pembeli = $id
    ORDER BY p.tgl_pembelian DESC
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Pembeli</title>
  <style>
    body {
      font-family: "Segoe UI", Tahoma, sans-serif;
      background: linear-gradient(135deg, #fde2e4, #f8bbd0);
      margin: 0; padding: 0; color: #4a2c2a;
    }
    .container {
      width: 90%; max-width: 1000px; margin: 30px auto;
      background: #fff; padding: 25px;
      border-radius: 14px; box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center; color: #ad1457; margin-bottom: 25px;
    }
    .info-box {
      background: #fde2e4; padding: 18px;
      border-radius: 10px; margin-bottom: 25px;
    }
    .info-box p { margin: 8px 0; font-size: 15px; }
    .info-box strong { color: #ad1457; }
    .action-bar {
      margin-top: 15px; display: flex; gap: 12px;
    }
    .btn {
      padding: 8px 14px; border-radius: 8px;
      text-decoration: none; font-size: 14px;
      font-weight: 600; color: white; transition: 0.3s;
    }
    .btn-edit { background: #ff9800; }
    .btn-edit:hover { background: #e68900; }
    .btn-delete { background: #e53935; }
    .btn-delete:hover { background: #c62828; }
    .btn-back { background: #ec407a; }
    .btn-back:hover { background: #ad1457; }
    table {
      width: 100%; border-collapse: collapse; margin-top: 10px;
      border-radius: 10px; overflow: hidden;
    }
    table th, table td {
      padding: 12px; text-align: center; font-size: 14px;
    }
    table th {
      background: #f06292; color: white; text-transform: uppercase;
    }
    table tr:nth-child(even) { background: #fde2e4; }
    table tr:nth-child(odd) { background: #fff; }
    table tr:hover { background: #f8bbd0; }
    .btn-small {
      padding: 5px 10px; font-size: 12px; border-radius: 6px;
      color: white; text-decoration: none; font-weight: 600;
    }
    .btn-small.delete { background: #e53935; }
    .btn-small.delete:hover { background: #c62828; }
  </style>
</head>
<body>
<?php include '../navbar.php'; ?>
<div class="container">
  <h2>👩‍💼 Detail Pembeli</h2>
  <div class="info-box">
    <p><strong>ID Pembeli:</strong> <?= $pembeli['id_pembeli']; ?></p>
    <p><strong>Nama:</strong> <?= $pembeli['nama_pembeli']; ?></p>
    <p><strong>Alamat:</strong> <?= $pembeli['alamat']; ?></p>
    <p><strong>No HP:</strong> <?= $pembeli['no_hp']; ?></p>
    <div class="action-bar">
      <a href="edit_pembeli.php?id=<?= $pembeli['id_pembeli']; ?>" class="btn btn-edit">✏ Edit Pembeli</a>
      <a href="hapus_pembeli.php?id=<?= $pembeli['id_pembeli']; ?>" class="btn btn-delete" onclick="return confirm('Hapus pembeli ini beserta semua transaksinya?');">🗑 Hapus Pembeli</a>
    </div>
  </div>
  <h3 style="color:#ad1457; margin-bottom:10px;">🧾 Riwayat Transaksi</h3>
  <?php if(count($transaksi) > 0): ?>
    <table>
      <tr>
        <th>ID Pembelian</th>
        <th>Nama Barang</th>
        <th>Harga Satuan</th>
        <th>Jumlah</th>
        <th>Total Harga</th>
        <th>Tanggal</th>
        <th>Aksi</th>
      </tr>
      <?php foreach ($transaksi as $row): ?>
      <tr>
        <td><?= $row['id_pembelian']; ?></td>
        <td><?= $row['nama_barang']; ?></td>
        <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
        <td><?= $row['jml_beli']; ?></td>
        <td>Rp <?= number_format($row['total_harga'], 0, ',', '.'); ?></td>
        <td><?= $row['tgl_pembelian']; ?></td>
        <td><a href="hapus_transaksi.php?id=<?= $row['id_pembelian']; ?>&pembeli=<?= $pembeli['id_pembeli']; ?>" class="btn-small delete" onclick="return confirm('Hapus transaksi ini?');">🗑 Hapus</a></td>
      </tr>
      <?php endforeach; ?>
    </table>
  <?php else: ?>
    <p style="text-align:center; color:#888;">❌ Belum ada transaksi</p>
  <?php endif; ?>
  <a href="pembeli.php" class="btn btn-back">⬅ Kembali</a>
</div>
</body>
</html>