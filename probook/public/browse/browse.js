var fieldDOM = document.getElementById('search-input');
fieldDOM.addEventListener('keyup', checkField);

function checkField() {
    var texts = document.getElementsByClassName("result-count");
    var str = fieldDOM.value.trim();
    
    if(str == "") {
        texts[0].style.visibility = "hidden";
    } else {
        texts[0].style.visibility = "visible";
    }
}