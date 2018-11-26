<?php

require_once "../../app/init.php";

// get parameter from URL
if(isset($_REQUEST["username"])){
    $username = $_REQUEST["username"];
    
    $user = queryMysql("SELECT COUNT(userid) FROM user WHERE username = '$username';");
    $numrow = $user->fetch_row();
    $count = $numrow[0];
    
    echo $count;
}

if(isset($_REQUEST["email"])) {
    $email = $_REQUEST["email"];
    
    $user = queryMysql("SELECT COUNT(userid) FROM user WHERE email = '$email';");
    $numrow = $user->fetch_row();
    $count = $numrow[0];
    
    echo $count;
}


?>