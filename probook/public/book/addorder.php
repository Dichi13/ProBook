<?php 
    // $db = mysqli_connect('localhost', 'root', '', 'probookdb');
    require_once("../../app/init.php");
    require_once("../../app/core/functions.php");

    $bookurl = "localhost:8080/BookWebservice/bookServlet?wsdl";
    $bookWS = new SoapClient($bookurl); 
    $token = $_COOKIE['has_login'];
    $cardnumber =  getCardNumFromUserId(getgetUserIdFromToken($token));
    
    $params = array("book_id" => $_GET['book-id'], "num" => $_GET['amount'] , "account" => $cardnumber);
    $response = $bookWS->buyBook($params);
    echo $response;
    if ($response > 0) {
        NewPurchase($response);
    }
    $jumlah = $_REQUEST['amount'];
    $bookid = $_REQUEST['book-id'];
    $timezone = date_default_timezone_set("Asia/Jakarta");
    $date = date('Y/m/d');
    NewPurchase($userid, $bookid, $jumlah, $date);
?>