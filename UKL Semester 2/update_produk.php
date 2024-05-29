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
    $name = $_POST['name'];
    $price = $_POST['price'];

    $sql = "UPDATE products SET name=?, price=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdi", $name, $price, $id);
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
    <title>ZaFAisy - Update Produk</title>
</head>
<body>
    <div class="wrapper">
        <section id="update_produk">
            <h2>Update User</h2>
             <form action="view_admin.php" method="post" style="display:inline-block;">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
                <input type="number" name="price" value="<?php echo htmlspecialchars($row['price']); ?>" required step="0.01">
                <button type="submit" name="update">Update</button>
            </form>
            <a href="view_admin_products.php" class="btn-back">Kembali</a>
        </section>
    </div>
</body>
</html>