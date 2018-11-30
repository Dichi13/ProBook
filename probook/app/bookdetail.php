<?php 
    if (isset($_GET['book-id'])) {
        $bookid = $_GET['book-id'];

        $client = new SoapClient("http://localhost:8080/BookWebservice/bookServlet?wsdl");

        $params = array(
            "arg0" => $bookid,
            "arg1" => "isbn",
        );

        $response = $client->__soapCall("getBook", array($params));
        $book = json_decode($response->return, true)[0];

        $bookname = $book["title"];
        $author = $book["author"][0];
        $bookimg = $book["img"];
    }
?>