<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$isLoged = false;
if (isset($_SESSION["user_id"]) && isset($_SESSION["user_email"])) {

    $projectRoot = $_SERVER['DOCUMENT_ROOT'];

    include_once($projectRoot . '/logic/profile_dropDown.php');

    $isLoged = true;
    $userName  = $username;
    $userEmail  = $_SESSION["user_email"];
}


?>

<!DOCTYPE html>
<html>

<head>

    <script>
        function toggleDropdown() {
            const dropdownMenu = document.getElementById('dropdownMenu');
            dropdownMenu.classList.toggle('active');

            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                const dropdown = document.querySelector('.profile-dropdown');
                if (!dropdown.contains(event.target)) {
                    dropdownMenu.classList.remove('active');
                }
            });
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link href="../css/navbar.css" rel="stylesheet">
    <link href="../css/profile_dropdown.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar">
        <a href="/" class="logo">
            <img src="./img/logo.png" alt="library"></a>
        <div class="nav-links">
            <a href="browse" class="browse">Browse</a>


            <?php if ($isLoged === true) :    ?>
                <div class="profile-dropdown">
                    <button class="dropdown-button" onclick="toggleDropdown()">

                        <div class="user-info">
                            <div class="user-name"><?php echo htmlspecialchars($userName) ?></div>
                            <div class="user-email"><?php echo htmlspecialchars($userEmail) ?></div>
                        </div>
                        <svg class="chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M6 9l6 6 6-6" />
                        </svg>
                    </button>

                    <div class="dropdown-menu" id="dropdownMenu">
                        <div class="menu-header">
                            <div class="user-name"><?php echo htmlentities($userName) ?></div>
                            <div class="user-email"><?php echo htmlspecialchars($userEmail) ?></div>
                        </div>
                        <ul class="menu-list">
                            <li>
                                <a href="profile" class="menu-item">
                                    <i class="fas fa-user"></i>
                                    Profile
                                </a>
                            </li>
                            <li>
                                <a href="borrowedBooks" class="menu-item">
                                    <i class="fas fa-book"></i>
                                    My Borrowed Books
                                </a>
                            </li>
                            <li>
                                <a href="settings" class="menu-item">
                                    <i class="fas fa-cog"></i>
                                    Settings
                                </a>
                            </li>
                            <li>
                                <a href="logout" class="menu-item logout-item">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

            <?php else : ?>
                <a href="login" class="signup">Login</a>
            <?php endif; ?>
        </div>
    </nav>
</body>

<script>
    function toggleDropdown() {
        const dropdownMenu = document.getElementById('dropdownMenu');
        dropdownMenu.classList.toggle('active');

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.querySelector('.profile-dropdown');
            if (!dropdown.contains(event.target)) {
                dropdownMenu.classList.remove('active');
            }
        });
    }
</script>

</html>