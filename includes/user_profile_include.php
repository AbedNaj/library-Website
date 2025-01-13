<?php
include_once("../logic/profile.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - Library</title>
    <link rel="stylesheet" href="../css/user_profile.css">
</head>
<body>


    <div class="container">
        <!-- Profile Header -->
        <div class="profile-header">
            <div class="profile-avatar">
                JD
            </div>
            <div class="profile-info">
                <h1 class="profile-name"><?php echo htmlspecialchars($userDate['user_name'])?></h1>
                <p class="profile-email"><?php echo htmlspecialchars($userDate['user_email'])?></p>
                <div class="profile-stats">
                    <div class="stat">
                        <div class="stat-number"><?php echo htmlspecialchars($BooksRead['BooksRead'])?></div>
                        <div class="stat-label">Books Read</div>
                    </div>
                    <div class="stat">
                        <div class="stat-number"><?php echo htmlspecialchars($CurrentlyBorrowedCount['CurrentlyBorrowed'])?></div>
                        <div class="stat-label">Currently Borrowed</div>
                    </div>
                    <div class="stat">
                        <div class="stat-number"><?php echo htmlspecialchars($commentsCount['commentsCount'])?></div>
                        <div class="stat-label">Comments</div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Currently Borrowed -->
        <div class="profile-section">
            <h2 class="section-title">Currently Borrowed Books</h2>
            <div class="book-list">

            <?php foreach($currentlyBorrowed as $curBorrowed) : ?>
                <div class="book-card">
                    <img src="../img/<?php echo htmlspecialchars($curBorrowed['img_url'])?>" alt="Book Cover">
                    <div class="book-card-title"><?php echo htmlspecialchars($curBorrowed['book_name'])?></div>
                    <div class="book-card-author"><?php echo htmlspecialchars($curBorrowed['author_name'])?></div>
                    <div class="<?php echo htmlspecialchars($curBorrowed['remining_days']) >= 0 ? "book-card-return" : "book-card-due"?>"><?php echo htmlspecialchars($curBorrowed['remining_days']) >= 0 ? "Return in " : "Overdue"?> <?php echo htmlspecialchars($curBorrowed['remining_days']) >= 0 
                    ? htmlspecialchars($curBorrowed['remining_days']) : htmlspecialchars(abs($curBorrowed['remining_days']))?> days</div>
                </div>
               <?php endforeach; ?>


<?php if (empty($currentlyBorrowed)){

echo "No Books Borrowed";
} ?>
        </div>



        <!-- Reading History -->
        <div class="profile-section">
            <h2 class="section-title">Recently Returned</h2>
            <div class="book-list">

            <?php foreach($recentReturned as $recentReturn) : ?>
                <div class="book-card">
                    <img src="../img/<?php echo htmlspecialchars($recentReturn['img_url']) ?>" alt="Book Cover">
                    <div class="book-card-title"><?php echo htmlspecialchars($recentReturn['book_name']) ?></div>
                    <div class="book-card-author"><?php echo htmlspecialchars("Returned : ".$recentReturn['return_date']) ?></div>
                </div>
<?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>