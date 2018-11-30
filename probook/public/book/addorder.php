<?php 
    // $db = mysqli_connect('localhost', 'root', '', 'probookdb');
    require_once("../../app/init.php");
    require_once("../../app/core/functions.php");

    $bookWS = new SoapClient("http://localhost:8080/BookWebservice/bookServlet?wsdl"); 
    
    $token = $_COOKIE['has_login'];
    $userid  = getgetUserIdFromToken($token);
    $cardnumber =  getCardNumFromUserId($userid);
    $jumlah = $_REQUEST['amount'];
    $bookid = $_REQUEST['book-id'];
    $timezone = date_default_timezone_set("Asia/Jakarta");
    $date = date('Y/m/d');

    $params = array(
        "arg0" => $_GET['book-id'], 
        "arg1" => $_GET['amount'] , 
        "arg2" => $cardnumber,
    );
    
    $response = $bookWS->buyBook($params);
    
    echo $response;

    if ($response > 0) {
        NewPurchase($response, $userid, $bookid, $jumlah, $date);
    }
?>