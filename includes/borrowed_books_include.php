
<?php
 include_once "../logic/borrowed_books_logic.php";
include_once "../constants.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Borrowed Books</title>
 <link rel="stylesheet"  href="../css/borrowed_books.css">
</head>
<body>

    <div class="container">
        <div class="borrowed-books">
            <h1 class="page-title">My Borrowed Books</h1>
            
<?php foreach ($borrows as $borrow) : ?>


            <div class="book-card">
                <img src="<?php echo "../img/". htmlspecialchars($borrow["img_url"]) ?> " alt="Book Cover" class="book-cover">
                <div class="book-details">
                    <h2 class="book-title"><?php echo htmlspecialchars($borrow["book_name"])?></h2>
                    <p class="book-author"><?php echo htmlspecialchars($borrow["author_name"])?></p>
                    <div class="dates">
                        <div>

                        <?php if ($borrow["rent_state"] == 'Pending') : ?>
                            <p class="date-label">Request Date</p>
                            <p class="date-value"><?php echo htmlspecialchars($borrow["request_date"])?></p>

                            <p class="date-label">Borrow Days</p>
                            <p class="date-value"><?php echo htmlspecialchars($borrow["rent_days_count"])?></p>

               
                            <?php else :?>
                            <p class="date-label">Rent Date</p>
                            <p class="date-value"><?php echo htmlspecialchars($borrow["rent_date"])?></p>

                            <?php endif; ?>
                        </div>
                        <div>
                        <?php if ($borrow["rent_state"] == 'Pending') : ?>
                            <p class="date-label">Actions</p>
                            <form METHOD="POST">
                
                                <input type="hidden" name="rent_id" value="<?php echo htmlspecialchars($borrow["ID"])?>">
      
                            <button class="cancel-button">Cancel Request</button>
                            </form>
                         
                            <?php else :?>
                                <p class="date-label">Return Date</p>
                                <p class="date-value"><?php echo htmlspecialchars($borrow["return_expiry_date"])?></p>

                            <?php endif; ?>
     
                        </div>
                    </div>
                    <span class="status 
                    <?php if($borrow["rent_state"] == "Approved")
                    echo "status-approved";
                     elseif($borrow["rent_state"] == "Rejected")
                echo"status-rejected ";
            else
            echo "status-pending";
        
                ?>
                
                    "><?php echo htmlspecialchars($borrow["rent_state"])?></span>
                    <div class="return-info">

                    <?php if ($borrow["days_remaining"] < 0 && $borrow["return_date"] == null) :  ?>

                          <div class="days-left danger"><?php echo htmlspecialchars(abs($borrow["days_remaining"])) ?> days overdue</div>
                        <div class="fees">
                            <p class="fees-label">Late Fees:</p>
                            <p class="fees-amount"><?php echo htmlspecialchars(abs($borrow["days_remaining"])*0.5)?>$ ($0.50 per day)</p>
                        </div>
                        <?php elseif($borrow["days_remaining"] > 0 && $borrow["return_date"] == null) : ?>
                            <div class="days-left good"><?php echo htmlspecialchars($borrow["days_remaining"]) ?> days left to return</div>
                        <?php elseif($borrow["return_date"] != null) : ?>
                            <div class="days-left good">Returned on <?php echo htmlspecialchars($borrow["return_date"]) ?></div>
                  <?php endif;?>
                
                    </div>
                </div>
            </div>
<?php endforeach; ?>


          

</body>
</html>