var express = require('express');
var router = express.Router();
var session = require('express-session');
var request = require('request');
var rp = require('request-promise');
var ObjectId = require('mongodb').ObjectID;
var User = require('../models/user.js');
var Save = require('../models/save.js');
var Blog = require('../models/blog.js');

router.get('/', function(req, res, next) {
	var options = {
	    uri: 'https://launchlibrary.net/1.1/launch/next/25',
	    headers: {
	        'User-Agent': 'Request-Promise'
	    },
	    json: true
	};
	 
	rp(options)
	    .then(function (result) {
	        if (req.session.user) {
				res.render('index', { title: 'Express - Home', data: result.launches, session: req.session });
			} else {
				res.render('index', { title: 'Express - Home', data: result.launches });
			}
	    });
});

router.get('/register', function(req, res, next) {
	if (req.session.user) {
		res.redirect('/');
	} else {
		res.render('auth/register', { title: 'Express - Register' });
	}
});

router.post('/register', function(req, res, next) {
	if (req.body.password != req.body.confirmPassword) {
		res.render('auth/register', { error: 'Passwords do not match!' });
	} else {
		User.findOne({ email: req.body.email }, function(err, user) {
		    if (user) {
		    	res.render('auth/register', { error: 'This email is already in use!' });
		    } else {
		    	var newUser = new User({
				    email: req.body.email,
				    password: req.body.password,
				    role: 'user'
				});

				newUser.save(function(err) {
				    if (err) {
				    	throw err;
				    } else {
				    	req.session.user = newUser;
				    	res.redirect('/');
				    }
				});
		    }
		});
	}
});

router.get('/login', function(req, res, next) {
	if (req.session.user) {
		res.redirect('/');
	} else {
		res.render('auth/login', { title: 'Express - Login' });
	}
});

router.post('/login', function(req, res, next) {
	User.findOne({ email: req.body.email }, function(err, user) {
	    if (!user) {
	    	res.render('auth/login', { error: 'Incorrect email address!' })
	    } else {
	    	if(!user.comparePassword(req.body.password)) {
	    		res.render('auth/login', { error: 'Incorrect password!' });
	    	} else {
	    		req.session.user = user;
	    		res.redirect('/');
	    	}
	    }
	});
});

router.get('/logout', function(req, res, next) {
	if (req.session.user) {
		req.session.destroy();
	}

	res.redirect('/');
});

router.get('/profile', function(req, res, next) {
	if (req.session.user) {
		User.findOne({ email: req.session.user.email }, function(err, updatedUser) {
			req.session.user = updatedUser;
			req.session.save(function(err) {
			    req.session.reload(function (err) {
			         res.render('profile', { title: 'Express - Profile', session: req.session });
			    });
			});
		});
	} else {
		res.redirect('/');
	}
});

router.post('/profile', function(req, res, next) {
	var newSave = new Save({
	    name: req.body.objName,
	    objID: req.body.objID,
	    vidURLs: req.body.objVidURLs,
	    vidURL: req.body.objVidURL,
	    windowstart: req.body.objWindowstart,
	    location: req.body.objLocation
	});

	User.findOneAndUpdate({email: req.session.user.email}, {$pull: {saves: {objID: parseInt(req.body.objID)}}}, function(err, data){});
	
	User.findByIdAndUpdate(
        req.session.user._id,
        {$addToSet: {saves: newSave}},
        {safe: true, upsert: true, new : true},
        function(err, user) {
        	res.redirect('/');
        }
    );
});

router.post('/profile/remove', function(req, res, next) {
	User.findOneAndUpdate({email: req.session.user.email}, {$pull: {saves: {objID: parseInt(req.body.objID)}}}, function(err, data){});
	res.redirect('/profile');
});

router.get('/blog', function(req, res, next) {
	Blog.find({}, function(err, blogData) {
	    if (!blogData) {
	    	if (req.session.user) {
	    		res.render('blog', {session: req.session});
			} else {
				res.render('blog');	
			}
	    } else {
	    	if (req.session.user) {
	    		res.render('blog', {session: req.session, blogs: blogData});
			} else {
				res.render('blog', {blogs: blogData});	
			}
	    }
	});
});

router.get('/blog/view/:id', function(req, res, next) {
	Blog.findOne({ _id: ObjectId(req.params.id) }, function(err, blog) {
		if (err) {
			res.render('blog');	
		} else {
			if (req.session.user) {
	    		res.render('moreBlog', {session: req.session, data: blog});
			} else {
				res.render('moreBlog', {data: blog});	
			}
		}
	});
});

router.get('/blog/new', function(req, res, next) {
	res.render('newBlog');
});

router.post('/blog/new', function(req, res, next) {
	var newBlog = new Blog({
	    title: req.body.title,
	    description: req.body.description,
	    body: req.body.body
	});

	newBlog.save(function(err) {
	    if (err) {
	    	throw err;
	    } else {
	    	res.redirect('/blog');
	    }
	});
});

router.get('/blog/delete/:id', function(req, res, next) {
	if (req.session.user) {
		if (req.session.user.role == 'admin') {
			Blog.find({ _id: ObjectId(req.params.id) }).remove().exec(function(err, blog) {
				res.redirect('/blog');
			});
		} else {
			res.redirect('/');
		}
	} else {
		res.redirect('/');
	}
});

router.get('/blog/edit/:id', function(req, res, next) {
	if (req.session.user) {
		if (req.session.user.role == 'admin') {
			Blog.find({ _id: ObjectId(req.params.id) }, function(err, blogData) {
				res.render('editBlog', {session: req.session, blog: blogData});
			});
		} else {
			res.redirect('/');
		}
	} else {
		res.redirect('/');
	}
});

router.post('/blog/edit', function(req, res, next) {
	Blog.update({ _id: ObjectId(req.body.id)}, {
	    title: req.body.title, 
	    description: req.body.description,
	    body: req.body.body
	}, function(err, result) {
	   res.redirect('/blog');
	})
});

router.post('/search', function(req, res, next) {
	var options = {
	    uri: 'https://launchlibrary.net/1.1/launch/' + req.body.search,
	    headers: {
	        'User-Agent': 'Request-Promise'
	    },
	    json: true
	};
	 
	rp(options)
		.catch(function(err){
			if (req.session.user) {
				res.render('index', { title: 'Express - Home', error: true, session: req.session });
			} else {
				res.render('index', { title: 'Express - Home', error: true });
			}
        })
	    .then(function (result) {
	        if (req.session.user) {
				res.render('index', { title: 'Express - Home', data: result.launches, session: req.session });
			} else {
				res.render('index', { title: 'Express - Home', data: result.launches });
			}
	    });
});

module.exports = router;
