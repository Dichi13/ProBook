<?php
    if (isset($_GET['username'])) {
        $db = mysqli_connect("localhost", "root", "", "probookdb");

        $username = $_GET['username'];
        $password = md5($_GET['password']);

        $query = "SELECT userid FROM user WHERE username = '$username' and password = '$password'";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        echo $row["userid"];

        $count = mysqli_num_rows($result);
        if ($count == 1) {
            $cookie_name = "has_login";
            $cookie_value = $row["userid"];
            setcookie($cookie_name, $cookie_value, time() + 86400, "/");

            header("location: ../browse");
        } else {
            $error = "Kesalahan kredensial login.";
        }
    }
?>