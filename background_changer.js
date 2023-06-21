var images = ['backgrounds/abstract1.jpg', 'backgrounds/abstract2.jpg', 'backgrounds/abstract3.png', 'backgrounds/abstract4.jpg', 'backgrounds/abstract5.png'];

// Index of the current image
var currentIndex = 0;

// Function to change the background image
function changeBackgroundImage() {


    var containerRight = document.getElementById('changeBackground');
    containerRight.style.backgroundImage = `url('${images[currentIndex]}')`;

    currentIndex = (currentIndex + 1) % images.length;
}


// Initial background image change
changeBackgroundImage();

// Schedule background image change every 15 seconds
setInterval(changeBackgroundImage, 8000);