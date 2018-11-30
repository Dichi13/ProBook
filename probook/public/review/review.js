var radio1 = document.getElementById("radio1").checked;
var radio2 = document.getElementById("radio2").checked;
var radio3 = document.getElementById("radio3").checked;
var radio4 = document.getElementById("radio4").checked;
var radio5 = document.getElementById("radio5").checked;
var comment = document.getElementById("comment-input");
var submit = document.getElementById("submit-btn");

console.log(document.getElementById("radio1"));

var errorComment = true;
var t = setInterval(check, 50);

comment.addEventListener("keyup", checkComment);

function checkComment() {
    console.log(comment.value);
    if(comment.value.trim() == "") {
        errorComment = true;        
    } else {
        errorComment = false;
    }
}

function check() {
    if((radio1 || radio2 || radio3 || radio4 || radio5) && !errorComment) {
        submit.disabled = false;
        submit.style.color = '#FFF';
        submit.style.backgroundColor = '#00ACF0';
        submit.style.borderColor = '#00ACF0';
    } else {
        alert("hehe");
        submit.disabled = true;
        submit.style.color = '#CCC';
        submit.style.backgroundColor = '#AAA';
        submit.style.borderColor = '#888';
    }
}