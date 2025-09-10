<?php
session_start();
require '../functions.php'; 

if (!isset($_SESSION['id_user'])) {
    header("Location: ../login/");
    exit;
}
if (isset($_POST['simpan'])) {
    if (tambahPembeli($_POST)) {
        echo "<script>
                alert('✅ Data pembeli berhasil ditambahkan!');
                window.location.href='pembeli.php';
              </script>";
    } else {
        echo "<script>
                alert('❌ Gagal menambahkan data!');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Pembeli</title>
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
      max-width: 500px;
      margin: 40px auto;
      background: white;
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    h2 {
      text-align: center;
      color: #ad1457;
      margin-bottom: 25px;
      font-size: 24px;
      font-weight: 700;
    }
    form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }
    input, textarea {
      padding: 12px;
      border: 1px solid #f48fb1;
      border-radius: 8px;
      font-size: 14px;
      transition: 0.3s;
    }
    input:focus, textarea:focus {
      border-color: #ad1457;
      outline: none;
      box-shadow: 0 0 6px rgba(173, 20, 87, 0.4);
    }
    button {
      padding: 12px;
      border: none;
      background: #ec407a;
      color: white;
      border-radius: 8px;
      cursor: pointer;
      font-size: 15px;
      font-weight: 600;
      transition: 0.3s;
    }
    button:hover {
      background: #ad1457;
      transform: scale(1.05);
    }
    .back {
      display: block;
      margin-top: 15px;
      text-align: center;
      text-decoration: none;
      color: #ec407a;
      font-size: 14px;
      font-weight: 600;
      transition: 0.3s;
    }
    .back:hover {
      color: #ad1457;
    }
  </style>
</head>
<body>
<?php include '../navbar.php'; ?>
<div class="container">
  <h2>➕ Tambah Pembeli</h2>
  <form method="POST" action="">
    <input type="text" name="nama_pembeli" placeholder="Nama Pembeli" required>
    <textarea name="alamat" placeholder="Alamat" required></textarea>
    <input type="text" name="no_hp" placeholder="No HP" required>
    <button type="submit" name="simpan">Simpan</button>
  </form>
  <a href="pembeli.php" class="back">⬅ Kembali ke Data Pembeli</a>
</div>
</body>
</html>