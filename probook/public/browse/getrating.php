<?php 
    if (isset($_GET['bookid'])) {
        $db = mysqli_connect("localhost", "root", "", "probookdb");
        $bookid = $_GET['bookid'];
        $querySearch = "SELECT AVG(rating) AS avg_rating FROM purchase WHERE bookid = '$bookid'";
        $result = mysqli_query($db, $querySearch);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC)

        $count = mysqli_num_rows($result);

        if($count == 1){
            echo $row['avg_rating'];
        }else{
            echo 0;
        }
    }
?>