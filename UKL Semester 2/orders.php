<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>ZAFAISY</title>
</head>
<body>
    <nav>
        <div class="wrapper">
            <div class="logo"><a href="index.php"> Zafaisy </a></div>
            <div class="menu">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="orders.php">Order</a></li>
                    <li><a href="#">Check</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Partnert</a></li>
                    <li><a href="Login.php" class="tbl-biru">Sign-Up</a></li>
                </ul>
            </div>
        </div>
    </nav> <br>
    <div class="wrapper">   
        <!-- HOME -->
        <section id="order">    
            <h2>Pemesanan Barang</h2>
            <div class="product-grid">
                <?php
                include ("koneksi/database       ");
                
                $sql = "SELECT * FROM products";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="product">';
                        echo '<img src="' . $row["image"] . '" alt="' . $row["name"] . '">';
                        echo '<h3>' . $row["name"] . '</h3>';
                        echo '<p>Rp ' . number_format($row["price"], 2, ',', '.') . '</p>';
                        echo '<a href="order.php?id=' . $row["id"] . '" class="btn">Pesan</a>';
                        echo '</div>';
                    }
                } else {
                    echo "Tidak ada produk tersedia.";
                }
                $conn->close();
                ?>
            </div>
        </section>
    </div>

    <div id="contact">
        <div class="wrapper">
            <div class="footer">
                <div class="footer-section">
                    <h3>Speedy</h3>
                    <p>Speedy Tempat Mendapatkan Jasa Pengiriman</p>
                </div>
                <div class="footer-section">
                    <h3>Lokasi</h3>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Enim dicta veritatis assumenda reprehenderit, nisi perferendis. Ipsa iure adipisci eaque, eligendi quasi omnis veritatis, beatae aut commodi impedit, in doloribus magni.</p>
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
            &copy; 2024. <b>Speedy</b> All Times
        </div>
    </div>
</body>
</html>
