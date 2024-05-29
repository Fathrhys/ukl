<?php
session_start();
include("koneksi/database.php");

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];

    $sql = "SELECT * FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $message = "Username found. You can reset or view your password.";
        $_SESSION['reset_username'] = $username; // Store the username in the session for the next step
    } else {
        $message = "Username not found.";
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
    <title>Forgot Password</title>
</head>
<body>
    <div class="wrapper">
        <h2>Forgot Password</h2>
        <?php if (!empty($message)): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>
        <form action="forgot_password.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <button type="submit" class="btn">Submit</button>
        </form>
        <?php if (isset($_SESSION['reset_username'])): ?>
            <div class="links">
                <a href="reset_password.php">Reset Password</a>
                <a href="view_password.php">View Password</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
