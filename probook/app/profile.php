<?php
    include("fetch.php");
    if (isset($_COOKIE['has_login'])) {
        $query = "SELECT nama, username, email, alamat, phone, nomorkartu, avatar FROM user WHERE userid = $userid";
        $result = queryMysql($query);

        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $nama = $row['nama'];
        $username = $row['username'];
        $email = $row['email'];
        $alamat = $row['alamat'];
        $phone = $row['phone'];
        $nomorkartu = $row['nomorkartu'];
        $avatar = $row['avatar'];
    } else {
        header("location: ../login");
    }
?>