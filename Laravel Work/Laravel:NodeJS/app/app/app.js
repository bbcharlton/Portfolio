var bodyParser = require('body-parser');
var glob = require('glob');

module.exports = function(app) {
	app.use(bodyParser.json());
	app.use(bodyParser.urlencoded({extended: true}));

	var controllers = glob.sync(__dirname + '/controllers/*.js');

	controllers.forEach(function(controllerFileName) {
		var controller = require(controllerFileName);

		controller(app);
	});
}