<?php 
    $queryGetTransaction = "SELECT purchaseid, bookid, jumlah, review, rating, tanggal FROM purchase WHERE userid=$userid";
    
    $result = queryMysql($queryGetTransaction);
    $count = mysqli_num_rows($result);

    function PrintDate($date) {
        $indoYear = substr($date,0,4);
        $indoMonth = substr($date,5,2);
        $indoDate = substr($date,8,2);
        if ($indoMonth == '01') {
            $indoMonth = 'January';
        } else if ($indoMonth == '02') {
            $indoMonth = 'February';
        } else if ($indoMonth == '03') {
            $indoMonth = 'March';
        } else if ($indoMonth == '04') {
            $indoMonth = 'April';
        } else if ($indoMonth == '05') {
            $indoMonth = 'May';
        } else if ($indoMonth == '06') {
            $indoMonth = 'June';
        } else if ($indoMonth == '07') {
            $indoMonth = 'July';
        } else if ($indoMonth == '08') {
            $indoMonth = 'August';
        } else if ($indoMonth == '09') {
            $indoMonth = 'September';
        } else if ($indoMonth == '10') {
            $indoMonth = 'October';
        } else if ($indoMonth == '11') {
            $indoMonth = 'November';
        } else if ($indoMonth == '12') {
            $indoMonth = 'December';
        }

        return "<p>". $indoDate. " ".$indoMonth." ". $indoYear . "</p>";
    }

    if ($count == 0) {
        echo "<h3>Anda belum melakukan transaksi apapun</h3>";
    } else {
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $purchaseid = $row['purchaseid'];
            $bookid = $row['bookid'];
            $jumlah = $row['jumlah'];
            $review = $row['review'];
            $rating = $row['rating'];
            $tanggal = $row['tanggal'];
            $tanggalIndo = PrintDate($tanggal);
            $nomor_transaksi = $row['purchaseid'];

            $client = new SoapClient("http://localhost:8080/BookWebservice/bookServlet?wsdl");

            $params = array(
                "arg0" => $bookid,
                "arg1" => "isbn",
            );

            $response = $client->__soapCall("getBook", array($params));
            $book = json_decode($response->return, true)[0];

            $bookname = $book["title"];
            $bookimg = $book["img"];

            if ($review === NULL && $rating === NULL) {
                echo "<div class='section-book'>
                        <div class='book-detail'>
                            <div class='img-div'>
                                <img src='$bookimg'>
                            </div>
                            <h3 class='book-title'>$bookname</h3>
                            <p>Jumlah : $jumlah</p>
                            <p>Belum direview</p>
                        </div>
                        <div class='order-number'>".
                            PrintDate($tanggal)."
                            <p>Nomor Order : $nomor_transaksi</p>
                            <form action='../review' method='GET'>
                                <input type='hidden' name='purchase-id' value='$purchaseid'>
                                <button class='btn-review' name='book-id' value='$bookid'>Review</button>
                            </form>
                        </div>
                    </div>";
            } else {
                echo "<div class='section-book'>
                        <div class='book-detail'>
                            <div class='img-div'>
                                <img src='../images/$bookimg'>
                            </div>
                            <h3 class='book-title'>$bookname</h3>
                            <p>Jumlah : $jumlah</p>
                            <p>Anda sudah memberikan review</p>
                        </div>
                        <div class='order-number'>
                            ". PrintDate($tanggal) ."
                            <p>Nomer Order : $nomor_transaksi</p>
                        </div>
                    </div>";
            }
        }
    }
?>