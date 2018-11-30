<?php 
    // $db = mysqli_connect('localhost', 'root', '', 'probookdb');
    require_once("../../app/init.php");
    require_once("../../app/core/functions.php");

    $bookWS = new SoapClient("http://localhost:8080/BookWebservice/bookServlet?wsdl"); 
    
    $token = $_COOKIE['has_login'];
    $userid  = getUserIdFromToken($token);
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
    
    $response = $bookWS->__soapCall("buyBook", array($params));
    
    echo $response->return;

    if ($response->return > 0) {
        NewPurchase($response->return, $userid, $bookid, $jumlah, $date);
    }
?>