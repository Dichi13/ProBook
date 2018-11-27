var mysql = require('mysql');

var con = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "bank"
});

con.connect(function (err){
    if(err) throw err;
    var query = "CREATE TABLE IF NOT EXISTS account (username VARCHAR(30) PRIMARY KEY, cardnumber VARCHAR(16), balance INT NOT NULL DEFAULT 0)";
    con.query(query, function (err, result) {
        if (err) throw err;
        console.log("Table account created");
    });

    var query = "CREATE TABLE IF NOT EXISTS transaction (transactionid INT AUTO_INCREMENT PRIMARY KEY, sender VARCHAR(16) NOT NULL, receiver VARCHAR(16) NOT NULL, AMOUNT INT NOT NULL, t_date DATE NOT NULL)";
    con.query(query, function (err, result) {
        if (err) throw err;
        console.log("Table transaction created");
    });

    con.end(function(err) {
        if (err) throw err;
    });
});