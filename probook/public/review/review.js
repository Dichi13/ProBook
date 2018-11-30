var comment = document.getElementById("comment-input");
var submit = document.getElementById("submit-btn");

var errorComment = true;
var t = setInterval(check, 50);

comment.addEventListener("keyup", checkComment);

function checkComment() {
    if(comment.value.trim() == "") {
        errorComment = true;        
    } else {
        console.log("nya");
        errorComment = false;
    }
}

function check() {
    var radio1 = document.getElementById("rating-1").checked;
    var radio2 = document.getElementById("rating-2").checked;
    var radio3 = document.getElementById("rating-3").checked;
    var radio4 = document.getElementById("rating-4").checked;
    var radio5 = document.getElementById("rating-5").checked;
    
    if((radio1 || radio2 || radio3 || radio4 || radio5) && !errorComment) {
        submit.disabled = false;
        submit.style.color = '#FFF';
        submit.style.backgroundColor = '#00ACF0';
        submit.style.borderColor = '#00ACF0';
    } else {
        submit.disabled = true;
        submit.style.color = '#CCC';
        submit.style.backgroundColor = '#AAA';
        submit.style.borderColor = '#888';
    }
}