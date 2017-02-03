var mongoose = require('mongoose');
var listSchema = mongoose.Schema({
	title: {
		type: String,
		unique: true,
		required: true
	}
});

listSchema.methods.getItems = function(request, response) {
	return this.items;
}

module.exports = mongoose.model('List', listSchema);