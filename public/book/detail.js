var btnOrder = document.getElementById('btn-order');
var modalOrder = document.getElementById('modal-order');
var spanClose = document.getElementById('close');

function toggleModal() {
    modalOrder.classList.toggle('show-modal');
}

window.onclick = function(event) {
    if (event.target == modalOrder) {
        modalOrder.classList.remove('show-modal');
    }
}

spanClose.onclick = function() {
    modalOrder.classList.remove('show-modal');
}

function submitForm() {
    console.log("show modal function");
    var xhr = new XMLHttpRequest();
    var amount = document.getElementById('amount');
    var bookid = document.getElementById('book-id');
    var params = 'amount=' + amount.value + '&book-id=' + bookid.value;
    var url = 'addorder.php?' + params;

    xhr.open('GET', url, false);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            modalOrder.classList.add('show-modal');
        }
    }
    xhr.send(null);
}
let form = document.getElementById('form-input');
form.addEventListener('submit', function(event) {
    event.preventDefault();
})
btnOrder.onclick = function() {
    submitForm();
}