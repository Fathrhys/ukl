<?php
$servername = "localhost";
$username = "zafaisys_zafaisy"; // ganti dengan username database
$password = "?8+o8_q?oS!s"; // ganti dengan password database
$dbname = "zafaisys_zafaisy";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
