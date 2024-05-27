<?php
session_start();
include("koneksi/database.php");

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['user_id']; // dengan user_id menyimpan saat sesi login
    $quantity = $_POST['quantity'];
    $customer_name = $_SESSION['username'];
    $customer_email = $_SESSION['email'];

    $sql = "INSERT INTO transaksi (product_id, user_id, quantity) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $product_id, $user_id, $quantity);

    if ($stmt->execute()) {
        $order_id = $stmt->insert_id; // Mendapatkan ID Orderan Baru
        $stmt->close();

        // Mengambil detail produk untuk ditampilkan
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();
            $total_price = $product["price"] * $quantity; // Cek Harga
            echo '<div class="wrapper">';
            echo '<h2>Pesanan Berhasil</h2>';
            echo '<p>Detail Pesanan:</p>';
            echo '<p>Nama Produk: ' . htmlspecialchars($product["name"]) . '</p>';
            echo '<p>Harga: Rp ' . number_format($product["price"], 2, ',', '.') . '</p>';
            echo '<p>Jumlah: ' . htmlspecialchars($quantity) . '</p>';
            echo '<p>Total Harga: Rp ' . number_format($total_price, 2, ',', '.') . '</p>'; // Tampilan Total Harga
            echo '<p>Nama Pemesan: ' . htmlspecialchars($customer_name) . '</p>';
            echo '<p>Email Pemesan: ' . htmlspecialchars($customer_email) . '</p>';
            echo '<button onclick="window.location.href=\'barang.php\'">Kembali ke Halaman Produk</button>';
            echo '</div>';
        } else {
            echo '<div class="wrapper">';
            echo '<p>Produk tidak ditemukan.</p>';
            echo '</div>';
        }
        $stmt->close();
    } else {
        echo '<div class="wrapper">';
        echo '<p>Gagal menyimpan pesanan.</p>';
        echo '</div>';
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="struk.css">
    <title>Detail Pesanan</title>
</head>
<body>
</body>
</html>
