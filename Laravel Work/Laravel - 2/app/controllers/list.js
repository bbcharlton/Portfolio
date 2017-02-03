var express = require('express');
var router = express.Router();
var path = require('path');

module.exports = function(app) {
	app.use('/', router);
}

router.get('/lists', function (request, response) {
	response.json([
		{id: 1, title: 'work', color: 'red'},
		{id: 2, title: 'school', color: 'blue'},
		{id: 3, title: 'home', color: 'purple'},
		{id: 4, title: 'groceries', color: 'green'}
	]);
});

router.get('/lists/:pid', function (request, response) {
	response.json([
		{title: 'work stuff', status: 'incomplete'},
		{title: 'school stuff', status: 'incomplete'},
		{title: 'home stuff', status: 'completed'},
		{title: 'grocery stuff', status: 'completed'}
	]);
});

router.get('/item/:pid', function (request, response) {
	response.json([
		{title: 'work item', due: '12/05/16', notes: "lkdsjfaklsdjflas;kdf", status: "incomplete"}
	]);
});

router.post('/lists', function(request, response) {
	response.body = response.json(request.body.title);
});

router.post('/item', function(request, response) {
	response.body = response.json(request.body.title);
});

router.put('/item/:pid', function(request, response) {
	response.json({title: 'school item', due: '12/12/16', notes: "zcxvzxcvkdffdsa", status: "incomplete"});
});

router.delete('/item/:pid', function(request, response) {
	delete(request.body);
	response.sendStatus(200);
})
