<?php
include_once "../logic/book_add_fech_data.php";
include_once "../logic/book_add_data.php";
include_once "../logic/book_add_img_Upload.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book - Library Admin</title>
    <link rel="stylesheet" href="./css/book_add.css">

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const closeButton = document.getElementById("close-message");
            if (closeButton) {
                closeButton.addEventListener("click", function() {
                    const messageDiv = document.getElementById("success-message");
                    messageDiv.style.display = "none";
                });
            }
        });
    </script>
</head>

<body>


    <div class="container">

        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="admin-info">
                <div class="admin-name">Library Admin</div>
                <div class="admin-role">Add New Book</div>
            </div>
            <nav>
                <ul class="nav-list">
                    <a href="">
                        <li class="nav-item">
                            <a href="/admin">Dashboard</a>
                        </li>
                    </a>
                    <li class="nav-item active">Books Management</li>
                    <li class="nav-item">User Management</li>
                    <a href="returns">
                        <li class="nav-item">Returns</li>
                    </a>
                    <a href="borrow-requests">
                        <li class="nav-item">Borrow Requests</li>
                    </a>

                    <li class="nav-item">Categories</li>
                    <li class="nav-item">Reports</li>
                    <li class="nav-item">Settings</li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">


            <!-- Success Message -->
            <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                <div id="success-message" class="success-message">
                    <span>Book <?php echo $_GET['booktitle'] ?> added successfully!</span>
                    <button id="close-message">&times;</button>
                </div>
            <?php endif; ?>


            <div class="header">
                <h1 class="page-title">Add New Book</h1>
                <p class="subtitle">Enter the details of the new book below</p>
            </div>

            <form class="form-container" method="POST" enctype="multipart/form-data">
                <div class="form-grid">
                    <!-- Title -->
                    <div class="form-group full-width">
                        <label for="title">Book Title *</label>
                        <input type="text" id="title" name="title" required>
                    </div>

                    <!-- Author -->
                    <div class="form-group">
                        <label for="author">Author *</label>
                        <select id="author" name="author" required>
                            <option value="">Select author</option>
                            <?php foreach ($authors as $author): ?>
                                <option value=" <?php echo $author['ID']; ?>">
                                    <?php echo htmlspecialchars($author["author_name"]) ?>
                                </option>

                            <?php endforeach; ?>
                        </select>
                    </div>


                    <!-- Category -->
                    <div class="form-group">
                        <label for="category">Category *</label>
                        <select id="category" name="category" required>


                            <option value="">Select Category</option>

                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo $category['ID']; ?>">
                                    <?php echo htmlspecialchars($category["category_name"]) ?>
                                </option>

                            <?php endforeach; ?>

                        </select>
                    </div>

                    <!-- Publication Year -->
                    <div class="form-group">
                        <label for="publication_year">Publication Year</label>
                        <input type="number" id="publication_year" name="publication_year">
                    </div>



                    <!-- Copies -->
                    <div class="form-group">
                        <label for="copies">Number of Copies *</label>
                        <input type="number" id="copies" name="copies" min="1" required>
                    </div>



                    <!-- Description -->
                    <div class="form-group full-width">
                        <label for="description">Description</label>
                        <textarea id="description" name="description"></textarea>
                    </div>

                    <!-- Cover Image -->
                    <div class="form-group full-width">
                        <label for="cover">Cover Image</label>
                        <input type="file" id="cover" name="cover" accept="image/*">
                    </div>
                </div>

                <!-- Buttons -->
                <div class="button-group">
                    <button type="submit" class="submit-button">Add Book</button>
                    <button type="button" class="cancel-button">Cancel</button>
                </div>
            </form>
        </main>
    </div>
</body>

</html>