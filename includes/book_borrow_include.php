<?php


include_once("../logic/book_borrow.php");

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrow Request</title>
    <link rel="stylesheet" href="../css/book_borrow.css">

</head>
<body>
    <div class="container">
        <form class="borrow-form" id="borrowForm"  method="POST">
            <div class="form-header">
                <h1 class="form-title">Borrow Request</h1>
                <p>Please review and confirm your borrowing details</p>
            </div>

            <div class="book-info">
                <h2 class="book-title"><?php echo $book["book_name"] ?></h2>
                <p class="book-author"><?php echo $book["author_name"] ?></p>
                <p class="book-availability"><?php echo htmlspecialchars($bookStatuses["book state"])?> 
                (<?php echo htmlspecialchars($bookStatuses["available books"] - $bookStatuses["borrowed books"])  ?> copies left)</p>
            </div>

            <div class="form-group">
                <label for="duration" class="form-label">Borrow Duration</label>
                <div class="borrow-duration">
                    <input type="number" id="duration" name="duration" class="form-input duration-input" min="7" max="30" value="7">
                    <span class="duration-text">days</span>
                </div>
                <div class="error-message" id="durationError">Duration must be between 7 and 30 days</div>
                <p class="info-message">Note: Actual borrow and return dates will be set upon admin approval</p>
            </div>

            <div class="terms">
                <h3 class="terms-title">Borrowing Terms</h3>
                <ul class="terms-list">
                    <li>Books must be returned in the same condition as borrowed</li>
                    <li>Late returns will incur a fee of $0.50 per day</li>
                    <li>Maximum of 3 books can be borrowed at a time</li>
                    <li>Lost or damaged books must be replaced or paid for</li>
                </ul>
            </div>
            <?php if (!empty($message)): ?>
        <div class="alert alert-error"><?php echo "Warning : ". $message; ?></div>
    <?php endif; ?>
            <div class="checkbox-group">
                <label class="checkbox-label">
                    <input type="checkbox" id="termsCheckbox" required>
                    I agree to the borrowing terms and conditions
                </label>
            </div>

            <div class="button-group">
    <button type="submit" class="confirm-button" id="confirmButton">
        Confirm Borrow Request
    </button>
    <button type="button" class="cancel-button" onclick="window.location.href = 'browse'">
        Cancel Borrow Request
    </button>
</div>


        </form>

    </div>

   
</body>
</html>