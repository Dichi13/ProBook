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
    $card = $post['nomorkartu'];
    $avatar = "user-silhouette.png";
    $query = "INSERT INTO user (username,password,nama,email,alamat,phone,nomorkartu,avatar) 
    VALUES ('$userName','$password','$fullname','$email','$alamat','$phone','$card','$avatar')"; 
    queryMysql($query);
}

function NewPurchase($userid, $bookid, $jumlah, $date){
    $query = "INSERT INTO purchase (userid,bookid,jumlah,tanggal) 
    VALUES ('$userid','$bookid', '$jumlah', '$date')"; 
    queryMysql($query);
}

function randomString($length = 15) {
	$str = "";
	$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}

function getUserIdFromToken($token) {
    $query = "SELECT * FROM token WHERE tokenstring = '$token'";
    $result = queryMysql($query);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $expire = $row['expire'];
    $userid = $row['userid'];
    $ipaddress = $row['ipaddress'];

    if ($expire > time() && $ipaddress == $_SERVER['REMOTE_ADDR']) {
        return $userid;
    } else {
        return 0;
    }
}

?>