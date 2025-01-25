<?php
require_once '../logic/login.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/login.css">
</head>

<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Welcome Back</h1>
            <p>Sign in to continue to your dashboard</p>
        </div>
        <form method="POST">
            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" id="email" name="email" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-input" required>
                <?php
                if (isset($_SESSION['error'])) {

                    echo '<div class="error">' . $_SESSION['error'] . '</div>';
                    unset($_SESSION['error']);
                }
                ?>

            </div>
            <button type="submit" class="login-button">Sign In</button>
        </form>
        <div class="forgot-password">
            <a href="#">Forgot Password?</a>
        </div>
    </div>
</body>

</html>