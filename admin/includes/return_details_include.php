<?php
require_once '../logic/return_details.php';


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Details - Library Admin</title>
    <link rel="stylesheet" href="./css/returns.css">
    <link rel="stylesheet" href="./css/return_details.css">
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
                <li class="nav-item" onclick="location.href='borrow-requests'">Borrow Requests</li>
                <li class="nav-item">Categories</li>
                <li class="nav-item">Reports</li>
                <li class="nav-item">Settings</li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <h1 class="page-title">Return Details</h1>
            </div>

            <div class="return-details">
                <div class="return-grid">
                    <div class="return-item">
                        <span class="return-label">Book Title</span>
                        <span class="return-value"><?php echo htmlspecialchars($result['Book Title']) ?></span>
                    </div>
                    <div class="return-item">
                        <span class="return-label">Borrower Name</span>
                        <span class="return-value"><?php echo htmlspecialchars($result['Borrower']) ?></span>
                    </div>
                    <div class="return-item">
                        <span class="return-label">Borrowed Date</span>
                        <span class="return-value"><?php echo htmlspecialchars($result['Borrowed Date']) ?></span>
                    </div>
                    <div class="return-item">
                        <span class="return-label">Due Date</span>
                        <span class="return-value"><?php echo htmlspecialchars($result['Due Date']) ?></span>
                    </div>
                    <div class="return-item">
                        <span class="return-label">Actual Return Date</span>
                        <span class="return-value"><?php echo htmlspecialchars($result['Return Date']) ?></span>
                    </div>
                    <div class="return-item">
                        <span class="return-label">Status</span>
                        <span class="status-pill <?php echo $result['Status'] == 'On Time' ? 'status-on-time' : 'status-overdue' ?>  "><?php echo htmlspecialchars($result['Status']) ?></span>
                    </div>
                </div>

                <div class="fine-total">
                    <span class="fine-label">Total Fine Amount</span>
                    <span class="total-amount"><?php echo '$' . htmlspecialchars(abs($result['fine_amount']))   ?></span>
                </div>

                <div class="header-actions">
                    <a href="returns">
                        <button class="action-button approve">Close Case</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>