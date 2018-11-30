<?php 
    $avg_rating = -1;
    if (isset($_GET['book-id'])) {
        $db = mysqli_connect("localhost", "root", "", "probookdb");
        $bookid = $_GET['book-id'];
        $querySearch = "SELECT AVG(rating) AS avg_rating FROM purchase GROUP BY bookid HAVING bookid = '$bookid'";
        $result = mysqli_query($db, $querySearch);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if($row['avg_rating'] != NULL){
            $avg_rating = $row['avg_rating'];
        } else {
            $avg_rating = "0";
        }
    }
    if (isset($_GET['getby'])) {
        echo number_format($avg_rating, 1);
    }
?>