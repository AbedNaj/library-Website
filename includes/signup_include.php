<?php include "../logic/signup.php" ?>


<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="../css/signup.css">
</head>
<body>
    <section class="main-container">
    <div class="signup-container">
        <div class="header">
            <h1>Create Account</h1>
            <p class="welcome-text">Join our library community</p>
        </div>
        
        <form action="" method="POST">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email"  name="email" id="email" placeholder="Enter your email" required>
            </div>
            
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Choose a username" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Create a password" required>
            </div>
            
            <button type="submit">Sign Up</button>
        </form>
        <?php
 
        ?>
        <div class="footer">
            <p>Already have an account? <a href="login">Sign in here</a></p>
        </div>
    </div>
    </section>
</body>
</html>