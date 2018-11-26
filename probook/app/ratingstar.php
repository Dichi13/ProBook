<?php 
    $index = 1;

    while ($index <= $avg_rating) {
        echo '<img class="review-star-small" src="../images/star_on.png">';
        $index = $index + 1;
    } 
    while ($index <= 5) {
        echo '<img class="review-star-small" src="../images/star_off.png">';
        $index = $index + 1;
    }
?>