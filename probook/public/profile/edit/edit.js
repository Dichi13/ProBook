var nameInput = document.getElementById("name-input");
var nameNotif = document.getElementById("name-notif");
var addressInput = document.getElementById("address-input");
var addressNotif = document.getElementById("address-notif");
var phoneInput = document.getElementById("phone-input");
var phoneNotif = document.getElementById("phone-notif");
var cardInput = document.getElementById("card-input");
var cardNotif = document.getElementById("card-notif");
var editBtn = document.getElementById("edit-btn");

var errorName = false;
var errorAddress = false;
var errorPhone = false;
var errorCard = false;
var t = setInterval(check, 50);

nameInput.addEventListener("keyup", checkname);
addressInput.addEventListener("keyup", checkaddress);
phoneInput.addEventListener("keyup", checkphone);
cardInput.addEventListener("keyup", checkcard);

function checkname() {
    // console.log(nameInput.value);
    if(nameInput.value.trim() == "") {
        nameNotif.innerHTML = "Name input can't be empty";
        errorName = true;        
    } else {
        nameNotif.innerHTML = "";
        errorName = false;
    }
}

function checkaddress() {
    // console.log(nameInput.value);
    if(addressInput.value.trim() == "") {
        addressNotif.innerHTML = "Address input can't be empty";
        errorAddress = true;        
    } else {
        addressNotif.innerHTML = "";
        errorAddress = false;
    }
}

function checkphone() {
    // console.log(nameInput.value);
    if(phoneInput.value.trim() == "") {
        phoneNotif.innerHTML = "Phone input can't be empty";
        errorPhone = true;        
    } else {
        phoneNotif.innerHTML = "";
        errorPhone = false;
    }
}

function checkcard() {
    if(cardInput.value.length != 16) {
        cardNotif.innerHTML = "Please insert a 16 digit card number";
        errorCard = true;
    } else {
        cardNotif.innerHTML = "Validating...";
        var request = new XMLHttpRequest();
        request.open('GET', 'http://localhost:3000/validate/' + cardInput.value, true);
        request.onload = function () {
            var data = JSON.parse(this.response);
            if (request.status == 200 && request.readyState == 4) {
                if(data.values == 0) {
                    cardNotif.innerHTML = "Card number is not a valid card";
                    errorCard = true;
                } else {
                    cardNotif.innerHTML = "";
                    errorCard = false;
                }
            } else {
                console.log('error');
            }
        }
        request.send();
    }
}

function check() {
    if(errorName || errorAddress || errorPhone || errorCard) {
        editBtn.disabled = true;
        editBtn.style.color = '#CCC';
        editBtn.style.backgroundColor = '#AAA';
        editBtn.style.borderColor = '#888';
    } else {
        editBtn.disabled = false;
        editBtn.style.color = '#FFF';
        editBtn.style.backgroundColor = '#00ACF0';
        editBtn.style.borderColor = '#00ACF0';
    }
}