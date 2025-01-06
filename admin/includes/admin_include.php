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
                <div class="admin-name">John Smith</div>
                <div class="admin-role">Library Administrator</div>
            </div>
            <nav>
                <ul class="nav-list">
                    <li class="nav-item active">Dashboard</li>

                    <li class="nav-item">
                        <a href="addBook">Books Management</a>
                    </li>
                    <li class="nav-item">User Management</li>
                    <li class="nav-item">Loans & Returns</li>
                    <li class="nav-item">borrow requests</li>
                    <li class="nav-item">Categories</li>
                    <li class="nav-item">Reports</li>
                    <li class="nav-item">Settings</li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <h1 class="page-title">Dashboard</h1>
                <a href="addBook"><button class="action-button">Add New Book</button></a>
            </div>

            <!-- Stats Grid -->
            <div class="dashboard-grid">
                <div class="stat-card">
                    <div class="stat-title">Total Books</div>
                    <div class="stat-value">2,547</div>
                </div>
                <div class="stat-card">
                    <div class="stat-title">Active Users</div>
                    <div class="stat-value">842</div>
                </div>
                <div class="stat-card">
                    <div class="stat-title">Books Borrowed</div>
                    <div class="stat-value">157</div>
                </div>
                <div class="stat-card">
                    <div class="stat-title">Overdue Returns</div>
                    <div class="stat-value">23</div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="table-container">
                <h2 style="margin-bottom: 1rem;">Recent Activity</h2>
                <table class="activity-table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Book</th>
                            <th>Action</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Sarah Johnson</td>
                            <td>The Great Gatsby</td>
                            <td>Borrowed</td>
                            <td>Jan 1, 2025</td>
                            <td><span class="status-pill status-success">Active</span></td>
                        </tr>
                        <tr>
                            <td>Mike Williams</td>
                            <td>1984</td>
                            <td>Returned</td>
                            <td>Jan 1, 2025</td>
                            <td><span class="status-pill status-success">Completed</span></td>
                        </tr>
                        <tr>
                            <td>Emily Brown</td>
                            <td>Pride and Prejudice</td>
                            <td>Reserved</td>
                            <td>Jan 1, 2025</td>
                            <td><span class="status-pill status-pending">Pending</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>

</html>