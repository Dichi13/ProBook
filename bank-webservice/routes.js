
'use strict';

module.exports = function(app) {
    var route = require('./controller');

    app.route('/')
        .get(route.index);

    app.route('/validate/:cardnumber')
        .get(route.validate)
};