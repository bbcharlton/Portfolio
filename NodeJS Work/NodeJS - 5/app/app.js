var bodyParser = require('body-parser');
var glob = require('glob');
var db = require('./db');

module.exports = function(app) {
	app.use(bodyParser.json());
	app.use(bodyParser.urlencoded({extended: true}));

	var models = glob.sync(__dirname + '/models/*.js');

	models.forEach(function(modelFileName) {
		require(modelFileName);
	});

	var controllers = glob.sync(__dirname + '/controllers/*.js');

	controllers.forEach(function(controllerFileName) {
		var controller = require(controllerFileName);

		controller(app);
	});
}