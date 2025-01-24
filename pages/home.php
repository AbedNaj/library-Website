<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookCom - Your Digital Library Experience</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #0097b2;
            --secondary-color: #018ca4;
            --background-color: #f4f4f4;
            --text-color: #333;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            background-color: var(--background-color);
            color: var(--text-color);
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 0;
        }

        .hero {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            text-align: center;
            padding: 4rem 0;
            clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .hero p {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .features {
            display: flex;
            justify-content: space-around;
            margin-top: -50px;
            padding: 2rem;
        }

        .feature {
            background: white;
            text-align: center;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 30%;
            transition: transform 0.3s ease;
        }

        .feature:hover {
            transform: translateY(-10px);
        }

        .feature i {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .cta-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn {
            display: inline-block;
            padding: 0.8rem 1.5rem;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s ease;
            font-weight: bold;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
        }

        .btn-secondary {
            background-color: white;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
        }

        .btn-secondary:hover {
            background-color: var(--primary-color);
            color: white;
        }
    </style>
</head>

<body>
    <?php include 'includes/header.php'; ?>
    <div class="hero">
        <div class="container">
            <h1>BookCom Library</h1>
            <p>Discover, Borrow, and Explore a World of Knowledge at Your Fingertips</p>
            <div class="cta-buttons">
                <a href="browse" class="btn btn-primary">Browse Books</a>
                <a href="signup" class="btn btn-secondary">Create Account</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="features">
            <div class="feature">
                <i class="fas fa-book"></i>
                <h3>Vast Collection</h3>
                <p>Explore thousands of books across various genres and categories.</p>
            </div>
            <div class="feature">
                <i class="fas fa-comment"></i>
                <h3>Community Reviews</h3>
                <p>Read and share book reviews from fellow readers.</p>
            </div>
            <div class="feature">
                <i class="fas fa-mobile-alt"></i>
                <h3>Easy Access</h3>
                <p>Borrow and manage your books from any device, anytime.</p>
            </div>
        </div>
    </div>
</body>

</html>