<?php
session_start();
if (!isset($_SESSION['username']) || ($_SESSION['role'] !== 'user' && $_SESSION['role'] !== 'admin')) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>ZaFAisy - Partner Kami</title>
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
        <section id="partner">
            <h2>Partner ZaFAisy</h2>
            <div class="product-grid">
                <div class="product">
                    <img src="images/school.png" alt="Sekolah">
                    <h3>Sekolah</h3>
                    <p>SMK TELKOM SIDOARJO</p>
                </div>
                <div class="product">
                    <img src="images/friend.jpg" alt="Teman">
                    <h3>Teman</h3>
                    <p>X SIJA 1</p>
                </div>
                <div class="product">
                    <img src="images/p.jpg" alt="Saya">
                    <h3>Owner</h3>
                    <p>Ahmad Fadhil</p>
                </div>
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
