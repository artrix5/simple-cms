function setArticleId(radio) {
    var articleIdInput = document.getElementById("article_id");
    var radios = document.getElementsByClassName("article-checkbox");
    for (var i = 0; i < radios.length; i++) {
        if (radios[i] !== radio) {
            radios[i].checked = false;
        }
    }
    if (radio.checked) {
        articleIdInput.value = radio.getAttribute("data-article-id");
    } else {
        articleIdInput.value = "";
    }
}

function clearForm(name) {
    document.getElementById(name).reset();
}

function clearEverything(form, radio) {
    clearForm(form); // Call the clearForm function to reset the form elements
    var radios = document.getElementsByName(radio);
    for (var i = 0; i < radios.length; i++) {
        radios[i].checked = false;
    }
}