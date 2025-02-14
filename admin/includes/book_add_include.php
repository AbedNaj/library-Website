<?php
include_once "../logic/book_add_fech_data.php";
include_once "../logic/book_add_data.php";
include_once "../logic/book_add_img_Upload.php";
?>

<?php
// Assuming $authors and $categories are fetched from your database earlier.
$authorNames = array_map(function ($author) {
    return $author['author_name'];
}, $authors);

$categoryNames = array_map(function ($category) {
    return $category['category_name'];
}, $categories);
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
                        <input type="text" id="author" name="author" required autocomplete="off">
                    </div>

                    <!-- Category -->
                    <div class="form-group">
                        <label for="category">Category *</label>
                        <input type="text" id="category" name="category" required autocomplete="off">
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

<!-- Include jQuery and jQuery UI -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

<script>
    $(function() {
        // Use PHP to output JSON arrays for autocomplete
        var authors = <?php echo json_encode($authorNames); ?>;
        var categories = <?php echo json_encode($categoryNames); ?>;

        // Initialize autocomplete for the "author" input
        $("#author").autocomplete({
            source: authors,
            minLength: 0
        }).focus(function() {
            // Show all suggestions on focus
            $(this).autocomplete("search");
        });

        // Initialize autocomplete for the "category" input
        $("#category").autocomplete({
            source: categories,
            minLength: 0
        }).focus(function() {
            $(this).autocomplete("search");
        });
    });
</script>