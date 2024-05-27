<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include("koneksi/database.php");

// Handle Create
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];

    $sql = "INSERT INTO products (name, price) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sd", $name, $price);
    $stmt->execute();
    $stmt->close();
}
// Handle Create
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    
    // Handle image upload
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Insert product with image path
    $sql = "INSERT INTO products (name, price, image_path) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sds", $name, $price, $target_file);
    $stmt->execute();
    $stmt->close();
}

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

// Handle Delete
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM products WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

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
    <link rel="stylesheet" href="view_admin.css">
    <title>ZaFAisy - Admin View</title>
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
            <h2>Admin - Manajemen Produk</h2>
            
            <!-- Create Form -->
            <!-- Create Form -->
            <form action="view_admin_products.php" method="post" enctype="multipart/form-data">
                <h3>Tambahkan Produk Baru</h3>
                <input type="text" name="name" placeholder="Product Name" required>
                <input type="number" name="price" placeholder="Product Price" required step="0.01">
                <input type="file" name="image" required>
                <button type="submit" name="create">Add Product</button>
            </form>


            <!-- Display Products -->
            <h3>Product List</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['price']); ?></td>
                            <td>
                                <form action="view_admin.php" method="post" style="display:inline-block;">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
                                    <input type="number" name="price" value="<?php echo htmlspecialchars($row['price']); ?>" required step="0.01">
                                    <button type="submit" name="update">Update</button>
                                </form>
                                <form action="view_admin.php" method="post" style="display:inline-block;">
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
