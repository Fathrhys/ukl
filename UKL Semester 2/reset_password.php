<?php
session_start();
include("koneksi/database.php");

if (!isset($_SESSION['reset_username'])) {
    header("Location: forgot_password.php");
    exit();
}

$message = "";
$reset_success = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_password = $_POST['new_password'];
    $username = $_SESSION['reset_username'];

    $sql = "UPDATE users SET plain_password=? WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $new_password, $username);
    if ($stmt->execute()) {
        $message = "Password successfully reset.";
        $reset_success = true;
        unset($_SESSION['reset_username']);
    } else {
        $message = "Error resetting password.";
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
    <title>Reset Password</title>
</head>
<body>
    <div class="wrapper">
        <h2>Reset Password</h2>
        <?php if (!empty($message)): ?>
            <p class="message"><?php echo $message; ?></p>
            <?php if ($reset_success): ?>
                <a href="login.php" class="btn">Back to Login</a>
            <?php endif; ?>
        <?php else: ?>
            <form action="reset_password.php" method="post">
                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password" required>
                <button type="submit" class="btn">Reset Password</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
