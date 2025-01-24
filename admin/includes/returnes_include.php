<?php
require_once "../logic/return.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Returns - Admin Dashboard</title>

    <link rel="stylesheet" href="./css/returns.css">
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="admin-info">
                <div class="admin-name">Library Admin</div>
                <div class="admin-role">Returns Management</div>
            </div>
            <ul class="nav-list">
                <li class="nav-item" onclick="location.href='/admin'">Dashboard</li>
                <li class="nav-item" onclick="location.href='addBook'">Books Management</li>
                <li class="nav-item">User Management</li>
                <a href="returns">
                    <li class="nav-item active">Returns</li>
                </a>
                <li class="nav-item " onclick="location.href='borrow-requests'">Borrow Requests</li>
                <li class="nav-item">Categories</li>
                <li class="nav-item">Reports</li>
                <li class="nav-item">Settings</li>
            </ul>
        </div>
        <?php
        if (isset($_SESSION['message'])) {
            // Determine message type based on content
            $messageClass = 'message-error'; // Default to error

            // If message contains 'success', set to success class
            if (stripos($_SESSION['message'], 'success') !== false) {
                $messageClass = 'message-success';
            } elseif (stripos($_SESSION['message'], 'warning') !== false) {
                $messageClass = 'message-warning';
            }

            // Create a dismissible message
            echo '<div class="message-container">' .
                '<div class="message ' . $messageClass . '">' .
                htmlspecialchars($_SESSION['message']) .
                '<button class="message-close" onclick="this.parentElement.parentElement.style.display=\'none\'">&times;</button>' .
                '</div>' .
                '</div>';

            // Unset the message to prevent repeated display
            unset($_SESSION['message']);
        }
        ?>
        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <h1 class="page-title">Returns Management</h1>
                <div class="header-actions">

                </div>
            </div>

            <!-- Returns Dashboard Grid -->
            <div class="returns-grid">
                <div class="stat-card">
                    <div class="stat-title">Total Returns</div>
                    <div class="stat-value"><?php echo htmlspecialchars($totalReturns) ?></div>
                </div>
                <div class="stat-card">
                    <div class="stat-title">On-Time Returns</div>
                    <div class="stat-value"><?php echo htmlspecialchars($OnTimeReturns) ?></div>
                </div>
                <div class="stat-card">
                    <div class="stat-title">Overdue Returns</div>
                    <div class="stat-value"><?php echo htmlspecialchars($OverdueReturns) ?></div>
                </div>
            </div>

            <!-- Returns Table -->
            <div class="table-container">
                <table class="returns-table">
                    <thead>
                        <tr>
                            <th>Book Title</th>
                            <th>Borrower</th>
                            <th>Borrowed Date</th>
                            <th>Due Date</th>
                            <th>Return Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>


                        <?php foreach ($returns as $return): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($return['Book Title']) ?></td>
                                <td><?php echo htmlspecialchars($return['Borrower']) ?></td>
                                <td><?php echo htmlspecialchars($return['Borrowed Date']) ?></td>
                                <td><?php echo htmlspecialchars($return['Due Date']) ?></td>
                                <td><?php echo htmlspecialchars($return['Return Date']) ?></td>
                                <td><span class="status-pill <?php echo $return['Status'] == 'On Time' ? 'status-on-time' : 'status-overdue' ?> ">
                                        <?php echo htmlspecialchars($return['Status']) ?></span></td>
                                <td>


                                    <?php if (empty($return['Return Date']) && $return['Status'] == 'On Time') : ?>
                                        <form method=POST>
                                            <input type="hidden" name="rentID" value="<?php echo htmlspecialchars($return["rentID"]); ?>">
                                            <button class="action-button clear" name="clear">Clear Return</button>

                                        </form>
                                    <?php elseif (empty($return['Return Date']) && $return['Status'] == 'Overdue') : ?>

                                        <button class="action-button fine" name="fine" onclick="location.href='return-fine?return=<?php echo htmlspecialchars($return["rentID"]); ?>'">Assess Fine</button>

                                    <?php else: ?>
                                        <button class="action-button details" onclick="location.href='return-details?return=<?php echo htmlspecialchars($return["rentID"]); ?>'">View Details</button>
                                    <?php endif; ?>
                                </td>
                            </tr>

                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>