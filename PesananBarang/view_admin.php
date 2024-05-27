<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <div class="wrapper">
        <h2>Selamat Datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        <p>Anda Login Sebagai Admin.</p>
        <div class="links">
            <a href="view_admin_products.php" class="btn">Manage Products</a>
            <a href="view_admin_users.php" class="btn">Manage Users</a>
            <a href="view_admin_transactions.php" class="btn">Manage Transactions</a>
        </div>
        <a href="logout.php" class="btn">Logout</a>
    </div>
</body>
</html>
