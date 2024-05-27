<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Detail Pemesanan</title>
</head>
<body>
    <nav>
        <div class="wrapper">
            <div class="logo"><a href="index.php"> ZaFAisy </a></div>
            <div class="menu">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="orders.php">Order</a></li>
                    <li><a href="check.php">Check</a></li>
                    <li><a href="partner.php">Partner</a></li>
                    <li><a href="login.php" class="tbl-biru">Sign-Up</a></li>
                </ul>
            </div>
        </div>
    </nav> <br>
    <div class="wrapper">   
        <!-- Detail Pemesanan -->
        <section id="order-detail">
            <h2>Detail Pemesanan</h2>
            <?php
            session_start();
            include("koneksi/database.php");

            if (!isset($_SESSION['username'])) {
                header("Location: login.php");
                exit();
            }

            $product_id = $_GET['id'];
            $sql = "SELECT * FROM products WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $product_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo '<div class="product-detail">';
                echo '<img src="images/' . htmlspecialchars($row["image_path"]) . '" alt="' . htmlspecialchars($row["name"]) . '">';
                echo '<h3>' . htmlspecialchars($row["name"]) . '</h3>';
                echo '<p>Rp ' . number_format($row["price"], 2, ',', '.') . '</p>';
                echo '<form action="submit_order.php" method="post">';
                echo '<input type="hidden" name="product_id" value="' . htmlspecialchars($row["id"]) . '">';
                echo '<label for="quantity">Jumlah:</label>';
                echo '<input type="number" id="quantity" name="quantity" min="1" required>';
                echo '<input type="hidden" id="customer_name" name="customer_name" value="' . htmlspecialchars($_SESSION['name']) . '">';
                echo '<input type="hidden" id="customer_email" name="customer_email" value="' . htmlspecialchars($_SESSION['email']) . '">';
                echo '<button type="submit" class="btn">Konfirmasi Pemesanan</button>';
                echo '</form>';
                echo '</div>';
            } else {
                echo "Produk tidak ditemukan.";
            }
            $stmt->close();
            $conn->close();
            ?>
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
