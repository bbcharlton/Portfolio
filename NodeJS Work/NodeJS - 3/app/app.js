var glob = require('glob');
var bodyParser = require('body-parser');

module.exports = function(app) {
    app.use(bodyParser.json());
    app.use(bodyParser.urlencoded({extended: true}));
    
    var controllers = glob.sync(__dirname + '/controllers/*.js');
    
    controllers.forEach(function(controllerFileName) {
        require(controllerFileName)(app);
    });
    
    console.log(controllers);
    console.log(__dirname);
}