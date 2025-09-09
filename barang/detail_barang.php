<?php
require '../functions.php';
if (!isset($_GET['id'])) {
  echo "<script>alert('Barang tidak ditemukan!');location.href='barang.php';</script>"; exit;
}
$id = (int)$_GET['id'];
$barang = tampil("SELECT * FROM barang WHERE id_barang=$id");
if (!$barang) {
  echo "<script>alert('Barang tidak ditemukan di database!');location.href='barang.php';</script>"; exit;
}
$barang = $barang[0];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Barang</title>
  <style>
  body {
    font-family: Segoe UI, sans-serif;
    background: linear-gradient(135deg,#fde2e4,#f8bbd0);
    margin: 0;
  }
  .container {
    width: 600px; margin: 60px auto; background: #fff;
    padding: 30px; border-radius: 14px;
    box-shadow: 0 6px 15px rgba(0,0,0,.1);
  }
  h2 {
    text-align: center; margin-bottom: 25px;
    color: #ad1457; font-size: 22px;
  }
  .detail {
    display: flex; gap: 24px; align-items: flex-start;
  }
  .detail img {
    width: 200px; height: 200px; object-fit: cover;
    border-radius: 12px; border: 2px solid #f48fb1;
  }
  .info p { margin: 10px 0; font-size: 15px; color: #444; }
  .info span { font-weight: bold; color: #ad1457; }
  .actions {
    margin-top: 25px; display: flex; justify-content: space-between;
  }
  .btn {
    padding: 10px 16px; border-radius: 8px; text-decoration: none;
    font-size: 14px; font-weight: 600; color: #fff; transition: .3s;
  }
  .btn-back { background:#ec407a; }
  .btn-back:hover { background:#ad1457; }
  .btn-delete { background:#f06292; }
  .btn-delete:hover { background:#c2185b; }
  </style>
</head>
<body>
<?php include '../navbar.php'; ?>
<div class="container">
  <h2>📋 Detail Barang</h2>
  <div class="detail">
    <img src="../img/<?= $barang['gambar']; ?>" alt="<?= $barang['nama_barang']; ?>">
    <div class="info">
      <p><span>ID:</span> <?= $barang['id_barang']; ?></p>
      <p><span>Nama:</span> <?= $barang['nama_barang']; ?></p>
      <p><span>Stok:</span> <?= $barang['stok']; ?></p>
      <p><span>Harga:</span> Rp <?= number_format($barang['harga'],0,',','.'); ?></p>
    </div>
  </div>
  <div class="actions">
    <a href="barang.php" class="btn btn-back">⬅ Kembali</a>
    <a href="hapus.php?id=<?= $barang['id_barang']; ?>" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus barang ini?')">🗑️ Hapus</a>
  </div>
</div>
</body>
</html>
