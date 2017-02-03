var express = require('express');
var router = express.Router();

module.exports = function(app) {
    app.use('/', router);
}

router.get('/', function(request, response, next) {
    response.send('<h1>Hello world!</h1>');
});