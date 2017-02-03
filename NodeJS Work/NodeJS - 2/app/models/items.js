var mongoose = require('mongoose');
var itemSchema = mongoose.Schema({
	name: {
		type: String,
		required: true
	},
	status: {
		type: String,
		enum: ['Complete', 'Incomplete']
	},
	parent:{
		type: mongoose.Schema.Types.ObjectId,
		ref: 'List'
	}
});

module.exports = mongoose.model('Item', itemSchema);