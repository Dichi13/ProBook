<?php include("../../app/profile.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Profile | Pro-Book</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="../stylesheets/main.css">
    <link rel="stylesheet" href="../stylesheets/profile.css">
</head>
<body>
    <div class="container">   
        <header>
            <div class="header-primary clear-fix">
                <div class="header-primary__brand">
                    <span class="yellow-color">Pro</span>-Book
                </div>
                <div class="log-out-img__container">
                    <a href="../../app/logout.php"><img src="../images/power-button-white.png" alt="log out" id="log-out-img__image"></a>
                </div>
                <div class="user-welcome">
                    <a href="#" class="user-welcome__link">Hi, <?php echo $username ?></a> 
                </div>
            </div>
            <nav class="navbar">
                <li class="navbar__item"><a href="../browse" class="navbar__link">Browse</a></li><!--
                --><li class="navbar__item"><a href="../history" class="navbar__link">History</a></li><!--
                --><li class="navbar__item navbar__item--active"><a href="../profile" class="navbar__link">Profile</a></li>
            </nav>
        </header>
        <main>
            <div class="profile-header">
                <div class="profile-overview">
                    <div class="img-div">
                        <?php echo '<img src="../images/'.$avatar.'" alt="avatar">' ?>
                    </div>
                    <p><?php echo $nama ?></p>
                </div>
                <a href="edit/"><img src="../images/edit-pencil-white.png" alt="edit" id="edit-img"></a>
            </div>
            <section class="section-profile-details">
                <h3 class="heading-tertiary">My Profile</h3>
                <div class="content">
                    <div>
                        <div class="left"><img src="../images/user-icon.png" id="icon"> Username</div>
                        <div class="right">@<?php echo $username ?></div>
                    </div>
                    <div>
                        <div class="left"><img src="../images/envelope.png" id="icon"> Email</div>
                        <div class="right"><?php echo $email ?></div>
                    </div>
                    <div>
                        <div class="left"><img src="../images/home.png" id="icon"> Address</div>
                        <div class="right"><?php echo $alamat ?></div>
                    </div>
                    <div>
                        <div class="left"><img src="../images/phone.png" id="icon"> Phone Number</div>
                        <div class="right"><?php echo $phone ?></div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>