var mongoose = require('mongoose');
var Schema = mongoose.Schema;

var blogSchema = new Schema({
	title: {type: String},
	description: {type: String},
	body: {type: String}
});

module.exports = mongoose.model('Blog', blogSchema);