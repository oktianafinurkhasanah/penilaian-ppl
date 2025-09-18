<?php
session_start();
require '../functions.php';
require '../auth.php';
checkAccess(['Owner','Kasir','Admin']);

$barang = tampil("SELECT * FROM barang");

// Proses simpan
if (isset($_POST['simpan'])) {   
    $id_pembeli = null;

    $nama_pembeli = trim($_POST['nama_pembeli']);
    $alamat       = trim($_POST['alamat']);
    $no_hp        = trim($_POST['no_hp']);
    $id_barang    = (int)$_POST['id_barang'];
    $jml_beli     = (int)$_POST['jml_beli'];

    if ($nama_pembeli && $alamat && $no_hp && $id_barang && $jml_beli > 0) {
        // Tambah pembeli
        mysqli_query($conn, "INSERT INTO pembeli (nama_pembeli, alamat, no_hp) 
                             VALUES ('$nama_pembeli', '$alamat', '$no_hp')");
        $id_pembeli = mysqli_insert_id($conn);

        // Cek stok
        $cekBarang = mysqli_query($conn, "SELECT stok FROM barang WHERE id_barang=$id_barang");
        $rowBarang = mysqli_fetch_assoc($cekBarang);

        if ($rowBarang && $rowBarang['stok'] >= $jml_beli) {
            $data = [
                "id_pembeli" => $id_pembeli,
                "id_barang"  => $id_barang,
                "jml_beli"   => $jml_beli
            ];
            if (tambahPembelian($data)) {
                $_SESSION['msg'] = "✅ Pembelian berhasil ditambahkan!";
                header("Location: home.php");
                exit;
            } else {
                $error = "Gagal menambahkan pembelian!";
            }
        } else {
            $error = "⚠ Jumlah beli melebihi stok!";
        }
    } else {
        $error = "⚠ Data pembeli dan barang harus lengkap!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Pembelian</title>
  <style>
   body { font-family: Arial, sans-serif; background: #fde2e4; }
   .container {
     width: 600px; margin: 40px auto; background: #fff;
     padding: 25px; border-radius: 12px;
     box-shadow: 0 6px 15px rgba(0,0,0,0.1);
   }
   h2 { text-align: center; color: #ad1457; margin-bottom: 20px; }
   label { display: block; margin-bottom: 5px; font-weight: bold; color: #ad1457; }
   input, select, textarea {
     width: 100%; padding: 10px; margin-bottom: 15px;
     border: 1px solid #f48fb1; border-radius: 8px;
   }
   input:focus, select:focus, textarea:focus {
     border-color: #ad1457; outline: none;
     box-shadow: 0 0 6px rgba(173,20,87,0.4);
   }
   button {
     background: #ec407a; color: white; padding: 10px 20px;
     border: none; border-radius: 8px; cursor: pointer;
     transition: 0.3s; font-weight: 600;
   }
   button:hover { background: #ad1457; transform: scale(1.05); }
   .back { display: inline-block; margin-top: 10px; color: #ec407a;
     text-decoration: none; font-weight: 600; }
   .back:hover { color: #ad1457; }
   .alert { text-align:center; padding:10px; margin-bottom:15px; border-radius:6px; }
   .alert-error { background:#ffebee; color:#c62828; }
  </style>
</head>
<body>
<?php include '../navbar.php'; ?>
<div class="container">
  <h2>🛒 Tambah Pembelian</h2>
  <?php if (!empty($error)): ?>
    <div class="alert alert-error"><?= $error; ?></div>
  <?php endif; ?>
  <form method="POST" action="">
    <label>Nama Pembeli</label>
    <input type="text" name="nama_pembeli" required>
    <label>Alamat</label>
    <textarea name="alamat" rows="3" required></textarea>
    <label>No HP</label>
    <input type="text" name="no_hp" required>
    <label>Pilih Barang</label>
    <select name="id_barang" required>
      <option value="">-- Pilih Barang --</option>
      <?php foreach ($barang as $b): ?>
        <option value="<?= $b['id_barang']; ?>">
          <?= $b['nama_barang']; ?> (Stok: <?= $b['stok']; ?>, Rp <?= number_format($b['harga'],0,',','.'); ?>)
        </option>
      <?php endforeach; ?>
    </select>
    <label>Jumlah Beli</label>
    <input type="number" name="jml_beli" min="1" required>
    <button type="submit" name="simpan">Simpan</button>
  </form>
  <a href="home.php" class="back">⬅ Kembali</a>
</div>
</body>
</html>
