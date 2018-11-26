<?php 
    if (isset($_COOKIE['has_login'])) {
        $db = mysqli_connect("localhost", "root", "", "probookdb");
        $userid = $_COOKIE['has_login'];

        $queryUsername = "SELECT username FROM user WHERE userid = $userid";
        $result = mysqli_query($db, $queryUsername);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        $queryGetPurchaseId = "SELECT purchaseid FROM purchase ORDER BY purchaseid DESC LIMIT 1;";
        $result_purchase = mysqli_query($db, $queryGetPurchaseId);
        $row_purchase = mysqli_fetch_array($result_purchase, MYSQLI_ASSOC);

        $transactionID = $row_purchase['purchaseid'] + 1;
        $username = $row['username'];
    } else {
        header("location: ../login/");
    }
?>