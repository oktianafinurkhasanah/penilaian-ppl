<?php 
session_start();
require '../auth.php';
require '../functions.php';
checkAccess(['Gudang','Admin']); // hanya Gudang & Admin yang bisa tambah

// proses tambah barang
if (isset($_POST['submit'])) {
    $nama_barang = htmlspecialchars($_POST['nama_barang']);
    $stok        = (int) $_POST['stok'];
    $harga       = (int) $_POST['harga'];
    $gambar      = htmlspecialchars($_POST['gambar']);

    $query = "INSERT INTO barang (nama_barang, stok, harga, gambar)
              VALUES ('$nama_barang', '$stok', '$harga', '$gambar')";
    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('✅ Barang berhasil ditambahkan!');
                document.location.href = 'barang.php';
              </script>";
    } else {
        $error = mysqli_error($conn);
        echo "<script>
                alert('❌ Gagal menambahkan barang: $error');
              </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Barang</title>
  <style>
  body {
    font-family: Segoe UI, sans-serif;
    background: linear-gradient(135deg,#fde2e4,#f8bbd0);
    margin: 0; color: #4a2c2a;
  }
  .container {
    width: 500px; margin: 70px auto; background: #fff;
    padding: 40px; border-radius: 18px;
    box-shadow: 0 6px 20px rgba(0,0,0,.1);
  }
  h2 {
    text-align: center; margin-bottom: 30px;
    color: #ad1457; font-size: 24px; font-weight: 700;
  }
  form { display: flex; flex-direction: column; gap: 20px; }
  label {
    font-size: 15px; font-weight: 600; margin-bottom: 6px;
    display: block; color: #4a2c2a;
  }
  input {
    width: 100%; padding: 12px 14px; font-size: 15px;
    border: 1px solid #f48fb1; border-radius: 10px;
    transition: .3s;
  }
  input:focus {
    border-color: #ec407a; outline: none;
    box-shadow: 0 0 6px rgba(236,64,122,.3);
  }
  button {
    padding: 14px; border: none; border-radius: 10px;
    background: #ec407a; color: #fff; font-size: 16px;
    font-weight: 600; cursor: pointer; transition: .3s;
  }
  button:hover { background: #ad1457; transform: scale(1.03); }
  .back {
    display:block; margin-top: 20px; text-align:center;
    text-decoration:none; color:#ec407a; font-weight:600;
    transition:.3s;
  }
  .back:hover { color:#ad1457; text-decoration:underline; }
  </style>
</head>
<body>
<?php include '../navbar.php'; ?>
<div class="container">
  <h2>➕ Tambah Barang</h2>
  <form action="" method="POST">
    <div>
      <label for="nama_barang">Nama Barang</label>
      <input type="text" name="nama_barang" id="nama_barang" required>
    </div>
    <div>
      <label for="stok">Stok</label>
      <input type="number" name="stok" id="stok" required>
    </div>
    <div>
      <label for="harga">Harga</label>
      <input type="number" name="harga" id="harga" required>
    </div>
    <div>
      <label for="gambar">Gambar</label>
      <input type="text" name="gambar" id="gambar">
    </div>
    <button type="submit" name="submit">Tambah Barang</button>
  </form>
  <a href="barang.php" class="back">← Kembali ke Data Barang</a>
</div>
</body>
</html>
