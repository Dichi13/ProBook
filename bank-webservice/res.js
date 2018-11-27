'use strict';

exports.ok = function(values, res) {
  var data = {
      'status': 200,
      'values': values
  };
  res.json(data);
  res.end();
};

exports.notfound = function(values, res) {
    var data = {
        'status': 404,
        'values': values
    };
    res.json(data);
    res.end();
};