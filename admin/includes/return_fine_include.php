<?php
include_once '../logic/return_fine.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Fine - Library Admin</title>
    <link rel="stylesheet" href="./css/returns.css">
    <link rel="stylesheet" href="./css/return_fine.css">
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

                <a href="returns">
                    <li class="nav-item active">Returns</li>
                </a>
                <li class="nav-item" onclick="location.href='borrow-requests'">Borrow Requests</li>

            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <h1 class="page-title">Return Fine Assessment</h1>
            </div>

            <div class="fine-details">
                <div class="fine-grid">
                    <div class="fine-item">
                        <span class="fine-label">Book Title</span>
                        <span class="fine-value"><?php echo htmlspecialchars($result['Book Title']) ?></span>
                    </div>
                    <div class="fine-item">
                        <span class="fine-label">Borrower Name</span>
                        <span class="fine-value"><?php echo htmlspecialchars($result['Borrower']) ?></span>
                    </div>
                    <div class="fine-item">
                        <span class="fine-label">Borrowed Date</span>
                        <span class="fine-value"><?php echo htmlspecialchars($result['Borrowed Date']) ?></span>
                    </div>
                    <div class="fine-item">
                        <span class="fine-label">Due Date</span>
                        <span class="fine-value"><?php echo htmlspecialchars($result['Due Date']) ?></span>
                    </div>
                    <div class="fine-item">
                        <span class="fine-label">Actual Return Date</span>
                        <span class="fine-value"><?php echo htmlspecialchars($result['Return Date']) ?></span>
                    </div>
                    <div class="fine-item">
                        <span class="fine-label">Days Overdue</span>
                        <span class="fine-value"><?php echo htmlspecialchars(abs($result['days_remaining'])) ?></span>
                    </div>
                </div>

                <div class="fine-total">
                    <span class="fine-label">Total Fine Amount</span>
                    <span class="total-amount"><?php echo '$' . htmlspecialchars(abs($result['days_remaining'])) * 0.5   ?></span>
                </div>
                <form method="POST">
                    <div class="header-actions">
                        <input type="hidden" name="returnID" value="<?php echo htmlspecialchars($result['rentLogID']) ?>">
                        <input type="hidden" name="fineAmount" value="<?php echo htmlspecialchars(abs($result['days_remaining'])) * 0.5   ?>">
                        <button class="action-button approve">Confirm Fine</button>
                </form>

            </div>
        </div>
    </div>
    </div>
</body>

</html>