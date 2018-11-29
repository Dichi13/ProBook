<?php include("../../app/fetch.php"); ?>

<!DOCTYPE html>
<html>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<script src="soapclient.js"></script>
<script src="angular.soap.js"></script>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Search | Pro-Book</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="../stylesheets/main.css" />
    <!-- <script src="main.js"></script> -->
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
            <section class="section-search">
                <h2 class="heading-secondary">Search Book</h2>
                <form action="../searchresult" class="search-form" method="GET" name="search-form">
                    <input type="text" name="search-book" class="search-form__text-input" id="search-input" placeholder="Input search terms...">
                    <div id="search-notif"></div>
                    <div class="set-right">
                        <input type="submit" value="Search" class="search-form__button" id="search-btn">
                    </div>
                </form>
                <div class="result-count">
                    <p>Found <u><strong>Dummy Number</strong></u> result(s)</p>
                </div>
            </section>
            <div ng-app="bookResults" ng-controller="bookResultsCTRL">
                <div class="section-result" ng-repeat="book in response">
                    <div class="content-section">
                        <div class="img-div">
                            <img src="../images/'.$bookimg.'" alt="harry-1">
                        </div>
                        <div class="book-content">
                            <div class="book-heading">
                                <h3 class="book-title" ng-model="book.name"></h3>
                                <h4 ng-model="book.author"> - <span id="rate-avg">'.$avg_rating.'</span>/5.0 (<span id="total-vote">'.$vote.'</span> votes)</h4>
                            </div>
                            <div class="book-description">
                                <p ng-model="book.desc"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="../book" class="button-div" method="GET">
                    <button class="book-detail" name="book-id" value="'.$bookid.'">Detail</button>
                </form>
            </div>
        </main>
    </div>
    <script src="browse.js"></script>
</body>
<script>
    var app = angular.module('bookResults', ['angularSoap']);
    app.factory("bookWebService", ['$soap',function($soap){
        var base_url = "http://localhost:8080/";

        return {
            GetBooks: function(searchquery){
                return $soap.post(base_url, "GetBooks", {<ISI INFO BUKU>});
            }
        }
    }])
    app.controller('bookResultsCTRL', function($scope, bookWebService){
        bookWebService.GetBooks($scope.searchquery).then(function(response){
            $scope.response = response;
        });
    });
</script>
</html>