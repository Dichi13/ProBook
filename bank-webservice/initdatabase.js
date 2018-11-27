var mysql = require('mysql');

var con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: ""
});

con.connect(function (err){
    if(err) throw err;
    con.query("CREATE DATABASE IF NOT EXISTS bank", function (err, result) {
        if (err) throw err;
        console.log("Database created");
    });

    con.end(function(err) {
        if (err) throw err;
    });
});