<?php
session_start();
include 'db.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Our Menu | Food Café</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Our Menu</h1>

        <!-- Category Tabs -->
        <ul class="nav nav-tabs">
            <?php
            $categories = mysqli_query($conn, "SELECT * FROM categories");
            while ($cat = mysqli_fetch_assoc($categories)) {
                echo "<li class='nav-item'>
                        <a class='nav-link' href='?category_id={$cat['id']}'>
                            {$cat['name']}
                        </a>
                      </li>";
            }
            ?>
        </ul>

        <div class="row mt-3">
            <?php
            $category_id = $_GET['category_id'] ?? 1; // Default: first category
            $items = mysqli_query($conn, "SELECT * FROM menu_items WHERE category_id=$category_id");

            while ($item = mysqli_fetch_assoc($items)) {
                echo "<div class='col-md-4 mb-4'>
                        <div class='card'>
                            <div class='card-body'>
                                <h5>{$item['name']}</h5>
                                <p>Price: {$item['price']}</p>
                                <form action='add_to_cart.php' method='POST'>
                                    <input type='hidden' name='item_id' value='{$item['id']}'>
                                    <button type='submit' class='btn btn-primary'>Add to Cart</button>
                                </form>
                            </div>
                        </div>
                      </div>";
            }
            ?>
        </div>
    </div>
</body>
</html>
