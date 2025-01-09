<?php
include_once("../logic/book_details.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details</title>
    <link rel="stylesheet" href="../css/book_details.css">
</head>

<body>
    <div class="container">

        <!-- Book Details -->
        <div class="book-details">
            <div class="book-header">
                <div class="book-cover">
                <img src="../img/<?php echo htmlspecialchars($book["img_url"]); ?>" alt="Book Cover">
                </div>
                <h1 class="book-title"><?php echo htmlspecialchars($book["book_name"]); ?></h1>
                <p class="book-author"><?php echo $book["author_name"]?></p>
            </div>

            <div class="book-availability">
                <p class="availability-status">Status: <span class="status-<?php echo $bookStatuses["book state"] == "Available" ? "available" : "unavailable" ?>"><?php echo htmlspecialchars($bookStatuses["book state"]) ?></span></p>
                <p class="books-count">      <?php echo htmlspecialchars($bookStatuses["available books"] - $bookStatuses["borrowed books"]) ?> copies available out of
           <?php echo htmlspecialchars($bookStatuses["available books"]) ?> total copies</p>
            </div>

            <div class="book-description">
                <h3>Description</h3>
                <p>
                <?php echo $book["book_description"]?>
                </p>
            </div>

            <form action="borrow" method="GET" name="borrow">    
            <input type="hidden" name="book_id" value= <?php echo $book["ID"]?>>
            <input type="hidden" name="IsAvaiable" value= <?php echo $IsAvailable?>>
         <button type="submit" class="borrow-button">Borrow Book</button>
</form>
        </div>

        <!-- Comments Section -->
        <div class="comments-section">
            <h2 class="comments-title">Comments</h2>

            <!-- Comment Form -->
            <form class="comment-form">
                <textarea class="comment-input" placeholder="Leave a comment..."></textarea>
                <button type="submit" class="submit-comment">Submit Comment</button>
            </form>

            <!-- Comments List -->
            <ul class="comments-list">
                <li class="comment">
                    <p class="comment-author">John Doe</p>
                    <p class="comment-date">January 3, 2025</p>
                    <p class="comment-content">This is a fantastic book! I really enjoyed the detailed character
                        development and the vivid descriptions of the 1920s era.</p>
                </li>
                <li class="comment">
                    <p class="comment-author">Jane Smith</p>
                    <p class="comment-date">January 2, 2025</p>
                    <p class="comment-content">One of the classics that truly deserves its status. The symbolism
                        throughout the book is remarkable.</p>
                </li>
            </ul>
        </div>
    </div>
</body>

</html>