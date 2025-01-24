<?php
include_once("../logic/book_details_logic.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Details - Library</title>
    <link rel="stylesheet" href="./css/borrow_details.css">
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="admin-info">
                <div class="admin-name">Library Admin</div>
                <div class="admin-role">Borrow Details</div>
            </div>
            <nav>
                <ul class="nav-list">
                    <li class="nav-item" onclick="location.href='/admin'">Dashboard</li>
                    <li class="nav-item" onclick="location.href='addBook'">Books Management</li>
                    <li class="nav-item">User Management</li>
                    <a href="returns">
                        <li class="nav-item">Returns</li>
                    </a>
                    <li class="nav-item active" onclick="location.href='borrow-requests'">Borrow Requests</li>
                    <li class="nav-item">Categories</li>
                    <li class="nav-item">Reports</li>
                    <li class="nav-item">Settings</li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <h1 class="page-title">Request Details</h1>
                <div class="header-actions">
                    <a href="borrow-requests" class="back-button">Back to Requests</a>
                </div>
            </div>

            <div class="details-container">
                <div class="details-grid">
                    <div class="left-column">
                        <div class="detail-group">
                            <div class="detail-label">Request ID</div>
                            <div class="detail-value"><?php echo htmlspecialchars($request["ID"]) ?></div>
                        </div>
                        <div class="detail-group">
                            <div class="detail-label">User Name</div>
                            <div class="detail-value"><?php echo htmlspecialchars($request["user_name"]) ?></div>
                        </div>
                        <div class="detail-group">
                            <div class="detail-label">Book Title</div>
                            <div class="detail-value"><?php echo htmlspecialchars($request["book_name"]) ?></div>
                        </div>
                        <div class="detail-group">
                            <div class="detail-label">Request Date</div>
                            <div class="detail-value"><?php echo htmlspecialchars($request["request_date"]) ?></div>
                        </div>
                    </div>
                    <div class="right-column">
                        <div class="detail-group">
                            <div class="detail-label">Status</div>
                            <div class="detail-value">
                                <span class="status-pill <?php echo $request["rent_state"] == "Approved" ? "status-success" : "status-rejected" ?>"><?php echo htmlspecialchars($request["rent_state"]) ?></span>
                            </div>
                        </div>
                        <div class="detail-group">
                            <div class="detail-label">Rental Duration</div>
                            <div class="detail-value"><?php echo htmlspecialchars($request["rent_days_count"]) . " Days " ?></div>
                        </div>
                        <div class="detail-group">
                            <div class="detail-label">Return Due Date</div>
                            <div class="detail-value"><?php echo htmlspecialchars($request["return_expiry_date"]) ?></div>
                        </div>
                    </div>
                </div>

                <div class="decision-details">
                    <h2 class="section-title">Decision Details</h2>
                    <div class="decision-info">
                        <div class="detail-group">
                            <div class="detail-label">Decision Date</div>
                            <div class="detail-value"><?php echo htmlspecialchars($request["rent_state_date"]) ?></div>
                        </div>
                        <div class="detail-group">
                            <div class="detail-label">Processed By</div>
                            <div class="detail-value">John Smith</div>
                        </div>
                        <div class="detail-group">
                            <div class="detail-label">Comments</div>
                            <div class="detail-value">Approved for standard 14-day loan period.</div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>