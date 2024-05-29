<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];
$customer_name = $_POST['customer_name'];
$customer_email = $_POST['customer_email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Pilih Metode Pembayaran</title>
</head>
<body>
    <div class="payment-method-wrapper">
        <h2>Pilih Metode Pembayaran</h2>
        <form action="submit_order.php" method="post">
            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product_id); ?>">
            <input type="hidden" name="quantity" value="<?php echo htmlspecialchars($quantity); ?>">
            <input type="hidden" name="customer_name" value="<?php echo htmlspecialchars($customer_name); ?>">
            <input type="hidden" name="customer_email" value="<?php echo htmlspecialchars($customer_email); ?>">
            
            <label for="payment_method">Metode Pembayaran:</label>
            <select id="payment_method" name="payment_method" required>
                <option value="bank_transfer">Transfer Bank</option>
                <option value="credit_card">Kartu Kredit</option>
                <option value="paypal">PayPal</option>
                <option value="dana">Dana</option>
                <option value="gopay">Gopay</option>
                <option value="shopee_pay">Shopee</option>
                <option value="cash_on_delivery">COD</option>
            </select>
            
            <button type="submit" class="btn">Konfirmasi Pembayaran</button>
        </form>
    </div>
</body>
</html>
