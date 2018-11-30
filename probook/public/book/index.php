<?php include("../../app/fetch.php"); ?>

<!DOCTYPE html>
<html>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<script src="../../app/soapclient.js"></script>
<script src="../../app/angular.soap.js"></script>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Detail | Pro-Book</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="../stylesheets/main.css">
    <link rel="stylesheet" href="../stylesheets/detail.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../stylesheets/search-result.css" />
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
            <div ng-app="bookDetails" ng-controller="bookDetailsCTRL">
                <section class="section-book-details">
                <div class="right">
                        <div class="img-thumbnail">
                            <img src="{{book.img}}">
                        </div>
                        <div class="rating">
                            <?php 
                                include("../../app/ratingstar.php"); 
                                echo "<p>".number_format($avg_rating, 1)." / 5.0</p>";
                            ?>
                        </div>
                    </div>
                    <div class="left">
                        <h2 class="heading-secondary">{{book.title}}</h2>
                        <h3 ng-repeat="authr in book.author">{{authr}}</h3>
                        <p>{{book.longDesc}}</p>
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
                    <h3 class="heading-tertiary">Rekomendasi</h3>
                    <div class="img-div">
                        <img src={{rec.img}} alt="harry-1">
                    </div>
                    <div class="book-content">
                        <div class="book-heading">
                            <h3 class="book-title">{{rec.title}}</h3>
                            <h4 >{{rec.author[0]}} - 
                                <span id="rate-avg-{{rec.isbn}}"></span> / 5.0 (
                                    <span id="vote-{{rec.isbn}}"></span> votes )</h4>
                        </div>
                        <div class="book-description">
                            <p>{{rec.shortDesc}}</p>
                        </div>
                    </div>
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
            </div>
            <section class="section-reviews">
                <h3 class="heading-tertiary">Reviews</h3>
                <?php include("../../app/fetchreview.php"); ?>
            </section>
        </main>
    </div>
    <script src="detail.js"></script>
</body>
<script>
    var app = angular.module('bookDetails', ['angularSoap']);
    app.factory("bookWebService", ['$soap',function($soap){
        var base_url = "http://localhost:8080/BookWebservice/bookServlet";

        return {
            getBook: function(search_query){
                return $soap.post(base_url, "getBook", {query: search_query, accesstype : "isbn"});
            },

            getRecommendation: function(cat){
                return $soap.post(base_url, "getRecommendation", {category : cat});
            }
        }
    }])
    app.controller('bookDetailsCTRL', function($scope, bookWebService){
        $scope.getRecommendation = function(category){
        bookWebService.getRecommendation(category).then(function(response){
                temp = JSON.parse(response);
                $scope.rec = temp[0];
            });
        }
        $scope.getDetails = function(search_query){
            bookWebService.getBook(search_query).then(function(response){
                temp = JSON.parse(response);
                $scope.book = temp[0];
                $scope.getRecommendation($scope.book.category);
                console.log(temp[0]);
            });
        }
        $scope.getDetails(<?php echo (string)$_GET['book-id']; ?>);
    });
</script>
</html>