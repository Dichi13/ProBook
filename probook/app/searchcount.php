<?php 
    if (isset($_GET['search-book'])) {
        $db = mysqli_connect("localhost", "root", "", "probookdb");
        $keyword = $_GET['search-book'];
        $querySearch = "SELECT bookid, bookname, author, deskripsi, bookimg FROM book WHERE bookname LIKE '%$keyword%'";

        $result = mysqli_query($db, $querySearch);
        $count = mysqli_num_rows($result);
    }
?>