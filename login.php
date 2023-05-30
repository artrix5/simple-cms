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

</head>

<body>
    <header>
        <div class="heading-container">
            <h1>WELT</h1>
        </div>
        <nav>
            <ul class="main-menu-ul">
                <li><a href="index.php">Home</a></li>
                <li><a href="category.php?category=politics">Politics</a></li>
                <li><a href="category.php?category=food">Food</a></li>
                <li><a href="login.php">Administrator</a></li>
            </ul>
        </nav>
    </header>


    <section>
        <div class="container-left">
            <div class="register-container">
                <h1>Welcome!</h1>
                <h1>Create an account or sign in to continue.</h1>
                <button class="register-button">Register</button>
            </div>
        </div>
        <div class="container-right">
            <form method="POST" action="validation.php" class="login-form">
                <h2 class="center">Login</h2>
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

    <script>

        var registerButton = document.querySelector('.register-button');
        registerButton.addEventListener('click', function () {
            window.location.href = 'register.php';
        });
        // List of background images
        var images = ['img/img1.jpg', 'img/img2.jpg', 'img/img3.jpg', 'img/img4.jpg', 'img/img5.jpg'];

        // Index of the current image
        var currentIndex = 0;

        // Function to change the background image
        function changeBackgroundImage() {
            var containerRight = document.querySelector('.container-right');
            containerRight.style.backgroundImage = `url('${images[currentIndex]}')`;
            currentIndex = (currentIndex + 1) % images.length;
        }

        // Initial background image change
        changeBackgroundImage();

        // Schedule background image change every 15 seconds
        setInterval(changeBackgroundImage, 15000);
    </script>

</body>

</html>