<?php
require_once './logic/admin_logic.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Library</title>

    <link rel="stylesheet" href="./css/admin.css">
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="admin-info">
                <div class="admin-name">Library Admin</div>
                <div class="admin-role">Dashboard</div>
            </div>
            <nav>
                <ul class="nav-list">
                    <li class="nav-item active">Dashboard</li>

                    <li class="nav-item">
                        <a href="addBook">Books Management</a>
                    </li>

                    <a href="returns">
                        <li class="nav-item">Returns</li>
                    </a>
                    <a href="borrow-requests">
                        <li class="nav-item">Borrow Requests</li>
                    </a>

                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <h1 class="page-title">Dashboard</h1>
                <div class="header-actions">
                    <a href="addBook"><button class="action-button">Add New Book</button></a>
                    <a href="admin-logout"><button class="action-button logout-button">Logout</button></a>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="dashboard-grid">
                <div class="stat-card">
                    <div class="stat-title">Total Books</div>
                    <div class="stat-value"><?php echo htmlspecialchars($TotalBooks) ?></div>
                </div>
                <div class="stat-card">
                    <div class="stat-title">Active Users</div>
                    <div class="stat-value"><?php echo htmlspecialchars($TotalUsers) ?></div>
                </div>
                <div class="stat-card">
                    <div class="stat-title">Books Borrowed</div>
                    <div class="stat-value"><?php echo htmlspecialchars($BooksBorrowed) ?></div>
                </div>
                <div class="stat-card">
                    <div class="stat-title">Overdue Active Borrows</div>
                    <div class="stat-value"><?php echo htmlspecialchars($OverdueReturns) ?></div>
                </div>
            </div>

            <!-- Recent Activity -->

        </main>
    </div>
</body>

</html>