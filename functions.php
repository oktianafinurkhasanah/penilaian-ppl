<?php
$conn = mysqli_connect("localhost", "root", "", "afi");

function tampil($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function tambahBarang($data){
    global $conn;
    $nama_barang = htmlspecialchars($data["nama_barang"]);
    $stok = (int)$data["stok"];
    $harga = (int)$data["harga"];
    $gambar = htmlspecialchars($data["gambar"]);
    $query = "INSERT INTO barang (nama_barang, stok, harga, gambar) 
              VALUES ('$nama_barang', $stok, $harga, '$gambar')";
    return mysqli_query($conn, $query);
}

function tambahPembeli($data){
    global $conn;
    $nama_pembeli = htmlspecialchars($data["nama_pembeli"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $no_hp = htmlspecialchars($data["no_hp"]); 
    $query = "INSERT INTO pembeli (nama_pembeli, alamat, no_hp) 
              VALUES ('$nama_pembeli', '$alamat', '$no_hp')";
    return mysqli_query($conn, $query);
}

function tambahPembelian($data){
    global $conn;
    $id_pembeli = (int)$data["id_pembeli"];
    $id_barang = (int)$data["id_barang"];
    $jml_beli  = (int)$data["jml_beli"];
    $result = mysqli_query($conn, "SELECT harga FROM barang WHERE id_barang = $id_barang");
    $row = mysqli_fetch_assoc($result);
    $harga = $row["harga"];
    $total_harga = $jml_beli * $harga;
    $query = "INSERT INTO pembelian (id_pembeli, id_barang, jml_beli, total_harga, tgl_pembelian) 
              VALUES ($id_pembeli, $id_barang, $jml_beli, $total_harga, NOW())";
    return mysqli_query($conn, $query);
}
?>
