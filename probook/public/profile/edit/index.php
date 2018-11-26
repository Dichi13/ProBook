<?php include("../../../app/profileedit.php"); ?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Profile | Pro-Book</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="../../stylesheets/main.css">
    <link rel="stylesheet" href="../../stylesheets/edit.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="header-primary clear-fix">
                <div class="header-primary__brand">
                    <span class="yellow-color">Pro</span>-Book
                </div>
                <div class="log-out-img__container">
                    <a href="../../../app/logout.php"><img src="../../images/power-button-white.png" alt="log out" id="log-out-img__image"></a>
                </div>
                <div class="user-welcome">
                    <a href="#" class="user-welcome__link">Hi, <?php echo $username ?></a> 
                </div>
            </div>
            <nav class="navbar">
                <li class="navbar__item"><a href="../../browse" class="navbar__link">Browse</a></li><!--
                --><li class="navbar__item"><a href="../../history" class="navbar__link">History</a></li><!--
                --><li class="navbar__item navbar__item--active"><a href="../" class="navbar__link">Profile</a></li>
            </nav>
        </header>
        <main>
            <section class="section-edit">
                <h2 class="heading-secondary">Edit Profile</h2>
                <form action="" class="edit-form" method="POST" enctype="multipart/form-data">
                    <div class="edit-image">
                        <div class="img-div">
                            <?php echo '<img src="../../images/'.$avatar.'" alt="avatar">' ?>
                        </div>
                        <div>
                            <p>Update profile picture</p>
                            <input type="file" name="edit-photo" class="edit-form__photo-input">
                            <?php if(isset($errormsg)) {echo "<p>$errormsg</p>";} ?>
                        </div>
                    </div>
                    <div class="item">
                        <div class="left">Name</div>
                        <input type="text" name="edit-name" class="edit-form__input" value="<?php echo $nama;?>">
                    </div>
                    <div class="item">
                        <div class="left">Address</div>
                        <textarea name="edit-address" class="edit-form__address-input" rows="5"><?php echo $alamat;?></textarea>
                    </div>
                    <div class="item">
                        <div class="left">Phone Number</div>
                        <input type="text" name="edit-phone" class="edit-form__input" value="<?php echo $phone;?>">
                    </div>
                    <button class="form__back-button" onclick="window.location='../'; return false;">Back</button>
                    <input type="submit" value="Save" name="submit" class="form__submit">
                </form>
            </section>
        </main>
    </div>
</body>
</html>