<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include("koneksi/database.php");

// Fetch user information
$user_id = $_SESSION['user_id'];
$sql = "SELECT username, email, password FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $email, $password);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>ZaFAisy - Check Account</title>
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
        <!-- CHECK ACCOUNT -->
        <section id="check-account">
            <h2>Informasi Akun Mu</h2>
            <table>
                <tr>
                    <th>Username</th>
                    <td><?php echo htmlspecialchars($username); ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo htmlspecialchars($email); ?></td>
                </tr>
                <tr>
                    <th>Password</th>
                    <td><?php echo str_repeat('*', strlen($password)); ?></td>
                </tr>
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
