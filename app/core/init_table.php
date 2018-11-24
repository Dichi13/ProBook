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
                    avatar VARCHAR(100) NOT NULL
                )";
        
        // sql create buku
        $sqlCreateBook = "CREATE TABLE IF NOT EXISTS book (
                            bookid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                            bookname VARCHAR(100) NOT NULL,
                            author VARCHAR(100) NOT NULL,
                            deskripsi VARCHAR(200) NOT NULL,
                            bookimg VARCHAR(100) NOT NULL
                        )";

        // sql create purchase
        $sqlCreatePurchase = "CREATE TABLE IF NOT EXISTS purchase (
                            purchaseid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                            userid INT(6) UNSIGNED,
                            bookid INT(6) UNSIGNED,
                            review VARCHAR(200),
                            rating INT(6) UNSIGNED,
                            jumlah INT(100) UNSIGNED,
                            tanggal DATE,
                            FOREIGN KEY (userid) REFERENCES user(userid),
                            FOREIGN KEY (bookid) REFERENCES book(bookid)
                        )";

        // use exec() because no results are returned
        $conn->exec($sqlCreateUser);
        // echo "User created successfully<br>";
        $conn->exec($sqlCreateBook);
        // echo "Book created successfully<br>";
        $conn->exec($sqlCreatePurchase);
        // echo "Purchase created successfully<br>";
    } catch(PDOException $e) {
        echo $sqlCreateDB . "<br>" . $e->getMessage();
    }

    $conn = null;
?>