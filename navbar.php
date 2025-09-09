<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navbar</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      background: #fde2e4;
      color: #4a2c2a;
    }

    .navbar {
      background: linear-gradient(90deg, #ec407a, #ad1457); 
      padding: 15px 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
      border-bottom: 3px solid #f8bbd0;
    }

    .navbar .logo {
      color: #fff;
      font-size: 22px;
      font-weight: bold;
      letter-spacing: 1px;
    }

    .navbar ul {
      list-style: none;
      display: flex;
      gap: 25px;
      margin: 0;
      padding: 0;
    }

    .navbar ul li a {
      color: #ffe6f0;
      text-decoration: none;
      font-weight: 600;
      padding: 8px 14px;
      border-radius: 6px;
      transition: 0.3s;
    }

    .navbar ul li a:hover {
      background: #d81b60;
      color: #fff;
      box-shadow: 0 2px 8px rgba(0,0,0,0.2);
      transform: scale(1.05);
    }

    @media (max-width: 768px) {
      .navbar {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
      }

      .navbar ul {
        flex-direction: column;
        width: 100%;
        gap: 12px;
      }

      .navbar ul li a {
        display: block;
        width: 100%;
      }
    }
  </style>
</head>
<body>
<div class="navbar">
  <div class="logo">あふい</div>
  <ul>
    <li><a href="../home/home.php">Home</a></li>
    <li><a href="../barang/barang.php">Barang</a></li>
    <li><a href="../pembeli/pembeli.php">Pembeli</a></li>
  </ul>
</div>
</body>
</html>
