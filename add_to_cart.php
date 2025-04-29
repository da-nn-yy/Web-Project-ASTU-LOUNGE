<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect if not logged in
    exit();
}

if (isset($_POST['item_id'])) {
    $item_id = $_POST['item_id'];

    // Initialize cart if empty
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Add item to cart (store ID only)
    array_push($_SESSION['cart'], $item_id);
    header("Location: cart.php"); // Redirect to cart page
}
?>
