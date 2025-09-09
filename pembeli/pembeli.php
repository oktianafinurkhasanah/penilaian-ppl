<?php
require '../functions.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Pembeli</title>
  <style>
    body {
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #fde2e4, #f8bbd0);
      margin: 0;
      padding: 0;
      color: #4a2c2a;
    }
    .container {
      width: 90%;
      margin: 30px auto;
      background: white;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 6px 18px rgba(0,0,0,0.1);
    }
    h2 {
      margin-bottom: 20px;
      color: #ad1457;
      text-align: center;
      font-size: 24px;
      font-weight: 700;
    }
    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      flex-wrap: wrap;
      gap: 10px;
    }
    .top-bar form {
      display: flex;
      gap: 8px;
    }
    .top-bar form input {
      padding: 10px 12px;
      width: 220px;
      border: 1px solid #f48fb1;
      border-radius: 8px;
      font-size: 14px;
      transition: 0.3s;
    }
    .top-bar form input:focus {
      border-color: #ad1457;
      outline: none;
      box-shadow: 0 0 6px rgba(173, 20, 87, 0.4);
    }
    .top-bar form button {
      padding: 10px 15px;
      border: none;
      background: #ec407a;
      color: white;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 600;
      transition: 0.3s;
    }
    .top-bar form button:hover {
      background: #ad1457;
      transform: scale(1.05);
    }
    .top-bar a {
      background: #f06292;
      color: white;
      padding: 10px 18px;
      border-radius: 8px;
      text-decoration: none;
      font-size: 14px;
      font-weight: 600;
      transition: 0.3s;
    }
    .top-bar a:hover {
      background: #ad1457;
      transform: scale(1.07);
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
      border-radius: 10px;
      overflow: hidden;
    }
    table th, table td {
      padding: 12px;
      text-align: center;
      font-size: 14px;
    }
    table th {
      background: #f06292;
      color: white;
      font-size: 15px;
      text-transform: uppercase;
    }
    table tr:nth-child(even) {
      background: #fde2e4;
    }
    table tr:nth-child(odd) {
      background: #ffffff;
    }
    table tr:hover {
      background: #f8bbd0;
      transition: 0.2s;
    }
    .btn-detail {
      background: #ec407a;
      color: white;
      padding: 6px 12px;
      border-radius: 6px;
      text-decoration: none;
      font-size: 13px;
      font-weight: 600;
      transition: 0.3s;
    }
    .btn-detail:hover {
      background: #ad1457;
      transform: scale(1.1);
    }
  </style>
</head>
<body>
<?php include '../navbar.php'; ?>
<div class="container">
  <h2>👥 Data Pembeli</h2>
  <div class="top-bar">
    <form method="GET" action="">
      <input type="text" name="cari" placeholder="🔍 Cari pembeli..." value="<?= isset($_GET['cari']) ? $_GET['cari'] : '' ?>">
      <button type="submit">Cari</button>
    </form>
    <a href="tambah_pembeli.php">+ Tambah Pembeli</a>
  </div>
  <?php
  if (isset($_GET['cari']) && $_GET['cari'] != '') {
      $cari = $_GET['cari'];
      $pembeli = tampil("SELECT * FROM pembeli WHERE nama_pembeli LIKE '%$cari%' OR alamat LIKE '%$cari%' OR no_hp LIKE '%$cari%'");
  } else {
      $pembeli = tampil("SELECT * FROM pembeli");
  }
  ?>
  <table>
    <tr>
      <th>ID</th>
      <th>Nama Pembeli</th>
      <th>Alamat</th>
      <th>No HP</th>
      <th>Aksi</th>
    </tr>
    <?php if(count($pembeli) > 0): ?>
      <?php foreach ($pembeli as $row): ?>
      <tr>
        <td><?= $row['id_pembeli']; ?></td>
        <td><?= $row['nama_pembeli']; ?></td>
        <td><?= $row['alamat']; ?></td>
        <td><?= $row['no_hp']; ?></td>
        <td><a href="detail_pembeli.php?id=<?= $row['id_pembeli']; ?>" class="btn-detail">Detail</a></td>
      </tr>
      <?php endforeach; ?>
    <?php else: ?>
      <tr>
        <td colspan="5">❌ Tidak ada data pembeli</td>
      </tr>
    <?php endif; ?>
  </table>
</div>
</body>
</html>