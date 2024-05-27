<?php
session_start();
include("koneksi/database.php");

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Query to fetch transaction and product data
$sql = "SELECT transaksi.id, products.name, products.price, transaksi.quantity, transaksi.order_date 
        FROM transaksi 
        JOIN products ON transaksi.product_id = products.id 
        WHERE transaksi.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$transactions = [];
while ($row = $result->fetch_assoc()) {
    $transactions[] = $row;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="history.css">
    <title>History Pembelian</title>
</head>
<body>
    <div class="wrapper">
        <h2>History Pembelian</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Tanggal Pembelian</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($transactions) > 0): ?>
                    <?php foreach ($transactions as $index => $transaction): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo htmlspecialchars($transaction['name']); ?></td>
                            <td><?php echo 'Rp ' . number_format($transaction['price'], 2, ',', '.'); ?></td>
                            <td><?php echo htmlspecialchars($transaction['quantity']); ?></td>
                            <td><?php echo htmlspecialchars($transaction['order_date']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No transactions found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <br>
        <a href="barang.php" class="btn">Back to Order</a>
        <a href="logout.php" class="btn">Logout</a>
    </div>
</body>
</html>
