

<?php include "../logic/browse.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Books - Library</title>
<link rel="stylesheet" href="../css/book_browse.css">
</head>
<body>
    <div class="container">
        <!-- Category Sidebar -->
        <aside class="category-sidebar">


            <h2 class="category-title">Categories</h2>


            <ul class="category-list">


                <li class="category-item active">All Books</li>
                
                <?php foreach ($categories as $category): ?>
               <li class="category-item" ><?php echo htmlspecialchars($category['category_name']); ?></li>
    <?php endforeach; ?>



            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="content-header">
                <h1>Browse Books</h1>
                <p>Showing all available books in our library</p>
            </div>

            <div class="book-grid">
                <!-- Sample Book Cards -->
                <div class="book-card" onclick="window.location.href='book_details.php?id=1'">
                    <div class="book-image">
                        <img src="/api/placeholder/200/280" alt="Book Cover">
                    </div>
                    <div class="book-info">
                        <h3 class="book-title">The Great Gatsby</h3>
                        <p class="book-author">F. Scott Fitzgerald</p>
                        <p class="book-status status-available">Available</p>
                    </div>
                </div>

                <div class="book-card" onclick="window.location.href='book_details.php?id=2'">
                    <div class="book-image">
                        <img src="/api/placeholder/200/280" alt="Book Cover">
                    </div>
                    <div class="book-info">
                        <h3 class="book-title">1984</h3>
                        <p class="book-author">George Orwell</p>
                        <p class="book-status">Checked Out</p>
                    </div>
                </div>

                <div class="book-card" onclick="window.location.href='book_details.php?id=3'">
                    <div class="book-image">
                        <img src="/api/placeholder/200/280" alt="Book Cover">
                    </div>
                    <div class="book-info">
                        <h3 class="book-title">Pride and Prejudice</h3>
                        <p class="book-author">Jane Austen</p>
                        <p class="book-status status-available">Available</p>
                    </div>
                </div>

                <div class="book-card" onclick="window.location.href='book_details.php?id=4'">
                    <div class="book-image">
                        <img src="/api/placeholder/200/280" alt="Book Cover">
                    </div>
                    <div class="book-info">
                        <h3 class="book-title">To Kill a Mockingbird</h3>
                        <p class="book-author">Harper Lee</p>
                        <p class="book-status status-available">Available</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>