<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Your Cart | Food Café</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Your Cart</h1>
        <?php if (empty($_SESSION['cart'])): ?>
            <p>Your cart is empty. <a href="menu.php">Browse Menu</a></p>
        <?php else: ?>
            <ul class="list-group">
                <?php
                $total = 0;
                foreach ($_SESSION['cart'] as $item_id) {
                    $item = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM menu_items WHERE id=$item_id"));
                    echo "<li class='list-group-item'>
                            {$item['name']} - \${$item['price']}
                          </li>";
                    $total += $item['price'];
                }
                ?>
            </ul>
            <h4 class="mt-3">Total: $<?php echo $total; ?></h4>
            <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
        <?php endif; ?>
    </div>
</body>
</html>
