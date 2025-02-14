<?php
include_once("../logic/book_details.php");
include_once("../includes/header.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2563eb;
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --background-light: #f9fafb;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        body {
            background-color: var(--background-light);
            color: var(--text-dark);
            line-height: 1.6;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Book Details Section */
        .book-details {
            background: white;
            border-radius: 1.5rem;
            padding: 2.5rem;
            box-shadow: var(--card-shadow);
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 2.5rem;
            margin-bottom: 2rem;
        }

        .book-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .book-cover {
            width: 300px;
            height: 450px;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease;
        }

        .book-cover:hover {
            transform: scale(1.03);
        }

        .book-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            background-color: #f0f0f0;
        }

        .book-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.75rem;
        }

        .book-author {
            font-size: 1.1rem;
            color: var(--text-light);
            margin-bottom: 1rem;
        }

        .book-details-content {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .book-availability {
            background-color: rgba(37, 99, 235, 0.05);
            padding: 1.25rem;
            border-radius: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .availability-status {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1rem;
            font-weight: 500;
        }

        .status-available {
            color: #10b981;
        }

        .status-unavailable {
            color: #ef4444;
        }

        .status-icon {
            font-size: 1.25rem;
        }

        .books-count {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .book-description {
            line-height: 1.8;
            color: var(--text-dark);
            background-color: rgba(0, 0, 0, 0.02);
            padding: 1.5rem;
            border-radius: 1rem;
        }

        .borrow-button {
            background-color: var(--primary-color);
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 1rem;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: block;
            margin-top: 1.5rem;
            text-align: center;
            text-decoration: none;
        }

        .borrow-button:hover {
            background-color: #1d4ed8;
            transform: translateY(-3px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Comments Section */
        .comments-section {
            background: white;
            border-radius: 1.5rem;
            padding: 2.5rem;
            box-shadow: var(--card-shadow);
        }

        .comments-title {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.5rem;
            color: var(--text-dark);
            margin-bottom: 1.5rem;
        }

        .comments-title i {
            color: var(--primary-color);
        }

        .comment-form {
            margin-bottom: 2rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .comment-input {
            width: 100%;
            padding: 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 1rem;
            font-size: 1rem;
            resize: vertical;
            min-height: 120px;
            transition: border-color 0.3s ease;
        }

        .comment-input:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .submit-comment {
            align-self: flex-start;
            background-color: var(--primary-color);
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 1rem;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .submit-comment:hover {
            background-color: #1d4ed8;
        }

        .comments-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .comment {
            border-bottom: 1px solid #f3f4f6;
            padding-bottom: 1.5rem;
            position: relative;
        }

        .comment:last-child {
            border-bottom: none;
        }

        .comment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.75rem;
        }

        .comment-author {
            font-weight: 600;
            color: var(--text-dark);
        }

        .comment-date {
            font-size: 0.8rem;
            color: var(--text-light);
        }

        .comment-delete-button {
            background: none;
            border: none;
            color: var(--text-light);
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .comment-delete-button:hover {
            color: #ef4444;
        }

        .alert {
            padding: 1rem;
            border-radius: 1rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .alert-error {
            background-color: rgba(239, 68, 68, 0.1);
            color: #7f1d1d;
        }

        .alert-icon {
            font-size: 1.25rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Book Details -->
        <div class="book-details">
            <div class="book-header">
                <div class="book-cover">
                    <img src="../img/<?php echo htmlspecialchars($book["img_url"]); ?>" alt="Book Cover: <?php echo htmlspecialchars($book["book_name"]); ?>">
                </div>
                <h1 class="book-title"><?php echo htmlspecialchars($book["book_name"]); ?></h1>
                <p class="book-author"><?php echo htmlspecialchars($book["author_name"]); ?></p>
            </div>

            <div class="book-details-content">
                <div class="book-availability">
                    <p class="availability-status">
                        <i class="ri-book-line status-icon"></i>
                        Status:
                        <span class="status-<?php echo $bookStatuses["book state"] == "Available" ? "available" : "unavailable" ?>">
                            <?php echo htmlspecialchars($bookStatuses["book state"]); ?>
                        </span>
                    </p>
                    <p class="books-count">
                        <?php echo htmlspecialchars($bookStatuses["available books"] - $bookStatuses["borrowed books"]) ?>
                        copies available out of
                        <?php echo htmlspecialchars($bookStatuses["available books"]) ?>
                        total copies
                    </p>
                </div>

                <div class="book-description">
                    <h3>Description</h3>
                    <p><?php echo $book["book_description"]; ?></p>
                </div>

                <form action="borrow" method="GET" name="borrow">
                    <input type="hidden" name="book_id" value="<?php echo $book["ID"]; ?>">
                    <input type="hidden" name="IsAvaiable" value="<?php echo $IsAvailable; ?>">
                    <button type="submit" class="borrow-button">Borrow Book</button>
                </form>
            </div>
        </div>

        <!-- Comments Section -->
        <div class="comments-section" id="comments-section">
            <h2 class="comments-title">
                <i class="ri-chat-3-line"></i>
                Comments (<?php echo htmlspecialchars($commentsCount); ?>)
            </h2>

            <!-- Comment Form -->
            <form class="comment-form" method="POST">
                <textarea class="comment-input" name="comment" required placeholder="Share your thoughts about this book..."></textarea>
                <button type="submit" class="submit-comment">Submit Comment</button>
            </form>

            <?php if (!empty($commentMessage)): ?>
                <div class="alert alert-error">
                    <i class="ri-error-warning-line alert-icon"></i>
                    <?php echo htmlspecialchars($commentMessage); ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($_SESSION['commentDeleted'])): ?>
                <div class="alert alert-error">
                    <i class="ri-error-warning-line alert-icon"></i>
                    <?php echo htmlspecialchars($_SESSION['commentDeleted']); ?>
                    <?php unset($_SESSION['commentDeleted']); ?>
                </div>
            <?php endif; ?>

            <!-- Comments List -->
            <ul class="comments-list">
                <?php foreach ($comments as $comment): ?>
                    <li class="comment">
                        <div class="comment-header">
                            <p class="comment-author"><?php echo htmlspecialchars($comment["user_name"]); ?></p>
                            <p class="comment-date"><?php echo htmlspecialchars($comment["comment_date"]); ?></p>
                            <?php if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] == $comment["user_ID"]): ?>
                                <form method="POST">
                                    <input type="hidden" name="comment_id" value="<?php echo htmlspecialchars($comment["commentID"]); ?>">
                                    <button type="submit" class="comment-delete-button">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
                        <p class="comment-content"><?php echo htmlspecialchars($comment["comment"]); ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</body>

</html>