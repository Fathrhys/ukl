<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include("koneksi/database.php");

// Handle Update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $id = $_POST['id'];
    $user_id = $_POST['user_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $order_date = $_POST['order_date'];

    $sql = "UPDATE transaksi SET user_id=?, product_id=?, quantity=?, order_date=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiisi", $user_id, $product_id, $quantity, $order_date, $id);
    $stmt->execute();
    $stmt->close();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view_admin.css">
    <title>ZaFAisy - Update User</title>
</head>
<body>
    <div class="wrapper">
        <section id="update_transaksi">
            <h2>Update Transaksi</h2>
           <form action="update_transaksi.php" method="post" style="display:inline-block;">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <input type="number" name="user_id" value="<?php echo htmlspecialchars($row['user_id']); ?>" required>
                <input type="number" name="product_id" value="<?php echo htmlspecialchars($row['product_id']); ?>" required>
                <input type="number" name="quantity" value="<?php echo htmlspecialchars($row['quantity']); ?>" required>
                <input type="date" name="order_date" value="<?php echo htmlspecialchars($row['order_date']); ?>" required>
                <button type="submit" name="update">Update</button>
            </form>
            <a href="view_admin_transactions.php" class="btn-back">Kembali</a>
        </section>
    </div>
</body>
</html>
