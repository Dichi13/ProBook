<?php
    error_reporting(E_ERROR | E_PARSE);
    if (isset($_COOKIE['has_login'])) {
        $db = mysqli_connect("localhost", "root", "", "probookdb");
        $userid = $_COOKIE['has_login'];
        $queryUsername = "SELECT nama, username, email, alamat, phone, nomorkartu, avatar FROM user WHERE userid = $userid";

        $result = mysqli_query($db, $queryUsername);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $nama = $row['nama'];
        $username = $row['username'];
        $email = $row['email'];
        $alamat = $row['alamat'];
        $phone = $row['phone'];
        $nomorkartu = $row['nomorkartu'];
        $avatar = $row['avatar'];
    } else {
        header("location: ../../login/");
    }

    $dir = "../../images/";
    $error = 1;
    $haschanged = 0;

    if(ISSET($_POST["submit"])) {
        $target = $dir.basename($_FILES["edit-photo"]["name"]);

        if(getimagesize($_FILES["edit-photo"]["tmp_name"]) !== false) {
            $error = 0;
        } else {
            $errormsg = "File tidak valid.";
        }

        $editname = $_POST['edit-name'];
        $editaddress = $_POST['edit-address'];
        $editphone = $_POST['edit-phone'];
        $editcard = $_POST['edit-card'];
        if ($editname !== $nama || $editaddress !== $alamat || $editphone !== $phone || $editcard !== $nomorkartu) {
            $haschanged = 1;
        }

        if ($error == 0 || $haschanged == 1) {
            if($error == 0 && move_uploaded_file($_FILES["edit-photo"]["tmp_name"], $target)) {
                $editavatar = basename($_FILES["edit-photo"]["name"]);
                $queryUsername = "UPDATE user SET avatar = '$editavatar' WHERE userid = $userid";
    
                $result = mysqli_query($db, $queryUsername);
            }

            $queryUsername = "UPDATE user SET nama = '$editname', alamat = '$editaddress', phone = '$editphone', nomorkartu = '$editcard' WHERE userid = $userid";
            $result = mysqli_query($db, $queryUsername);

            header("location: ../");
        }
    }
?>