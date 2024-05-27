<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}

include("koneksi/database.php");

// Fetch all products
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>ZaFAisy - Pesan Produk</title>
</head>
<body>
    <nav>
        <div class="wrapper">
            <div class="logo"><a href="index.php">ZaFAisy</a></div>
            <div class="menu">
                <ul>
                    <li><a href="barang.php">Home</a></li>
                    <li><a href="history.php">History</a></li>
                    <li><a href="check.php">Akun</a></li>
                    <li><a href="partner.php">Partner</a></li>
                    <li><a href="logout.php" class="tbl-biru">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav> <br>
    <div class="wrapper">
        <!-- HOME -->
        <section id="order">
            <h2>Pemesanan Produk HNI</h2>
            <div class="product-grid">
                <?php while ($row = $result->fetch_assoc()): ?>
                <div class="product">
                    <img src="images/<?php echo htmlspecialchars($row['image_path']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
                    <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                    <p>Rp <?php echo number_format($row['price'], 0, ',', '.'); ?></p>
                    <a href="order.php?id=<?php echo $row['id']; ?>" class="btn">Pesan</a>
                </div>
                <?php endwhile; ?>
            </div>
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
                    <p>Kode Pos : 61215</p>
                </div>
                <div class="footer-section">
                    <h3>Tentang Kami</h3>
                    <p>Jika Terdapat Kekurangan Bisa Hubungi Kami <br><br><a href="mailto:fadhilfathirahesya@gmail.com">fadhilfathirahesya@gmail.com</a></p>
                </div>
            </div>
        </div>
    </div>

    <div id="copyright">
        <div class="wrapper">
            &copy; 2024. <b>ZaFAisy</b> All Times
        </div>
    </div>
</body>
</html>
