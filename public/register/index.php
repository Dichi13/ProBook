<?php require_once("../../app/init.php");
    if(isset($_POST['username'])) {
        if($_POST['password_1'] == $_POST['password_2']){
            NewUser($_POST);

            $username = $_POST['username'];
            $query = "SELECT userid FROM user WHERE username = '$username'";
            $result = queryMysql($query);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            $cookie_value = $row["userid"];
            setcookie("has_login", $cookie_value, time() + 86400, "/");

            header("location: ../browse");
        } else {
            echo 'gagal';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="../stylesheets/form.css">
    
        
    <title>Register | Pro-Book</title>
    <style>
        .wrapper {
            margin-top: 5%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="wrapper">
            <h1>REGISTER</h1>
            <!-- action masih kosong -->
            <form action="#" method="POST" id="form-register">
                <div class="input-field">
                    <div class="l"><label>Name</label></div>
                    <div class="r">
                        <input type="text" name="name" id="name-input">
                        <div class="form-notif" id="name-notif"></div>
                    </div>
                </div>
                <div class="input-field">
                    <div class="l"><label id="username">Username</label></div>
                    <div class="r">
                        <div class="input-container">
                            <input type="text" name="username" id="username-input">
                            <img src="../images/check.png" alt="okay" id="check-username" class="check-img">
                            <img src="../images/cross.png" alt="not okay" id="cross-username" class="check-img">
                        </div>
                    </div>
                </div>
                <div class="input-field">
                    <div class="l"><label>Email</label></div>
                    <div class="r">
                        <div class="input-container">
                            <input type="text" name="email" id="email-input">
                            <img src="../images/check.png" alt="okay" id="check-email" class="check-img">
                            <img src="../images/cross.png" alt="not okay" id="cross-email" class="check-img">
                        </div>
                    </div>
                </div>
                <div class="input-field">
                    <div class="l"><label>Password</label></div>
                    <div class="r">
                        <input type="password" name="password_1" id="password-input">
                        <div class="form-notif" id="password-notif"></div>
                    </div>
                </div>
                <div class="input-field">
                    <div class="l"><label>Confirm Password</label></div>
                    <div class="r">
                        <input type="password" name="password_2" id="password-confirm-input">
                        <div class="form-notif" id="password-confirm-notif"></div>
                    </div>
                </div>
                <div class="input-field">
                    <div class="l"><label>Address</label></div>
                    <div class="r">
                        <textarea name="address" cols="19" rows="3" id="address-input"></textarea>
                        <div class="form-notif" id="address-notif"></div>
                    </div>
                </div>
                <div class="input-field">
                    <div class="l"><label>Telephone</label></div>
                    <div class="r">
                        <input type="number" name="telephone" id="telephone-input">
                        <div class="form-notif" id="telephone-notif"></div>
                    </div>
                </div>
                <a href="../login" class="have"><u>Already have an account?</u></a>
                <button class="btn-login" name="register" id="btn-register">REGISTER</button>
            </form>
        </div>
    </div>

    <script src="register.js"></script>
</body>
</html>