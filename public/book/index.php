<?php include("../../app/fetch.php"); ?>
<?php include("../../app/bookdetail.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Detail | Pro-Book</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="../stylesheets/main.css">
    <link rel="stylesheet" href="../stylesheets/detail.css">
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
            <section class="section-book-details">
            <div class="right">
                    <div class="img-thumbnail">
                        <img src="<?php echo "../images/$bookimg"?>">
                    </div>
                    <div class="rating">
                        <?php include("../../app/ratingstar.php"); ?>
                        <p><?php echo $avg_rating?> / 5.0</p>
                    </div>
                </div>
                <div class="left">
                    <h2 class="heading-secondary"><?php echo $bookname ?></h2>
                    <h3><?php echo $author ?></h3>
                    <p><?php echo $deskripsi ?></p>
                </div>
            </section>
            <section class="section-order">
                <h3 class="heading-tertiary">Order</h3>
                <form id="form-input">
                    <div>
                        Jumlah:
                        <select name="amount" id="amount">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <input type="hidden" name="book-id" id ="book-id" value="<?php echo $bookid ?>">
                    <div class="align-right">
                       <button class="btn-order" id="btn-order">Order</button> 
                    </div>
                </form>
                <!-- modal -->
                <div class="modal" id="modal-order">
                    <div class="modal-content">
                        <span id="close">&times;</span>
                            <img src="../images/checked.png" alt="checked" class="img-checked">
                            <h3><strong>Pemesanan Berhasil!</strong></h3>
                            <p>Nomor Transaksi: <?php echo $transactionID; ?></p>
                    </div>
                </div>
                <!-- End Of Modal -->
            </section>
            <section class="section-reviews">
                <h3 class="heading-tertiary">Reviews</h3>
                <?php include("../../app/fetchreview.php"); ?>
            </section>
        </main>
    </div>
    <script src="detail.js"></script>
</body>
</html>