<?php
session_start();
require '../functions.php'; // koneksi $conn

// Kalau user sudah login, tampilkan tombol ke dashboard, jangan langsung redirect
if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
    $redirect = ($role === 'Suplier') ? "../barang/barang.php" : "../home/home.php";
}
 
// Proses login
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username='$username' AND password=MD5('$password') LIMIT 1";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        // Simpan session
        $_SESSION['id_user']  = $row['id_user'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['role']     = $row['role'];

        // Arahkan sesuai role
        if ($row['role'] === 'Suplier') {
            header("Location: ../barang/barang.php");
        } else {
            header("Location: ../home/home.php");
        }
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login</title>
<style>
body {
    font-family: Arial, sans-serif;
    background: #f4f6f9;
}
.container {
    width: 350px;
    margin: 100px auto;
    background: white;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
}
h2 {
    text-align: center;
    color: #1565c0;
    margin-bottom: 20px;
}
input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #90caf9;
    border-radius: 8px;
}
button {
    width: 100%;
    padding: 10px;
    border: none;
    background: #1565c0;
    color: white;
    border-radius: 8px;
    cursor: pointer;
}
button:hover {
    background: #0d47a1;
}
.error {
    color: red;
    text-align: center;
    margin-bottom: 10px;
}
.info {
    text-align: center;
    margin-bottom: 15px;
    color: green;
}
</style>
</head>
<body>

<div class="container">
    <h2>🔑 Login</h2>
    <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
    <?php if (!empty($redirect)) { ?>
        <p class="info">Anda sudah login sebagai <b><?= $_SESSION['username']; ?></b>.</p>
        <a href="<?= $redirect; ?>"><button>Ke Dashboard</button></a>
        <a href="logout.php"><button type="button" style="background:#c62828">Logout</button></a>
    <?php } else { ?>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
    <?php } ?>
</div>

</body>
</html>