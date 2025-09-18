<?php
session_start();
require '../functions.php';

// Kalau user sudah login
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

        // Simpan session di sini (baru $row ada isinya)
        $_SESSION['id_user']  = $row['id_user'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['role']     = $row['role'];

        header("Location: " . ($row['role'] === 'Suplier' ? "../barang/barang.php" : "../home/home.php"));
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
    font-family: 'Segoe UI', sans-serif;
    background:#fce4ec;
    display:flex; justify-content:center; align-items:center;
    height:100vh; margin:0;
}
.container {
    background:#fff; padding:25px;
    border-radius:10px; width:320px;
    box-shadow:0 4px 12px rgba(0,0,0,0.1);
}
h2 { text-align:center; color:#e91e63; margin-bottom:20px; font-size:1.3rem; }
input {
    width:100%; padding:10px; margin-bottom:12px;
    border:1px solid #e1bee7; border-radius:6px;
    font-size:0.95rem;
}
input:focus {
    outline:none; border-color:#e91e63;
    box-shadow:0 0 3px rgba(233,30,99,.5);
}
button {
    width:100%; padding:10px;
    border:none; border-radius:6px;
    background:#e91e63; color:white;
    font-size:0.95rem; cursor:pointer;
    transition:background .2s;
}
button:hover { background:#c2185b; }
.error { color:#d32f2f; text-align:center; margin-bottom:10px; }
.info { text-align:center; margin-bottom:12px; color:#388e3c; }
a button { background:#9e9e9e; margin-top:8px; }
</style>
</head>
<body>

<div class="container">
    <h2>Login</h2>
    <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
    <?php if (!empty($redirect)) { ?>
        <p class="info">Anda sudah login sebagai <b><?= $_SESSION['username']; ?></b>.</p>
        <a href="<?= $redirect; ?>"><button>Ke Dashboard</button></a>
        <a href="logout.php"><button type="button">Logout</button></a>
    <?php } else { ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
    <?php } ?>
</div>

</body>
</html>
