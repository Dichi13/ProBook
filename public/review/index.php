<?php include("../../app/fetch.php"); ?>
<?php include("../../app/bookdetail.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Review | Pro-Book</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="../stylesheets/main.css" />
    <link rel="stylesheet" href="../stylesheets/review.css">
    <script src="main.js"></script>
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
                --><li class="navbar__item navbar__item--active"><a href="../history" class="navbar__link">History</a></li><!--
                --><li class="navbar__item"><a href="../profile" class="navbar__link">Profile</a></li>
            </nav>
        </header>
        <main>
            <section class="section-review-book">
                <div class="review-primary clear-fix">
                    <div class="review-primary__desc">
                        <h2 class="heading-secondary"><?php echo $bookname?></h2>
                        <h4 class="heading-quartiary"><?php echo $author?></h4>
                    </div>
                    <div class="review-primary__image-container">
                        <img src="../images/<?php echo $bookimg ?>" alt="book images" class="review-primary__image">
                    </div>
                </div>
                <div class="content">
                    <form action="../../app/addreview.php" name="review-form" class="rating-form" method="POST">
                        <h3 class="heading-tertiary">Add Rating</h3>
                        <div class="align-center-text">
                            <span class="rating-form__rating clear-fix">
                                <input id="rating-5" type="radio" name="rating" value="5">
                                <label for="rating-5">5</label>
                                <input id="rating-4" type="radio" name="rating" value="4">
                                <label for="rating-4">4</label>
                                <input id="rating-3" type="radio" name="rating" value="3">
                                <label for="rating-3">3</label>
                                <input id="rating-2" type="radio" name="rating" value="2">
                                <label for="rating-2">2</label>
                                <input id="rating-1" type="radio" name="rating" value="1">
                                <label for="rating-1">1</label>
                            </span>
                        </div>
                        <h3 class="heading-tertiary">Add Comment</h3>
                        <textarea name="comment" cols="30" rows="10" class="rating-form__comment"></textarea>
                        <input type="hidden" name="purchase-id" value="<?php echo $_GET['purchase-id']?>">
                        <input type="hidden" name="user-id" value="<?php echo $userid?>">
                        <div class="review-form__button-container clear-fix">
                            <input type="submit" class="review-form__button--submit">
                            <div class="review-form__button--back">
                                <a class="review-form__link" href="../history">Back</a>
                            </div>
                        </div>
                    </form>          
                </div>
            </section>
        </main>
    </div>
</body>
</html>