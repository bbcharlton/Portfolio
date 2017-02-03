var mongoose = require('mongoose');
var userSchema = mongoose.Schema({
	name: String,
	username: {
		type: String,
		required: true,
		unique: true
	},
	password: {
		type: String,
		required: [true, 'A password is required for the user!']
	},
	admin: {
		type: Boolean,
		default: false
	},
	meta: {
		dob: Date,
		website: String,
	},
	created_at: Date,
	updated_at: Date,
	pets: [{
		type: mongoose.Schema.Types.ObjectId,
		ref: 'Pet'
	}]
});

userSchema.methods.greeting = function() {
	var greeting = this.name ? 'Hello, my name is ' + this.name : 'I do not exist.';

	return greeting;
}

userSchema.methods.getAge = function() {
	if (!this.meta.db) {
		return undefined;
	} else {
		var today = new Date();
		var age = today.getFullYear() - this.meta.dob.getFullYear();
		var month = today.getMonth() - this.meta.dob.getMonth();

		if (month < 0 || (month === 0 && today.getDate() < this.meta.dob.getDate())) {
			age--;
		}

		return age;
	}
}

userSchema.pre('save', function(next) {
	var currentDate = new Date();

	this.updated_at = currentDate;

	if (!this.created_at) {
		this.created_at = currentDate;
	}

	next();
});

module.exports = mongoose.model('User', userSchema);