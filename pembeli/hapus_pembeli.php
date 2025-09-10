<?php
session_start();
require '../functions.php'; 

if (!isset($_SESSION['id_user'])) {
    header("Location: ../login/");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: pembeli.php");
    exit;
}
$id = (int)$_GET['id'];

mysqli_query($conn, "DELETE FROM pembelian WHERE id_pembeli = $id");

$query = "DELETE FROM pembeli WHERE id_pembeli = $id";
if (mysqli_query($conn, $query)) {
    echo "<script>alert('Data pembeli dan transaksinya berhasil dihapus'); window.location='pembeli.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus data'); window.location='pembeli.php';</script>";
}
?>
