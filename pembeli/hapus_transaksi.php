<?php
require '../functions.php';

if (!isset($_GET['id']) || !isset($_GET['pembeli'])) {
    header("Location: pembeli.php");
    exit;
}
$id = (int)$_GET['id'];
$pembeli = (int)$_GET['pembeli']; 

$query = "DELETE FROM pembelian WHERE id_pembelian = $id";

if (mysqli_query($conn, $query)) {
    echo "<script>alert('Transaksi berhasil dihapus'); window.location='detail_pembeli.php?id=$pembeli';</script>";
} else {
    echo "<script>alert('Gagal menghapus transaksi'); window.location='detail_pembeli.php?id=$pembeli';</script>";
}
?>
