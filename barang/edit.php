<?php

session_start();
require '../auth.php';
require '../functions.php';
checkAccess(['Gudang','Admin','Kasir']);

if (!isset($_SESSION['id_user'])) {
    header("Location: ../login/");
    exit;
}
if (!isset($_GET['id'])) {
    header("Location: barang.php");
    exit;
}

$id = (int)$_GET['id'];
$barang = tampil("SELECT * FROM barang WHERE id_barang = $id");
if (!$barang) {
    echo "<script>alert('Barang tidak ditemukan');window.location='barang.php';</script>";
    exit;
}
$data = $barang[0];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $tambah = (int)$_POST['tambah_stok'];
    $stokBaru = $data['stok'] + $tambah;

    // cukup update barang, trigger akan otomatis catat log
    $query = "UPDATE barang SET stok = $stokBaru WHERE id_barang = $id";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Stok berhasil diperbarui');window.location='barang.php';</script>";
    } else {
        echo "<script>alert('Gagal update stok');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Stok Barang</title>
<style>
  body {
    font-family: "Segoe UI", sans-serif;
    background: linear-gradient(135deg, #fde2e4, #f8bbd0);
    margin: 0;
  }
  .box {
    width: 420px;
    margin: 60px auto;
    background: #fff;
    padding: 25px;
    border-radius: 14px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
  }
  h2 {
    text-align: center;
    color: #ad1457;
    margin-bottom: 20px;
  }
  label {
    font-weight: bold;
    color: #ad1457;
    display: block;
    margin-top: 12px;
  }
  input {
    width: 100%;
    padding: 10px;
    margin-top: 6px;
    border: 1px solid #f48fb1;
    border-radius: 8px;
    box-sizing: border-box;
  }
  .actions {
    margin-top: 20px;
    display: flex;
    justify-content: space-between;
  }
  button, a {
    padding: 10px 16px;
    border: none;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    color: #fff;
    cursor: pointer;
    transition: 0.3s;
  }
  button {
    background: #ec407a;
  }
  button:hover {
    background: #ad1457;
  }
  a {
    background: #888;
    text-align: center;
  }
  a:hover {
    background: #555;
  }
</style>
</head>
<body>
<div class="box">
  <h2>➕ Tambah Stok</h2>
  <form method="POST">
    <label>Nama Barang</label>
    <input type="text" value="<?= $data['nama_barang']; ?>" readonly>
    <label>Stok Sekarang</label>
    <input type="text" value="<?= $data['stok']; ?>" readonly>
    <label>Tambah Stok</label>
    <input type="number" name="tambah_stok" value="0" min="1" required>
    <div class="actions">
      <button type="submit">💾 Simpan</button>
      <a href="barang.php">⬅ Kembali</a>
    </div>
  </form>
</div>
</body>
</html>
