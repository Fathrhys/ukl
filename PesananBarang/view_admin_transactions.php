<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include("koneksi/database.php");

// Handle Create
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create'])) {
    $user_id = $_POST['user_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $order_date = $_POST['order_date'];

    $sql = "INSERT INTO transaksi (user_id, product_id, quantity, order_date) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiis", $user_id, $product_id, $quantity, $order_date);
    $stmt->execute();
    $stmt->close();
}

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

// Handle Delete
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM transaksi WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Fetch all transactions
$sql = "SELECT * FROM transaksi";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view_admin.css">
    <title>ZaFAisy - Admin Manage Transactions</title>
</head>
<body>
    <nav>
        <div class="wrapper">
            <div class="logo"><a href="view_admin.php">ZaFAisy</a></div>
            <div class="menu">
                <ul>
                    <li><a href="view_admin.php">Home</a></li>
                    <li><a href="view_admin_users.php">User</a></li>
                    <li><a href="view_admin_products.php">Product</a></li>
                    <li><a href="view_admin_transactions.php">Transaksi</a></li>
                    <li><a href="partner.php">Partner</a></li>
                    <li><a href="logout.php" class="btn-signup">Log-out</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="wrapper">
        <section id="view_admin">
            <h2>Admin - Manajemen Transaksi</h2>
            
            <!-- Create Form -->
            <form action="view_admin_transactions.php" method="post">
                <h3>Tambah Transaksi Baru</h3>
                <input type="number" name="user_id" placeholder="User ID" required>
                <input type="number" name="product_id" placeholder="Product ID" required>
                <input type="number" name="quantity" placeholder="Quantity" required>
                <input type="date" name="order_date" placeholder="Order Date" required>
                <button type="submit" name="create">Add Transaction</button>
            </form>

            <!-- Display Transactions -->
            <h3>Transaction List</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User ID</th>
                        <th>Product ID</th>
                        <th>Quantity</th>
                        <th>Order Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['user_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['product_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                            <td><?php echo htmlspecialchars($row['order_date']); ?></td>
                            <td>
                                <form action="view_admin_transactions.php" method="post" style="display:inline-block;">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <input type="number" name="user_id" value="<?php echo htmlspecialchars($row['user_id']); ?>" required>
                                    <input type="number" name="product_id" value="<?php echo htmlspecialchars($row['product_id']); ?>" required>
                                    <input type="number" name="quantity" value="<?php echo htmlspecialchars($row['quantity']); ?>" required>
                                    <input type="date" name="order_date" value="<?php echo htmlspecialchars($row['order_date']); ?>" required>
                                    <button type="submit" name="update">Update</button>
                                </form>
                                <form action="view_admin_transactions.php" method="post" style="display:inline-block;">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="delete">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>
    </div>

    <div id="contact">
        <div class="wrapper">
            <div class="footer">
                <div class="footer-section">
                    <h3>ZaFAisy</h3>
                    <p>ZaFAisy Tempat Mendapatkan Jasa Pengiriman</p>
                </div>
                <div class="footer-section">
                    <h3>Lokasi</h3>
                    <p>Masangan Kulon Rt.06 Rw 02 Gang Maskulin.</p>
                </div>
                <div class="footer-section">
                    <h3>Kontak</h3>
                    <p>SMK TELKOM SIDOARJO</p>
                    <p>Kode Pos: 61215</p>
                </div>
                <div class="footer-section">
                    <h3>Tentang Kami</h3>
                    <p>Jika Terdapat Kekurangan Bisa Hubungi Kami<br><br><a href="mailto:fadhilfathirahesya@gmail.com">fadhilfathirahesya@gmail.com</a></p>
                </div>
            </div>
        </div>
    </div>

    <div id="copyright">
        <div class="wrapper">
            &copy; 2024. <b>ZaFAisy</b> All Rights Reserved.
        </div>
    </div>
</body>
</html>
