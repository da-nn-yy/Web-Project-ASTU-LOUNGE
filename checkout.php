<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || empty($_SESSION['cart'])) {
    header("Location: menu.php");
    exit();
}

// Save order to database (simplified)
if (isset($_POST['checkout'])) {
    $user_id = $_SESSION['user_id'];
    $total = array_sum(array_map(function($item_id) use ($conn) {
        $item = mysqli_fetch_assoc(mysqli_query($conn, "SELECT price FROM menu_items WHERE id=$item_id"));
        return $item['price'];
    }, $_SESSION['cart']));

    mysqli_query($conn, "INSERT INTO orders (user_id, total) VALUES ($user_id, $total)");
    $_SESSION['cart'] = []; // Clear cart
    echo "<div class='alert alert-success'>Order placed! Thank you.</div>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Checkout | Food Café</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Checkout</h1>
        <form method="POST">
            <button type="submit" name="checkout" class="btn btn-primary">Confirm Order</button>
        </form>
    </div>
</body>
</html>
