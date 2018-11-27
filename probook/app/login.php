<?php
    include("init.php");
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
            $random_string = randomString();
            $userid = $row['userid'];
            $expire = time() + 3600;
            $cookie_name = "has_login";
            $cookie_value = $random_string;
            setcookie($cookie_name, $cookie_value, time() + 86400, "/");
            $query = "INSERT INTO token VALUES ($userid, '$random_string', $expire)";
            $result = mysqli_query($db, $query);

            header("location: ../browse");
        } else {
            $error = "Kesalahan kredensial login.";
        }
    }
?>