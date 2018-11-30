<?php include("../../app/fetch.php"); ?>

<!DOCTYPE html>
<html>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<script src="../../app/soapclient.js"></script>
<script src="../../app/angular.soap.js"></script>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Search | Pro-Book</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="../stylesheets/main.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="../stylesheets/search-result.css" />
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
            <div ng-app="bookResults" ng-controller="bookResultsCTRL">
                <section class="section-search">
                    <h2 class="heading-secondary">Search Book</h2>
                    <form class="search-form" method="GET" name="search-form">
                        <input type="text" name="search-book" class="search-form__text-input" id="search-input" placeholder="Input search terms..." ng-model="search_query" ng-change="getResults($event.target.value)">
                        <div id="search-notif"></div>
                    </form>
                    <div class="result-count">
                        <p></p>
                        <p>Showing results for <u><strong>{{search_query}}</strong></u></p>
                        <p>Found <u><strong>Dummy Number</strong></u> result(s)</p>
                    </div>
                </section>
                <div class="section-result" ng-repeat="book in books">
                    <div class="content-section">
                        <div class="img-div">
                            <img src={{book.img}} alt="harry-1">
                        </div>
                        <div class="book-content">
                            <div class="book-heading">
                                <h3 class="book-title">{{book.title}}</h3>
                                <h4 >{{book.author[0]}} - <span id="rate-avg" onload="loadRating(book.isbn, function(nilairating){ this.innerHTML = nilairating;})"></span>/5.0 (<span id="total-vote" onload="this.innerHTML=loadVotes(book.id)"></span> votes)</h4>
                            </div>
                            <div class="book-description">
                                <p>{{book.shortDesc}}</p>
                            </div>
                        </div>
                    </div>
                    <form action="../book" class="button-div" method="GET">
                        <button class="book-detail" name="book-id" value="{{book.isbn}}">Detail</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
<script>
    var app = angular.module('bookResults', ['angularSoap']);
    app.factory("bookWebService", ['$soap',function($soap){
        var base_url = "http://localhost:8080/BookWebservice/bookServlet";

        return {
            getBook: function(search_query){
                return $soap.post(base_url, "getBook", {query: search_query, accesstype : "intitle"});
            }
        }
    }])
    app.controller('bookResultsCTRL', function($scope, bookWebService){
        $scope.getResults = function(search_query){
            bookWebService.getBook($scope.search_query).then(function(response){
                temp = JSON.parse(response);
                $scope.books = temp;
                var ratings = [];
                temp.forEach(function(book, i){
                    ratings[i] = loadRating(book.isbn);
                })
                $scope.rating = ratings;
            });
        }
    });

    function loadRating(bookid, cb){
        var xhr =  new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if( typeof cb === 'function' ){
                    cb(this.responseText);
                }
            }
        }

        xhr.open("GET", "getrating.php?bookid="+bookid, true);     
        xhr.send();
        return xhr.onreadystatechange();
    }

    function loadVotes(bookid){
        var xhr =  new XMLHttpRequest();

        xhr.open("GET", "getvotes.php?bookid="+bookid, true);
        xhr.send();
        return this.responseText;
    }
</script>
</html>