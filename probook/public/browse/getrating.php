<?php 
    if (isset($_GET['bookid'])) {
        $db = mysqli_connect("localhost", "root", "", "probookdb");
        $bookid = $_GET['bookid'];
        $querySearch = "SELECT AVG(rating) AS avg_rating FROM purchase WHERE bookid = '$bookid'";
        $result = mysqli_query($db, $querySearch);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if($row['avg_rating'] != NULL){
            echo $row['avg_rating'];
        }else{
            echo "0";
        }
    }
?>