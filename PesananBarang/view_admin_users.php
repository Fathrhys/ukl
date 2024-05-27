<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include("koneksi/database.php");

// Adding a new user
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $plain_password = $_POST['password'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $sql = "INSERT INTO users (username, password, plain_password, email, role) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $username, $password, $plain_password, $email, $role);
    $stmt->execute();
    $stmt->close();
}

// Updating an existing user
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $plain_password = $_POST['password'];
        $sql = "UPDATE users SET username=?, password=?, plain_password=?, email=?, role=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $username, $password, $plain_password, $email, $role, $id);
    } else {
        $sql = "UPDATE users SET username=?, email=?, role=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $username, $email, $role, $id);
    }
    $stmt->execute();
    $stmt->close();
}

// Deleting a user
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM transaksi WHERE user_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    $sql = "DELETE FROM users WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Fetch all users
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view_admin.css">
    <title>ZaFAisy - Admin Manajemen Akun User</title>
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
            <h2>Admin - Manajemen Akun User</h2>
            
            <!-- Create Form -->
            <form action="view_admin_users.php" method="post">
                <h3>Tambah Akun Baru</h3>
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="role" placeholder="Role" required>
                <button type="submit" name="create">Add User</button>
            </form>

            <!-- Display Users -->
            <h3>User List</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Password</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['role']); ?></td>
                            <td><?php echo htmlspecialchars($row['plain_password']); ?></td>
                            <td>
                                <form action="view_admin_users.php" method="post" style="display:inline-block;">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <input type="text" name="username" value="<?php echo htmlspecialchars($row['username']); ?>" required>
                                    <input type="password" name="password" placeholder="Password">
                                    <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
                                    <input type="text" name="role" value="<?php echo htmlspecialchars($row['role']); ?>" required>
                                    <button type="submit" name="update">Update</button>
                                </form>
                                <form action="view_admin_users.php" method="post" style="display:inline-block;">
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
