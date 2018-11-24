<?php
    $request_URI = explode("?", $_SERVER['REQUEST_URI'], 2);

    switch($request_URI[0]){
        // Home page / log-in
        case '/' || '/login':
            require '../views/login/login.php';
            break;
        // browse page
        case '/browse':
            require '../views/search-book/search.php';
            break;
        // search result page
        case '/searchresult':
            require '../views/search-result/search-result.php';
            break;
        // history page
        case '/history':
            require '../views/history/history.php';
            break;
        // profile page
        case '/profile':
            require '../views/profile/profile.php';
            break;
        // profile page
        case '/profile/edit':
            require '../views/profile/edit.php';
            break;
        // detail book page
        case '/book':
            require '../views/detail/detail.php';
            break;
        // register page
        case '/register':
            require '../views/register/register.php';
            break;
        // everything else
        default:
            header('HTTP/1.0 404 Not Found');
            require '../views/404.php';
            break;
    }