<?php
session_start();
include("koneksi/database.php");

if (!isset($_SESSION['reset_username'])) {
    header("Location: forgot_password.php");
    exit();
}

$username = $_SESSION['reset_username'];

$sql = "SELECT plain_password FROM users WHERE username=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $plain_password = $row['plain_password'];
} else {
    $plain_password = "Error retrieving password.";
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <title>View Password</title>
</head>
<body>
    <div class="wrapper">
        <h2>View Password</h2>
        <p>Your password is: <?php echo $plain_password; ?></p>
        <a href="login.php" class="btn">Back</a>
    </div>
</body>
</html>
