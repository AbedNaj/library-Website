<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();

}
$isLoged = false;
if (isset($_SESSION["user_id"] )) {
    $isLoged = true;
}


?>

<!DOCTYPE html>
<html>

<head>
    <link href="./css/navbar.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar">
        <a href="/" class="logo">
            <img src="./img/logo.png" alt="library"></a>
        <div class="nav-links">
            <a href="browse" class="browse">Browse</a>
            <a href="admin" class="login">Sign Up</a>
        
            <?php if( $isLoged === true) :    ?>
                <a href="logout" class="signup">Logout</a>
          
             <?php else : ?>
                <a href="login" class="signup">Login</a>
            <?php endif; ?>
        </div>
    </nav>
</body>

</html>