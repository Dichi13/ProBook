<?php 
    // $db = mysqli_connect('localhost', 'root', '', 'probookdb');
    require_once("../../app/init.php");
    
    $jumlah = $_REQUEST['amount'];
    $userid = $_COOKIE['has_login'];
    $bookid = $_REQUEST['book-id'];
    $timezone = date_default_timezone_set("Asia/Jakarta");
    $date = date('Y/m/d');
    NewPurchase($userid, $bookid, $jumlah, $date);
?>