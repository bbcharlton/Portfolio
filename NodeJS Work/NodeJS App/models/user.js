var mongoose = require('mongoose');
var Schema = mongoose.Schema;
var bcrypt = require('bcrypt');
var SALT_WORK_FACTOR = 10;

var schema = new Schema({
	email: { type: String, required: true, index: { unique: true } },
	password: { type: String, required: true },
	role: {type: String, required: true},
	saves: []
});

schema.pre('save', function(next) {
    var user = this;

	// generate a salt
	bcrypt.genSalt(SALT_WORK_FACTOR, function(err, salt) {
   		if (err) {
   			return next(err);
   		}

	    // hash the password using our new salt
	    bcrypt.hash(user.password, salt, function(err, hash) {
	        if (err) {
	        	return next(err);
	        }

	        // override the cleartext password with the hashed one
	        user.password = hash;
	        next();
	    });
	});
});

schema.methods.comparePassword = function(password) {
	return bcrypt.compareSync(password, this.password);
}

module.exports = mongoose.model('User', schema);
