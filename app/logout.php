<?php
    setcookie("has_login", '', time() - 86400, "/");
    header("location: ../public/login");
?>