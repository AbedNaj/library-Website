<?php include "../logic/login.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/login.css" rel="stylesheet">
    <title>Login</title>
</head>
<body>
    <section class="main-container">
        <div class="login-container">
            <div class="header">
                <h1>Welcome Back</h1>
                <p class="welcome-text">Access your library account</p>
            </div>

            <form method="POST" action="">
                <div class="form-group">
                    <label for="user_email">Email</label>
                    <input type="email" name="user_email" id="user_email" placeholder="Enter your email" required>
                </div>

                <div class="form-group">
                    <label for="user_password">Password</label>
                    <input type="password" name="user_password" id="user_password" placeholder="Enter your password" required>
                </div>

                <button type="submit">Sign In</button>
            </form>

            <?php if (!empty($error)): ?>
                <div class="error">
                    <p><?= htmlspecialchars($error) ?></p>
                </div>
            <?php endif; ?>

            <div class="footer">
                <p>Don't have an account? <a href="signup">Register here</a></p>
                <p><a href="#">Forgot password?</a></p>
            </div>
        </div>
    </section>
</body>
</html>