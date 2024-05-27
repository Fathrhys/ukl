<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <title>User</title>
</head>
<body>
    <div class="wrapper">
    <h2>Selamat Datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        <p>Anda Login Sebagai User</p>
        <a href="logout.php" class="btn">Logout</a>
        <a href="barang.php" class="btn">Lanjutkan</a>
    </div>
</body>
</html>
