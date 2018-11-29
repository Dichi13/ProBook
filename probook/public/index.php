<?php
    if (isset($_COOKIE['has_login'])) {
        header("location: ../public/browse");
    } else {
        header("location: ../public/login");
    }
?>
