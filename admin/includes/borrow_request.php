<?php
include("../logic/borrow_request_logic.php");
include("../logic/borrow_request_statistics.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrow Requests - Library</title>

    <link rel="stylesheet" href="./css/borrow_request.css">
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
                <a href="/admin">   <li class="nav-item">Dashboard</li></a> 
                   <a href="addBook"> <li class="nav-item">Books Management</li></a>
                    <li class="nav-item">User Management</li>
                    <li class="nav-item">Loans & Returns</li>
                    <li class="nav-item active">Borrow Requests</li>
                    <li class="nav-item">Categories</li>
                    <li class="nav-item">Reports</li>
                    <li class="nav-item">Settings</li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <h1 class="page-title">Borrow Requests</h1>
                <div class="header-actions">


                    
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="dashboard-grid">
                <div class="stat-card">
                    <div class="stat-title">New Requests</div>
                    <div class="stat-value"><?php echo htmlspecialchars($NewRequestsCount) ?></div>
                </div>
                <div class="stat-card">
                    <div class="stat-title">Pending Requests</div>
                    <div class="stat-value"><?php echo htmlspecialchars($PendingRequestCount) ?></div>
                </div>
                <div class="stat-card">
                    <div class="stat-title">Approved Today</div>
                    <div class="stat-value"><?php echo htmlspecialchars($ApprovedCount) ?></div>
                </div>
                <div class="stat-card">
                    <div class="stat-title">Rejected Today</div>
                    <div class="stat-value"><?php echo htmlspecialchars($RejectedCount) ?></div>
                </div>
            </div>

            <!-- Borrow Requests Table -->
            <div class="table-container">
                <h2 style="margin-bottom: 1rem;">Current Requests</h2>
                <table class="activity-table">
                    <thead>
                        <tr>
                    
                            <th>User</th>
                            <th>Book Title</th>
                            <th>Request Date</th>
                            <th>Rent Days</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($requests as $request) : ?>
                        <tr>
                            <th><?php echo htmlspecialchars($request["user_name"]); ?></th>
                            <th><?php echo htmlspecialchars($request["book_name"]); ?></th>
                            <th><?php echo htmlspecialchars($request["request_date"]); ?></th>
                            <th><?php echo htmlspecialchars($request["rent_days_count"]); ?></th>
                            <th>
    <span class="status-pill 
    <?php if ($request["rent_state"] == "Pending"){
        echo"status-pending";
    }elseif ($request["rent_state"] == "Approved"){
            echo"status-success";
        } else   
            echo"status-rejected"    

        

   ?>
">
        <?php echo htmlspecialchars($request["rent_state"]); ?>
    </span>
</th>
                            <td>

                            <?php 
                  if ($request["rent_state"] == "Pending")
                  :
                  ?>
                  <form method="POST">
                  <input type="hidden" name="DaysCount" value="<?php echo htmlspecialchars($request["rent_days_count"]) ; ?>">
                                    <input type="hidden" name="ID" value="<?php echo htmlspecialchars($request["ID"]) ; ?>">
                                  <button class="action-button approve" name="action" value="Approve">Approve</button>
                                  <button class="action-button reject" name="action" value="Reject">Reject</button>
                                  </form>
                 <?php elseif  ($request["rent_state"] == "Approved")  : ?>   
                 
                    <button class="action-button view" onclick="location.href='borrow-details?request=<?php echo htmlspecialchars($request["ID"]);?>'">View Details</button>
              <?php else :  ?>

                
                <button class="action-button view" onclick="location.href='borrow-details?request=<?php echo htmlspecialchars($request["ID"]);?>'">View Details</button>

                <?php endif; ?>
                                
              


                            </td>
   
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>

</html>