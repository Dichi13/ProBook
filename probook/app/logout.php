<?php
    include("core/functions.php");

    $token = $_COOKIE["has_login"];
    setcookie("has_login", '', time() - 86400, "/");
    header("location: ../public/login");
    $query = "DELETE FROM token WHERE tokenstring = '$token'";
    queryMySQL($query);
?>