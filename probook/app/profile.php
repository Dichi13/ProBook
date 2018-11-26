<?php 
    if (isset($_COOKIE['has_login'])) {
        $db = mysqli_connect("localhost", "root", "", "probookdb");
        $userid = $_COOKIE['has_login'];
        $queryUsername = "SELECT nama, username, email, alamat, phone, avatar FROM user WHERE userid = $userid";

        $result = mysqli_query($db, $queryUsername);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $nama = $row['nama'];
        $username = $row['username'];
        $email = $row['email'];
        $alamat = $row['alamat'];
        $phone = $row['phone'];
        $avatar = $row['avatar'];
    } else {
        header("location: ../login");
    }
?>