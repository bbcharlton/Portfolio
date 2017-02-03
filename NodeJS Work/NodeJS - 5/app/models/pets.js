var mongoose = require('mongoose');
var petSchema = mongoose.Schema({
	name: String,
	type: {
		type: String,
		enum: ['Dog', 'Cat']
	},
	owner:{
		type: mongoose.Schema.Types.ObjectId,
		ref: 'User'
	}
});

module.exports = mongoose.model('Pet', petSchema);