<?php 
    include("core/functions.php");

    if (isset($_COOKIE['has_login'])) {
        $db = mysqli_connect("localhost", "root", "", "probookdb");
        $token = $_COOKIE['has_login'];

        $userid = getUserIdFromToken($token);

        if ($userid != 0) {
            $queryUsername = "SELECT username FROM user WHERE userid = $userid";
            $result = mysqli_query($db, $queryUsername);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
            $username = $row['username'];
    
            $queryGetPurchaseId = "SELECT purchaseid FROM purchase ORDER BY purchaseid DESC LIMIT 1;";
            $result_purchase = mysqli_query($db, $queryGetPurchaseId);
            $row_purchase = mysqli_fetch_array($result_purchase, MYSQLI_ASSOC);
    
            $transactionID = $row_purchase['purchaseid'] + 1;
        } else {
            header("location: ../login/");
            setcookie("has_login", '', time() - 86400, "/");
            $query = "DELETE FROM token WHERE tokenstring = '$token'";
            queryMysql($query);
        }
    } else {
        header("location: ../login/");
    }
?>