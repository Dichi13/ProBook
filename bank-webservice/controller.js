'use strict';

var response = require('./res');
var connection = require('./conn');

exports.validate = function(req, res) {
    var cardnumber = req.params.cardnumber
    var query = 'SELECT exists(SELECT cardnumber FROM account WHERE cardnumber = ' + cardnumber + ') as result'
    connection.query(query, function (error, rows, fields){
        if(error){
            console.log(error)
        } else {
            console.log(cardnumber)
            console.log(rows)
            response.ok(rows[0].result, res)
        }
    });
};

exports.index = function(req, res) {
    response.ok("Success", res)
};

exports.transfer = function(req, res) {
    var sender = req.body.sender
    var receiver = req.body.receiver
    var amount = req.body.amount
    var query = 'SELECT balance FROM account WHERE cardnumber = ' + sender
    connection.query(query, function (error, rows, fields){
        if(error){
            console.log(error)
        } else {
            if(rows[0].balance < amount){
                response.ok("Transaction Failed", res)
            }else{
                query = 'UPDATE account SET balance = balance + ' + amount + ' WHERE cardnumber = ' + receiver
                connection.query(query, function (error, rows, fields){
                    if(error){
                        console.log(error)
                    }
                })
                query = 'UPDATE account SET balance = balance - ' + amount + ' WHERE cardnumber = ' + sender
                connection.query(query, function (error, rows, fields){
                    if(error){
                        console.log(error)
                    }
                })
                response.ok("Transaction Success", res)
            }
        }
    })
}