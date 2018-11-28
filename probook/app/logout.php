<?php
    include("core/functions.php");

    setcookie("has_login", '', time() - 86400, "/");
    header("location: ../public/login");
    $query = "DELETE FROM token WHERE token = $token";
    queryMySQL($query);
?>