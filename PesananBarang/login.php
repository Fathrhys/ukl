<?php
session_start();
include("koneksi/database.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Simpan data pengguna ke dalam sesi
            $_SESSION['user_id'] = $row['id']; // Simpan user_id di sesi
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['name'] = $row['name']; // Simpan nama pengguna di sesi
            $_SESSION['email'] = $row['email']; // Simpan email pengguna di sesi

            if ($row['role'] === 'admin') {
                header("Location: admin.php");
            } else {
                header("Location: user.php");
            }
            exit();
        } else {
            echo "<p>Password tidak valid</p>";
        }
    } else {
        echo "<p>Pengguna tidak ditemukan</p>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <title>Login</title>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" class="btn">Login</button>
            <div class="links">
                <a href="register.php">Register</a>
                <a href="forgot_password.php">Forgot Password</a>
            </div>
        </form>
    </div>
</body>
</html>

