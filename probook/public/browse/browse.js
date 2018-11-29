var searchDOM = document.getElementById("search-input");
var searchNotif = document.getElementById("search-notif");
var searchBtn = document.getElementById("search-btn");

searchDOM.addEventListener("keyup", searchCheck);

window.addEventListener("load", function(event){
    searchBtn.disabled = true;
    searchBtn.style.backgroundColor = '#888';
});

function searchCheck(){
    var search = searchDOM.value.trim();
    
    if(search === "") {
        searchNotif.innerHTML = "search can't be empty";
        searchBtn.disabled = true;
        searchBtn.style.backgroundColor = '#888';
    } else {
        searchNotif.innerHTML = "";
        searchBtn.disabled = false;
        searchBtn.style.backgroundColor = '#00ACF0';
    }
}z