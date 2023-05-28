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
    

       
        .title {
            text-align: center;
            margin: 20px 0;
            font-size: 24px;
        }

        .container-left {
            width: 30%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            background-color: yellow;
        }

        .container-right {
            width: 70%;
            display: flex;
            flex-direction: column;
            background-color: #fff;
            padding: 20px;
            background-color: gray;
        }

        .login-form {
            display: flex;
            flex-direction: column;
        }

        .login-form label {
            margin-bottom: 10px;
            font-size: 16px;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            padding: 10px;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .login-form input[type="submit"] {
            padding: 10px;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

      .center {
        align-items: center;
      }

       
    </style>
</head>
<body>
    <header>
        <div class="title-container">
            <h1>WELT</h1>
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


    <section>
        <div class="container-left">
            <button>Register</button>
            <p>Welcome!</p>
            <p>Create an account or sign in to continue.</p>
        </div>
        <div class="container-right">
            <h2>Login</h2>
            <form method="POST" action="validation.php" class="login-form">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <input type="submit" name="submit" value="Login">
            </form>
        </div>
    </section>

    <footer>
        <h1>WELT</h1>
    </footer>
</body>
</html>