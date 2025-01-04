<?php include_once "../logic/browse.php";

?>
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



                <a href="browse">
                    <li class="<?php echo $selectedCategory == null ? 'category-item active' : 'category-item' ?>">All
                        Books
                    </li>
                </a>


                <?php foreach ($categories as $category): ?>
                    <a href="browse?category_id=<?php echo htmlspecialchars($category['ID']); ?>">
                        <li class="category-item <?php echo $selectedCategory == $category['ID'] ? 'active' : ''; ?>">
                            <?php echo htmlspecialchars($category['category_name']); ?>
                        </li>
                    </a>
                <?php endforeach; ?>



            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="content-header">
                <h1>Browse Books</h1>
            </div>

            <div class="book-grid">

                <!-- Sample Book Cards -->
                <?php if ($allBooks == null) {
                    echo "No available Books In this Category";
                } ?>
                <?php foreach ($allBooks as $allBook): ?>


                    <div class="book-card">
                        <div class="book-image">
                            <img src="../img/<?php echo htmlspecialchars($allBook["img_url"]); ?>" alt="Book Cover">
                        </div>
                        <div class="book-info">
                            <h3 class="book-title"><?php echo $allBook["book_name"]; ?></h3>
                            <p class="book-author"><?php echo $allBook["author_name"]; ?></p>
                            <p class="book-status status-available">Available</p>
                        </div>
                    </div>

                <?php endforeach; ?>


            </div>
        </main>
    </div>
</body>

</html>