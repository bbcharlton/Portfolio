var mongoose = require('mongoose');
var Schema = mongoose.Schema;

var saveSchema = new Schema({
	name: {type: String},
	objID: {type: Number},
	vidURLs: {type: String},
	vidURL: {type: String},
	windowstart: {type: String},
	location: {type: String}
});

module.exports = mongoose.model('Save', saveSchema);