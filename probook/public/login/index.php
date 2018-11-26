<?php include("../../app/login.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="../stylesheets/form.css">
    <title>Login | Pro-Book</title>
</head>
<body>
    <div class="container text-center">
        <div class="wrapper">
            <h1>LOGIN</h1>
            <p><?php if(isset($error)){echo $error;}?></p>
            <form action="" method="GET">
                <div class="input-field">
                    <div class="l"><label>Username</label></div>
                    <div class="r"><input type="text" name="username"></div>
                </div>
                <div class="input-field">
                    <div class="l"><label>Password</label></div>
                    <div class="r"><input type="password" name="password"></div>
                </div>
                <a href="../register/" class="have"><u>Don't have an account?</u></a>
                <button class="btn-login">LOGIN</button>
            </form>
        </div>
    </div>
</body>
</html>