<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include("koneksi/database.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $plain_password = $_POST['password'];

    $sql = "UPDATE users SET username=?, email=?, password=?, plain_password=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $username, $email, $password, $plain_password, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: view_admin_users.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view_admin.css">
    <title>ZaFAisy - Update User</title>
</head>
<body>
    <div class="wrapper">
        <section id="update_user">
            <h2>Update User</h2>
            <form action="update_user.php" method="post">
                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                <input type="password" name="password" placeholder="New Password" required>
                <button type="submit" name="update">Update</button>
            </form>
            <a href="view_admin_users.php" class="btn-back">Kembali</a>
        </section>
    </div>
</body>
</html>
