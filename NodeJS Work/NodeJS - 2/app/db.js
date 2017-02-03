var mongoose = require('mongoose');

mongoose.connect('mongodb://' + process.env.MONGO_HOST + '/' + process.env.MONGO_DATABASE);

console.log('mongodb://' + process.env.MONGO_HOST + '/' + process.env.MONGO_DATABASE);

var db = mongoose.connection;

db.on('error', function (error) {
	console.log(error);
});

db.once('open', function() {
	console.log('DATABASE CONNECTED');
});

mongoose.Promise = global.Promise;

module.exports = db;