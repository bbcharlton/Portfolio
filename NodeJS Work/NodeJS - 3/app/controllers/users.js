var express = require('express');
var router = express.Router();
var path = require('path');
var fs = require('fs');

module.exports = function(app) {
    app.use('/users', router);
}

router.get('/', function(request, response, next) {
    response.sendFile(path.join(__dirname, '/../views/users.html'));
});

router.get('/list', getUsers, function(request, response, next) {
   response.json(request.users); 
});

router.post('/', getUsers, function(request, response, next) {
    request.users[request.body.username] = request.body;
    saveUsers(request.users);
    response.redirect('/users');
});

router.put('/:uname', getUsers, function(request, response, next) {
    request.users[request.params.uname] = request.body;
    saveUsers(request.users);
    response.json(request.users[request.params.uname]);
})

router.delete('/:uname', getUsers, function(request, response, next) {
    delete request.users[request.params.uname];
    saveUsers(request.users);
    response.sendStatus(200);
})

var userDataPath = path.join(__dirname, '/../data/users.json');

function getUsers(request, response, next) {
    fs.readFile(userDataPath, function(error, data) {
       if (error) {
           throw 'ERROR!';
       } else {
           request.users = JSON.parse(data);
           next();
       }
    });
}

function saveUsers(users) {
    var json = JSON.stringify(users);
    fs.writeFile(userDataPath,json, 'utf8', function() {});
}