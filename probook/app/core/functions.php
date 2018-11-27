<?php
$dbhost = 'localhost';
$dbname = 'probookDB';
$dbuser = 'root';
$dbpass = '';
$appname = 'Pro-Book';

$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if($connection->connect_error) die ($connection->connect_error);

function createTable($name, $query) {
    queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
    echo "Table '$name' created or already exists";
}

function queryMysql($query) {
    global $connection;
    $result = $connection->query($query);
    if(!$result) die($connection->error);
    return $result;
}

function sanitizeString($str) {
    global $connection;
    $var = strip_tags($str);
    $var = htmlentities($var);
    $var = stripcslashes($var);
    return $connection->real_escape_string($var);
}

function NewUser($post) { 
    $fullname = sanitizeString($post['name']); 
    $userName = sanitizeString($post['username']); 
    $email = sanitizeString($post['email']); 
    $password = md5($post['password_1']);
    $alamat = sanitizeString($post['address']);
    $phone = $post['telephone'];
    $card = $post['card'];
    $avatar = "user-silhouette.png";
    $query = "INSERT INTO user (username,password,nama,email,alamat,phone,nomorkartu,avatar) 
    VALUES ('$userName','$password','$fullname','$email','$alamat','$phone','$card'.$avatar')"; 
    queryMysql($query);
}

function NewBook($bookname, $author, $deskripsi, $bookimg) {
    $query = "INSERT INTO book (bookname,author,deskripsi,bookimg) 
    VALUES ('$bookname','$author','$deskripsi','$bookimg')"; 
    queryMysql($query);
}

function NewPurchase($userid, $bookid, $jumlah, $date){
    $query = "INSERT INTO purchase (userid,bookid,jumlah,tanggal) 
    VALUES ('$userid','$bookid', '$jumlah', '$date')"; 
    queryMysql($query);
}

?>