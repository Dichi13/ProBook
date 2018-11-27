'use strict';

var response = require('./res');
var connection = require('./conn');

exports.validate = function(req, res) {
    var cardnumber = req.params.cardnumber;
    var query = 'SELECT exists(SELECT cardnumber FROM account WHERE cardnumber = ' + cardnumber + ') as result';
    connection.query(query, function (error, rows, fields){
        if(error){
            console.log(error)
        } else{
            response.ok(!rows[0].result, res)
        }
    });
};

exports.index = function(req, res) {
    response.ok("Success", res)
};