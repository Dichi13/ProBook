<?php 
    $querySearch = "SELECT userid, review, rating FROM purchase WHERE bookid = $bookid";
    $result = mysqli_query($db, $querySearch);

    $count = mysqli_num_rows($result);

    if ($count == 0) {
        echo "Tidak ada review.<br>";
    } else {
        $count = 0;
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $userid = $row['userid'];
            $review = $row['review'];
            $rating = $row['rating'];

            if ($rating != NULL) {
                $count = $count + 1;
                $querySearch = "SELECT username, avatar FROM user WHERE userid = $userid";
                $result2 = mysqli_query($db, $querySearch);
                $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);

                $username = $row2['username'];
                $avatar = $row2['avatar'];

                echo '<div class="reviews">
                        <div class="img-avatar">
                            <img src="../images/'.$avatar.'">
                        </div>
                        <div class="review-rating">
                                <img class="review-star" src="../images/star_on.png">
                                <p>'.$rating.'.0 / 5.0</p>
                        </div>
                        <div class="review-content">
                            <p class="username">@'.$username.'</p>
                            <p>'.$review.'</p>
                        </div>
                    </div>';
            }
        }

        if ($count == 0) {
            echo "Tidak ada review.<br>";
        }
    }
?>