<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>WELT</title>
    <meta name="description" content="PWA Project">
    <meta name="author" content="Adrian Lokner Lađević">
    <meta name="keywords" content="HTML, CSS, PHP">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="basic-styles.css">
    <link rel="stylesheet" href="class-styles.css">

    <style>
        .container {
            display: flex;
            width: 100%;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-container {
            flex: 1;
            padding: 20px;
        }

        form {
            width: 50%;
        }

        .form-container h2 {
            margin-top: 0;
        }

        .form-container input[type="text"],
        .form-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
        }

        .form-container input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .navigation-bar {
            flex: 0 0 200px;
            background-color: #333;
            color: #fff;
            padding: 20px;
        }

        .navigation-bar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .navigation-bar ul li {
            margin-bottom: 10px;
        }

        .navigation-bar ul li a {
            color: #fff;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <header>

        <div class="title-container">
            <h1>WELT</h1>
            <h2 class="align-right"><a href="login.php">Login</a></h2>
        </div>
        <nav>
            <ul class="ul">

                <li><a href="index.php">Home</a></li>
                <li><a href="category.php?category=politics">Politics</a></li>
                <li><a href="category.php?category=food">Food</a></li>
                <li><a href="login.php">Administrator</a></li>
            </ul>
        </nav>

    </header>


    <div class="container">
        <div class="form-container">
            <h2>Modify Article</h2>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <label for="article_id">Article ID:</label>
                <input type="text" name="article_id" id="article_id" required>

                <label for="headline">Headline:</label>
                <input type="text" name="headline" id="headline">

                <label for="content">Content:</label>
                <textarea name="content" id="content"></textarea>

                <label for="image">Image URL:</label>
                <input type="text" name="image" id="image">

                <input type="checkbox" name="delete" id="delete">
                <label for="delete">Delete article</label>

                <input type="submit" name="submit" value="Submit">
            </form>
        </div>

        <div class="navigation-bar">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Articles</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
    </div>

    <footer>

        <h1>WELT</h1>

    </footer>



</body>

</html>