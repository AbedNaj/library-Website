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
    <script src="https://kit.fontawesome.com/200d3f2624.js" crossorigin="anonymous"></script>
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
        <div class="comments-section" id="comments-section">
            <h2 class="comments-title">Comments <?php echo htmlspecialchars($commentsCount)?></h2>

            <!-- Comment Form -->
            <form class="comment-form" method="POST">
                <textarea class="comment-input" name="comment" required="true" placeholder="Leave a comment..."></textarea>
                <button type="submit" class="submit-comment">Submit Comment</button>
             </form>
<?php if(!empty($commentMessage)) :?>

<p class="alert alert-error"> <?php echo "(". htmlspecialchars($commentMessage) .')'?> </p>
<?php endif;?>  

<?php if (!empty($_SESSION['commentDeleted'])) {
    echo '<p class="alert alert-error">' . htmlspecialchars($_SESSION['commentDeleted']) . '</p>';
    unset($_SESSION['commentDeleted']);
}?>




<?php foreach($comments as $comment) : ?>

            <!-- Comments List -->
            <ul class="comments-list">
                <li class="comment">
                   <?php if(isset($_SESSION["user_id"]) && $_SESSION["user_id"] == $comment["user_ID"]) :?>
        <form method="POST">
        <input type="hidden" name="comment_id" value="<?php echo htmlspecialchars( $comment["commentID"])?>">
                  <button action="delete" class="comment-delete-button">

                <i class="fa-regular fa-trash-can comment-delete"></i>
                </button>
                </form>
                <?php endif;?>
                    <p class="comment-author"><?php echo htmlspecialchars($comment["user_name"]) ?></p>
                    <p class="comment-date"><?php echo htmlspecialchars($comment["comment_date"]) ?></p>
                    <p class="comment-content"><?php echo htmlspecialchars($comment["comment"]) ?></p>
             
                </li>

                <?php endforeach  ?>
     
            </ul>
        </div>
    </div>
</body>

</html>