var express = require('express');
var router = express.Router();
var mongoose = require('mongoose');
var List = mongoose.model('List');
var Item = mongoose.model('Item');

module.exports = function(app) {
	app.use('/', router);
	app.set('view engine', 'pug');
	app.set('views', './app/views');
}

//================================
//	Display lists
//================================
router.get('/lists', getLists, function(request, response) {
	response.render('lists', {listData: request.lists});
});

//================================
//	Display lists by ID
//================================
router.get('/lists/:id', getLists, getItems, function(request, response) {
	response.render('list', {listData: request.lists, itemData: request.items, listID: request.params.id});
});

//================================
//	Adds new list
//================================
router.post('/lists', function(request, response) {
	var newList = new List({title: request.body.title});

	newList.save(function (error) {
		if (error) {
			console.log(error);
		} else {
			console.log('List saved!');
		}
	});

	response.redirect('/lists');
});

//================================
//	Adds new item
//================================
router.post('/items', function(request, response) {
	var newItem = new Item({name: request.body.name, status: request.body.status, parent: request.body.parent});

	newItem.save(function(error) {
		if (error) {
			console.log(error);
		} else {
			console.log('Item saved!');
		}
	});

	response.redirect('/lists/' + request.body.parent);
});

//================================
//	Edits item by ID
//================================
router.post('/items/edit/:id', function(request, response) {
	Item.update({_id: request.params.id}, {name: request.body.name, status: request.body.status, parent: request.body.parent}, function(error, result) {
		if (error) {
			console.log(error);
		} else {
			console.log(result);
		}
	});

	response.redirect(request.get('referer'));
});

//================================
//	Deletes item by ID
//================================
router.post('/items/delete/:id', function(request, response) {
	Item.find({_id: request.params.id}).remove().exec();

	response.redirect(request.get('referer'));
});

//================================
//	Deletes list by ID
//================================
router.get('/lists/delete/:id', function(request, response, next) {
	List.find({_id: request.params.id}).remove().exec();

	response.redirect('/lists');
});

//================================
//	Gets all lists
//================================
function getLists(request, response, next) {
	List.find({}, function(error, result) {
		request.lists = result;
		next();
	});
}

//================================
//	Gets all items
//================================
function getItems(request, response, next) {
	Item.find({}, function(error, result) {
		request.items = result;
		next();
	});
}