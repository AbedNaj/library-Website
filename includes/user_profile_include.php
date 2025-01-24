<?php
include_once("../logic/profile.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - Library</title>
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
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Profile Header */
        .profile-header {
            background: white;
            border-radius: 1.5rem;
            padding: 2.5rem;
            box-shadow: var(--card-shadow);
            display: flex;
            align-items: center;
            gap: 2.5rem;
            margin-bottom: 2rem;
        }

        .profile-avatar {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), #7c3aed);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 4.5rem;
            font-weight: 600;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            flex-shrink: 0;
        }

        .profile-info {
            flex-grow: 1;
        }

        .profile-name {
            font-size: 2.25rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .profile-email {
            color: var(--text-light);
            margin-bottom: 1.5rem;
        }

        .profile-stats {
            display: flex;
            gap: 2.5rem;
            background-color: rgba(37, 99, 235, 0.05);
            padding: 1.5rem;
            border-radius: 1rem;
        }

        .stat {
            text-align: center;
            flex: 1;
        }

        .stat-number {
            font-size: 1.75rem;
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .edit-profile {
            background-color: var(--primary-color);
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-left: auto;
        }

        .edit-profile:hover {
            background-color: #1d4ed8;
            transform: translateY(-3px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Profile Sections */
        .profile-section {
            background: white;
            border-radius: 1.5rem;
            padding: 2.5rem;
            box-shadow: var(--card-shadow);
            margin-bottom: 2rem;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.5rem;
            color: var(--text-dark);
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f3f4f6;
        }

        .section-title i {
            color: var(--primary-color);
            font-size: 1.75rem;
        }

        .book-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 1.5rem;
        }

        .book-card {
            background: var(--background-light);
            border-radius: 1rem;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .book-card img {
            width: 150px;
            height: 200px;
            object-fit: cover;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            box-shadow: var(--card-shadow);
        }

        .book-card-title {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
            font-size: 1rem;
        }

        .book-card-author {
            color: var(--text-light);
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .book-card-return {
            color: #10b981;
            font-size: 0.85rem;
            background-color: rgba(16, 185, 129, 0.1);
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            margin-top: 0.5rem;
        }

        .book-card-due {
            color: #ef4444;
            font-size: 0.85rem;
            background-color: rgba(239, 68, 68, 0.1);
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            margin-top: 0.5rem;
        }

        .preferences {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 1rem;
        }

        .preference-tag {
            background: rgba(37, 99, 235, 0.1);
            color: var(--primary-color);
            padding: 0.75rem 1.25rem;
            border-radius: 2rem;
            text-align: center;
            font-size: 0.9rem;
            transition: background-color 0.3s ease;
        }

        .preference-tag:hover {
            background: rgba(37, 99, 235, 0.15);
        }

        @media (max-width: 768px) {
            .profile-header {
                flex-direction: column;
                text-align: center;
            }

            .profile-stats {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Profile Header -->
        <div class="profile-header">
            <div class="profile-avatar">
                <?php echo strtoupper(substr($userDate['user_name'], 0, 2)); ?>
            </div>
            <div class="profile-info">
                <h1 class="profile-name"><?php echo htmlspecialchars($userDate['user_name']); ?></h1>
                <p class="profile-email"><?php echo htmlspecialchars($userDate['user_email']); ?></p>
                <div class="profile-stats">
                    <div class="stat">
                        <div class="stat-number"><?php echo htmlspecialchars($BooksRead['BooksRead']); ?></div>
                        <div class="stat-label">Books Read</div>
                    </div>
                    <div class="stat">
                        <div class="stat-number"><?php echo htmlspecialchars($CurrentlyBorrowedCount['CurrentlyBorrowed']); ?></div>
                        <div class="stat-label">Currently Borrowed</div>
                    </div>
                    <div class="stat">
                        <div class="stat-number"><?php echo htmlspecialchars($commentsCount['commentsCount']); ?></div>
                        <div class="stat-label">Comments</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Currently Borrowed -->
        <div class="profile-section">
            <h2 class="section-title">
                <i class="ri-book-open-line"></i>
                Currently Borrowed Books
            </h2>
            <div class="book-list">
                <?php if (empty($currentlyBorrowed)): ?>
                    <p class="no-books">No books currently borrowed</p>
                <?php else: ?>
                    <?php foreach ($currentlyBorrowed as $curBorrowed): ?>
                        <div class="book-card">
                            <img src="../img/<?php echo htmlspecialchars($curBorrowed['img_url']); ?>" alt="Book Cover">
                            <div class="book-card-title"><?php echo htmlspecialchars($curBorrowed['book_name']); ?></div>
                            <div class="book-card-author"><?php echo htmlspecialchars($curBorrowed['author_name']); ?></div>
                            <div class="<?php echo $curBorrowed['remining_days'] >= 0 ? "book-card-return" : "book-card-due"; ?>">
                                <?php echo $curBorrowed['remining_days'] >= 0
                                    ? "Return in " . htmlspecialchars($curBorrowed['remining_days']) . " days"
                                    : "Overdue by " . htmlspecialchars(abs($curBorrowed['remining_days'])) . " days"; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Reading History -->
        <div class="profile-section">
            <h2 class="section-title">
                <i class="ri-book-marked-line"></i>
                Recently Returned
            </h2>
            <div class="book-list">
                <?php if (empty($recentReturned)): ?>
                    <p class="no-books">No recently returned books</p>
                <?php else: ?>
                    <?php foreach ($recentReturned as $recentReturn): ?>
                        <div class="book-card">
                            <img src="../img/<?php echo htmlspecialchars($recentReturn['img_url']); ?>" alt="Book Cover">
                            <div class="book-card-title"><?php echo htmlspecialchars($recentReturn['book_name']); ?></div>
                            <div class="book-card-author">Returned: <?php echo htmlspecialchars($recentReturn['return_date']); ?></div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>