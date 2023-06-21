
document.getElementById("submit").onclick = function (event) {
    var isValid = true;

    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var passwordCheck = document.getElementById("passwordCheck").value;

    var errorUsername = document.getElementById("errorUsername");
    var errorPassword = document.getElementById("errorPassword");
    var errorPasswordCheck = document.getElementById("errorPasswordCheck");


    if (username.length < 5 || username.length > 10) {
        document.getElementById("username").style.border = "1px solid red";
        errorUsername.innerHTML = "Username must be between 5 and 10 characters long!<br>";
        errorUsername.style.color = "red";

        isValid = false;
    } else {
        errorUsername.style.border = "";
    }


    if (password.length < 5 || password.length > 10) {
        document.getElementById("password").style.border = "1px solid red";
        errorPassword.innerHTML = "Password must be between 5 and 15 characters long!<br>";
        errorPassword.style.color = "red";

        isValid = false;
    } else {
        errorPassword.style.border = "";
    }


    if (password != passwordCheck) {
        document.getElementById("passwordCheck").style.border = "1px solid red";
        errorPasswordCheck.innerHTML = "Passwords do not match!";
        errorPasswordCheck.style.color = "red";

        isValid = false;
    } else {
        errorPasswordCheck.style.border = "";
    }


    if (isValid != true) {
        event.preventDefault();
    }

}

