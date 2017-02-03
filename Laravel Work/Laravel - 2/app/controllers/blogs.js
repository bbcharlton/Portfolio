var express = require('express');
var router = express.Router();
var path = require('path');
var fs = require('fs');

module.exports = function(app) {
	app.use('/blog', router);
	app.set('view engine', 'pug');
	app.set('views', './app/views');

	app.get('/blog', getBlogs, function (request, response) {
		response.render('blogs', {data: request.blogs});
	});
}

router.post('/saveBlog', getBlogs, function(request, response, next) {
  request.checkBody('title').notEmpty();
  request.checkBody('date').notEmpty();
  request.checkBody('author').notEmpty();
  request.checkBody('summary').notEmpty();
  request.checkBody('body').notEmpty();
  var error = request.validationErrors();
  if (error) {
    response.redirect('/blog');
  } else {
    request.blogs[request.body.title] = request.body;
    saveBlogs(request.blogs);
    response.redirect('/blog');
  }
});

var userDataPath = path.join(__dirname, '/../data/blogs.json');

function getBlogs(request, response, next) {
    fs.readFile(userDataPath, function(error, data) {
       if (error) {
           throw 'ERROR!';
       } else {
           request.blogs = JSON.parse(data);
           next();
       }
    });
}

function saveBlogs(blogs) {
    var json = JSON.stringify(blogs);
    fs.writeFile(userDataPath, json, 'utf8', function(error) {
      if (error) {
           throw 'ERROR! ' + error;
       } else {
           console.log(json);
       }
    });
}