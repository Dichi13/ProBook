<?php 
    $review = $_POST['comment'];
    $rating = $_POST['rating'];
    $purchaseid = $_POST['purchase-id'];
    $userid = $_POST['user-id'];
    $queryUsername = "UPDATE purchase SET review = '$review', rating = $rating WHERE purchaseid = $purchaseid AND userid = $userid";
    $db = mysqli_connect("localhost", "root", "", "probookdb");
    $result = mysqli_query($db, $queryUsername);

    header("location: ../public/history");
?>