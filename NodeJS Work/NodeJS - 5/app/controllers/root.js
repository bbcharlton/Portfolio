var express = require('express');
var router = express.Router();
var mongoose = require('mongoose');

module.exports = function(app) {
	app.use('/', router);
}

router.get('/', function(request, response) {
	var User = mongoose.model('User');
	var Pet = mongoose.model('Pet');

	var bailey = new User({
		name: 'Bailey',
		meta: {
			dob: new Date(1995, 2, 28)
		}
	});

	var cat = new Pet({
		name: 'Dude',
		type: 'Cat'
	});

	bailey.validate(function(error) {
		console.log(error);
	})

	cat.validate(function(error) {
		console.log(error)
	});

	console.log('User', bailey);
	console.log(bailey.greeting());
	console.log(bailey.getAge());

	response.send('<h1>Hello world!</h1>')
});