var usernameDOM = document.getElementById('username-input');
var emailDOM = document.getElementById('email-input');
var passDOM = document.getElementById('password-confirm-input');
var btnregistDOM = document.getElementById('btn-register');
var formDOM = document.getElementById('form-register');
var nameDOM = document.getElementById('name-input');
var truePassDOM = document.getElementById('password-input');
var addressDOM = document.getElementById('address-input');
var phoneDOM = document.getElementById('telephone-input');

var errorUsername = true;
var errorEmail = true;
var errorPassword = true;
var errorName = true;
var errorTruePassword = true;
var errorAddress = true;
var errorPhone = true;
var errorCard = true;

usernameDOM.addEventListener('keyup', checkUsername);
emailDOM.addEventListener('keyup', checkEmail);
passDOM.addEventListener('keyup', checkPass);
nameDOM.addEventListener('keyup', checkName);
truePassDOM.addEventListener('keyup', checkTruePass);
addressDOM.addEventListener('keyup', checkAddress);
phoneDOM.addEventListener('keyup', checkPhone);
cardDOM.addEventListener('keyup', checkCard);

// formDOM.addEventListener('keyup', check);
var t = setInterval(check, 50);

function checkName() {
    var nameNotif = document.getElementById("name-notif");
    var str = nameDOM.value.trim();

    // console.log(str); 
    
    if(str == "") {
        nameNotif.innerHTML = "name can't be empty";
        errorName = true;
    } else {
        nameNotif.innerHTML = "";
        errorName = false;
    }
}

function checkPhone() {
    var phoneNotif = document.getElementById("telephone-notif"); 
    
    if(phoneDOM.value.length < 9 || phoneDOM.value.length > 12) {
        phoneNotif.innerHTML = "Please insert 9 - 12 digits of number";
        errorPhone = true;
    } else {
        phoneNotif.innerHTML = "";
        errorPhone = false;
    }
}

function checkCard() {
    var cardNotif = document.getElementById("card-notif"); 
    
    if(cardDOM.value.length != 16) {
        cardNotif.innerHTML = "Please insert a 16 digit card number";
        errorcard = true;
    } else {
        cardNotif.innerHTML = "";
        errorcard = false;
    }
}

function checkAddress() {
    var address = document.getElementById('address-notif');
    var str = addressDOM.value.trim();
    
    if(str == "") {
        address.innerHTML = "address can't be empty";
        errorAddress = true;
    } else {
        address.innerHTML = "";
        errorAddress = false;
    }
}

function checkUsername() {
    // console.log("check username function");
    var xhr =  new XMLHttpRequest();
    var inputText = document.getElementById('username-input');
    var imgCheck = document.getElementById('check-username');
    var imgCross = document.getElementById('cross-username');
    
    xhr.open('GET', 'fetch.php?username='+inputText.value, true);

    xhr.onload = function(){
        if(this.status == 200) {
    
            if(Number(this.responseText) > 0 || inputText.value == "" || inputText.value.length > 20) {
                imgCheck.style.display = "none";
                imgCross.style.display = "inline-block";
                errorUsername = true;
            } else {
                imgCheck.style.display = "inline-block";
                imgCross.style.display = "none";
                errorUsername = false;
            }
        }
    };
    xhr.send();
}

function checkEmail(){
    // console.log("check email function");
    var xhr =  new XMLHttpRequest();
    var inputText = document.getElementById('email-input');
    var imgCheck = document.getElementById('check-email');
    var imgCross = document.getElementById('cross-email');
    var regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    xhr.open('GET', 'fetch.php?email='+inputText.value, true);

    xhr.onload = function(){
        if(this.status == 200 ) {
    
            if(Number(this.responseText) > 0 || inputText.value == "" || !regex.test(inputText.value)) {
                imgCheck.style.display = "none";
                imgCross.style.display = "inline-block";
                errorEmail = true;
            } else{
                imgCheck.style.display = "inline-block";
                imgCross.style.display = "none";
                errorEmail = false;
            }
        }
    };
    xhr.send();
}

function checkPass(){
    var pass = document.getElementById("password-input");
    var passConfirm = document.getElementById("password-confirm-input");
    var msgPass = document.getElementById("password-confirm-notif");
    // console.log("check pass");

    if(pass.value != passConfirm.value){
        // console.log("not same");
        if(passConfirm.value == ""){
            msgPass.innerHTML = "Password confirm can't be empty";    
        } else {
            msgPass.innerHTML = "Please insert same password";
        }
        errorPassword = true;
    } else {
        // console.log("same");
        msgPass.innerHTML = "";
        errorPassword = false;
    }
}

function checkTruePass(){
    var pass = document.getElementById("password-input");
    var passConfirm = document.getElementById("password-confirm-input");
    var msgPass = document.getElementById("password-confirm-notif");
    var msgPass2 = document.getElementById("password-notif");

    if(pass.value == "" || pass.value != passConfirm.value){
        if(pass.value == ""){
            msgPass2.innerHTML = "Please insert password";
            errorTruePassword = true;
        } else {
            msgPass.innerHTML = "Please insert same password";
            msgPass2.innerHTML = "";
            errorTruePassword = false;    
        }
    } else {
        // console.log("same");
        msgPass2.innerHTML = "";
        msgPass.innerHTML = "";
        errorTruePassword = false;
    }
}

function check() {
    if(errorEmail || errorPassword || errorUsername || errorTruePassword || errorName || errorAddress || errorPhone || errorCard){
        btnregistDOM.disabled = true;
        btnregistDOM.style.color = '#888';
        btnregistDOM.style.borderColor = '#888';
    } else {
        btnregistDOM.disabled = false;
        btnregistDOM.style.color = 'rgb(224, 108, 13)';
        btnregistDOM.style.borderColor = 'rgb(224, 108, 13)';
    }
}