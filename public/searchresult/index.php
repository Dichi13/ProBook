<?php include("../../app/fetch.php"); ?>
<?php include("../../app/searchcount.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../stylesheets/search-result.css">
    <link rel="stylesheet" href="../stylesheets/main.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <title>Search Result | Pro-Book</title>
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
                <li class="navbar__item navbar__item--active"><a href="../browse" class="navbar__link">Browse</a></li><!--
                --><li class="navbar__item"><a href="../history" class="navbar__link">History</a></li><!--
                --><li class="navbar__item"><a href="../profile" class="navbar__link">Profile</a></li>
            </nav>
        </header>
        <main>
            <div class="section-result">
                <div class="title-section">
                    <div class="title">
                        <h2 class="heading-secondary">Search Result</h2>
                    </div>
                    <div class="result-count">
                        <p>Found <u><strong><?php echo $count; ?></strong></u> result(s)</p>
                    </div>
                </div>
            </div>
            <?php include('../../app/searchbook.php'); ?>
        </main>
    </div>
</body>
</html>