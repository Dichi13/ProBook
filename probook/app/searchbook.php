<?php 
    require_once("../../public/browse/getrating.php");
    if (isset($_GET['search-book'])) {
        $db = mysqli_connect("localhost", "root", "", "probookdb");
        $keyword = $_GET['search-book'];
        $querySearch = "SELECT book.bookid, bookname, author, deskripsi, bookimg, IFNULL(avg_rating, 0) AS avg_rating, IFNULL(vote, 0) AS vote FROM book LEFT JOIN (SELECT bookid, round(avg(rating),1) AS avg_rating, count(rating) AS vote FROM purchase GROUP BY bookid) as temp ON book.bookid = temp.bookid WHERE bookname LIKE '%$keyword%'";
        $result = mysqli_query($db, $querySearch);
        $count = mysqli_num_rows($result);

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $bookid = $row['bookid'];
            $bookname = $row['bookname'];
            $author = $row['author'];
            $deskripsi = $row['deskripsi'];
            $bookimg = $row['bookimg'];
            $vote = $row['vote'];
            echo '<div class="section-result">
                    <div class="content-section">
                        <div class="img-div">
                            <img src="../images/'.$bookimg.'" alt="harry-1">
                        </div>
                        <div class="book-content">
                            <div class="book-heading">
                                <h3 class="book-title">'.$bookname.'</h3>
                                <h4>'.$author.' - <span id="rate-avg">'.$avg_rating.'</span>/5.0 (<span id="total-vote">'.$vote.'</span> votes)</h4>
                            </div>
                            <div class="book-description">
                                <p>'.$deskripsi.'</p>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="../book" class="button-div" method="GET">
                    <button class="book-detail" name="book-id" value="'.$bookid.'">Detail</button>
                </form>';
        }
    }
?>