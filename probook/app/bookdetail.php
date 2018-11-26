<?php 
    if (isset($_GET['book-id'])) {
        $db = mysqli_connect("localhost", "root", "", "probookdb");
        $bookid = $_GET['book-id'];

        $querySearch = "SELECT bookname, author, deskripsi, bookimg, IFNULL(avg_rating, 0) AS avg_rating FROM book LEFT JOIN (SELECT bookid, round(avg(rating),1) AS avg_rating FROM purchase GROUP BY bookid) as temp ON book.bookid = temp.bookid WHERE book.bookid = $bookid";
        $result = mysqli_query($db, $querySearch);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        $bookname = $row['bookname'];
        $author = $row['author'];
        $deskripsi = $row['deskripsi'];
        $bookimg = $row['bookimg'];
        $avg_rating = $row['avg_rating'];
    }
?>