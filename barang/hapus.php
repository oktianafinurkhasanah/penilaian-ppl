<?php
session_start();
require '../auth.php';
require '../functions.php';

// Hanya Gudang & Admin yang boleh hapus
checkAccess(['Gudang','Admin']);

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<script>
            alert('❌ ID barang tidak valid!');
            document.location.href = 'barang.php';
          </script>";
    exit;
}

$id = (int) $_GET['id'];

$query = "DELETE FROM barang WHERE id_barang = $id";

if (mysqli_query($conn, $query)) {
    echo "<script>
            alert('🗑️ Data barang berhasil dihapus!');
            document.location.href = 'barang.php';
          </script>";
} else {
    $error = mysqli_error($conn);
    echo "<script>
            alert('❌ Gagal menghapus data! Error: $error');
            document.location.href = 'barang.php';
          </script>";
}
?>
