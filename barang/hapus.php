<?php
require '../functions.php';

$id = $_GET['id'];

if (mysqli_query($conn, "DELETE FROM barang WHERE id_barang = $id")) {
    echo "<script>
            alert('🗑️ Data barang berhasil dihapus!');
            document.location.href = 'barang.php';
          </script>";
} else {
    echo "<script>
            alert('❌ Gagal menghapus data!');
            document.location.href = 'barang.php';
          </script>";
}
?>
