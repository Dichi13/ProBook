<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "probookDB";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // sql crate user table
        $sqlCreateUser = "CREATE TABLE IF NOT EXISTS user (
                    userid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    username VARCHAR(30) NOT NULL,
                    password VARCHAR(32) NOT NULL,
                    nama VARCHAR(100) NOT NULL,
                    email VARCHAR(50) NOT NULL,
                    alamat VARCHAR(200) NOT NULL,
                    phone VARCHAR(15) NOT NULL,
                    nomorkartu VARCHAR(16) NOT NULL,
                    avatar VARCHAR(100) NOT NULL
                )";

        // sql create purchase
        $sqlCreatePurchase = "CREATE TABLE IF NOT EXISTS purchase (
                            purchaseid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                            userid INT(6) UNSIGNED,
                            bookid VARCHAR(13),
                            review VARCHAR(200),
                            rating INT(6) UNSIGNED,
                            jumlah INT(100) UNSIGNED,
                            tanggal DATE,
                            FOREIGN KEY (userid) REFERENCES user(userid)
                        )";

        $sqlCreateToken = "CREATE TABLE IF NOT EXISTS token (
                            userid INT(6) UNSIGNED PRIMARY KEY,
                            tokenstring VARCHAR(15),
                            ipaddress VARCHAR(45),
                            expire INT UNSIGNED,
                            FOREIGN KEY (userid) REFERENCES user(userid)
                        )";

        // use exec() because no results are returw3ned
        $conn->exec($sqlCreateUser);
        // echo "User created successfully<br>";
        $conn->exec($sqlCreatePurchase);
        // echo "Purchase created successfully<br>";
        $conn->exec($sqlCreateToken);
        // echo "Token created successfully<br>";
    } catch(PDOException $e) {
        echo $sqlCreateDB . "<br>" . $e->getMessage();
    }

    $conn = null;
?>