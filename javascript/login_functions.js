var images = ['../images/abstract1.jpg', '../images/abstract2.jpg', '../images/abstract3.png', '../images/abstract4.jpg', '../images/abstract5.png'];

// Index of the current image
var currentIndex = 0;

// Function to change the background image
function changeBackgroundImage() {


    var containerRight = document.getElementById('background');
    containerRight.style.backgroundImage = `url('${images[currentIndex]}')`;

    currentIndex = (currentIndex + 1) % images.length;

}

// Initial background image change
changeBackgroundImage();

// Schedule background image change every 5 seconds
setInterval(changeBackgroundImage, 5000);

function showRegisterScreen() {
    window.location.href = 'register.php';
}


function confirmLogout() {
    if (confirm("Are you sure you want to logout?")) {
        // If user clicks "OK", proceed with logout by redirecting to logout.php
        window.location.href = "logout.php";
    } else {
        // If user clicks "Cancel", prevent the default action (logout)
        return false;
    }
}

function login() {
    window.location.href = "login.php";
}