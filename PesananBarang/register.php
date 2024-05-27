<?php
include("koneksi/database.php");

$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $plain_password = $_POST['password']; // Store the plain password
    $role = $_POST['role'];

    $sql = "INSERT INTO users (username, email, password, plain_password, role) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $username, $email, $password, $plain_password, $role); // Adjust binding parameters

    if ($stmt->execute()) {
        $successMessage = "Registrasi berhasil Loading Ke Halaman Login...";
        header("Refresh: 1.6; url=login.php");
    } else {
        $successMessage = "Error: " . $stmt->error;
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
    <title>Register</title>
</head>
<body>
    <div class="wrapper">
        <?php if (!empty($successMessage)): ?> 
            <div class="message"><?php echo $successMessage; ?></div>
        <?php endif; ?>
        <h2>Register</h2>
        <form action="register.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required> 

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>

            <button type="submit" class="btn">Register</button>
        </form>
    </div>
</body>
</html>
