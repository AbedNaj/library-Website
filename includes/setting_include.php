<?php

require_once '../logic/settings_logic.php';
require_once 'header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Username and Password</title>
    <link rel="stylesheet" href="../css/settings.css">
</head>

<body>

    <div class="container">
        <div class="settings-section">
            <h2 class="section-title">Change Username</h2>
            <form class="settings-form" METHOD="POST" name="userForm">
                <input type="hidden" name="form_name" value="userForm">
                <div class="form-group">
                    <label class="form-label" for="current-username">Current Username</label>
                    <input class="form-input" type="text" id="current-username" name="current-username" readonly value="<?php echo htmlspecialchars($user) ?>">
                </div>
                <div class="form-group">
                    <label class="form-label" for="new-username">New Username</label>
                    <input class="form-input" type="text" id="new-username" name="new-username" required>
                </div>
                <?php
if (isset($_SESSION['changeUser'])) {
    // Determine if it's a success or error message
    $messageClass = strpos($_SESSION['changeUser'], 'Success') !== false 
        ? 'message-success' 
        : 'message-error';
    
    echo '<div class="' . $messageClass . '">' . 
         htmlspecialchars($_SESSION['changeUser']) . 
         '</div>';
    unset($_SESSION['changeUser']);
}
?>
                <button type="submit" class="save-settings">Update Username</button>
            </form>
        </div>

        <div class="settings-section">
            <h2 class="section-title">Change Password</h2>
            <form class="settings-form" METHOD="POST">
            <input type="hidden" name="form_name" value="passwordForm">
                <div class="form-group">
                    <label class="form-label" for="current-password">Current Password</label>
                    <input class="form-input" type="password" id="current-password" name="current-password" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="new-password">New Password</label>
                    <input class="form-input" type="password" id="new-password" name="new-password" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="confirm-password">Confirm New Password</label>
                    <input class="form-input" type="password" id="confirm-password" name="confirm-password" required>
                </div>
                <?php if (isset($_SESSION['changePassword'])) {
    // Determine if it's a success or error message
    $messageClass = strpos($_SESSION['changePassword'], 'Success') !== false 
        ? 'message-success' 
        : 'message-error';
    
    echo '<div class="' . $messageClass . '">' . 
         htmlspecialchars($_SESSION['changePassword']) . 
         '</div>';
    unset($_SESSION['changePassword']);
}?>
                <button type="submit" class="save-settings">Update Password</button>
            </form>
        </div>
    </div>
</body>

</html>