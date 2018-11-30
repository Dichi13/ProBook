<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "BookServlet";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sqlCreateBookPrice = "CREATE TABLE IF NOT EXISTS bookprice (
                    book_id VARCHAR(13),
                    price BIGINT(20) NOT NULL
                )";

        $sqlCreatePurchased = "CREATE TABLE IF NOT EXISTS purchased (
                            purchase_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                            book_id VARCHAR(13) NOT NULL,
                            category VARCHAR(50) NOT NULL,
                            total INT(11) NOT NULL
                        )";

        // use exec() because no results are returw3ned
        $conn->exec($sqlCreateBookPrice);
        $conn->exec($sqlCreatePurchased);
    } catch(PDOException $e) {
        echo $sqlCreateDB . "<br>" . $e->getMessage();
    }

    $conn = null;
?>