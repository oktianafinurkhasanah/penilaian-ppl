<?php
session_start();
require '../auth.php';
require '../functions.php';
checkAccess(['Gudang','Admin','Kasir']); // tambahkan Kasir juga

if (isset($_GET['cari']) && $_GET['cari'] != '') {
    $cari = $_GET['cari'];
    $barang = tampil("SELECT * FROM barang WHERE nama_barang LIKE '%$cari%'");
} else {
    $barang = tampil("SELECT * FROM barang");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Barang</title>
<style>
body {
  font-family: Segoe UI, sans-serif;
  background: linear-gradient(135deg,#fde2e4,#f8bbd0);
  margin: 0;
}
.container {
  width: 95%; max-width: 1000px; margin: 40px auto;
  background: #fff; padding: 25px; border-radius: 12px;
  box-shadow: 0 6px 20px rgba(0,0,0,.1);
}
h2 { text-align: center; color:#ad1457; margin-bottom: 20px; }
.top-bar {
  display:flex; justify-content:space-between; flex-wrap:wrap;
  gap:10px; margin-bottom:20px;
}
.top-bar input {
  padding:8px 12px; border:1px solid #f48fb1; border-radius:6px;
}
.top-bar button, .top-bar a, .btn {
  padding:8px 14px; border:none; border-radius:6px;
  color:#fff; background:#ec407a; cursor:pointer;
  text-decoration:none; font-size:13px; font-weight:600;
  transition:.3s;
}
.top-bar button:hover, .top-bar a:hover, .btn:hover {
  background:#ad1457; transform:scale(1.05);
}
table { width:100%; border-collapse:collapse; margin-top:10px; }
th,td { padding:12px; text-align:center; font-size:14px; }
th { background:#f06292; color:#fff; }
tr:nth-child(even){background:#fde2e4}
tr:nth-child(odd){background:#fff}
tr:hover{background:#f8bbd0}
img {
  width:70px; height:70px; object-fit:cover;
  border-radius:8px; border:2px solid #f48fb1;
}
.actions { display:flex; gap:6px; justify-content:center; }
</style>
</head>
<body>
<?php include '../navbar.php'; ?>
<div class="container">
  <h2>📦 Data Barang</h2>
  <div class="top-bar">
    <form method="GET">
      <input type="text" name="cari" placeholder="🔍 Cari barang..." value="<?= $_GET['cari']??'' ?>">
      <button type="submit">Cari</button>
    </form>
    <?php if ($_SESSION['role'] === 'Gudang' || $_SESSION['role'] === 'Admin'): ?>
      <a href="tambah_barang.php">+ Tambah Barang</a>
    <?php endif; ?>
  </div>
  <table>
    <tr><th>ID</th><th>Nama</th><th>Stok</th><th>Harga</th><th>Gambar</th><th>Aksi</th></tr>
    <?php if($barang): foreach($barang as $row): ?>
    <tr>
      <td><?= $row['id_barang']; ?></td>
      <td><?= $row['nama_barang']; ?></td>
      <td><?= $row['stok']; ?></td>
      <td>Rp <?= number_format($row['harga'],0,',','.'); ?></td>
      <td><img src="../img/<?= $row['gambar']; ?>" alt=""></td>
      <td class="actions">
        <a href="detail_barang.php?id=<?= $row['id_barang']; ?>" class="btn">Detail</a>
        <?php if ($_SESSION['role'] === 'Gudang' || $_SESSION['role'] === 'Admin'): ?>
          <a href="edit.php?id=<?= $row['id_barang']; ?>" class="btn">Edit</a>
        <?php endif; ?>
      </td>
    </tr>
    <?php endforeach; else: ?>
    <tr><td colspan="6">❌ Tidak ada data barang</td></tr>
    <?php endif; ?>
  </table>
</div>
</body>
</html>
