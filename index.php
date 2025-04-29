<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Food Café</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h1>Welcome to Food Café!</h1>
    <?php if (isset($_SESSION['user_id'])): ?>
        <p>Hello, <?php echo $_SESSION['username']; ?>! <a href="logout.php">Logout</a></p>
    <?php else: ?>
        <a href="login.php">Login</a> | <a href="signup.php">Sign Up</a>
    <?php endif; ?>
</body>
</html>
