var express = require('express');
var router = express.Router();
var rest = require('restler');

module.exports = function(app) {
	app.use('/', router);
	app.set('view engine', 'pug');
	app.set('views', './app/views');
}

//================================
//	Lists CRUD
//================================

router.get('/lists', function(request, response, next) {
	rest.get('http://0.0.0.0:8000/lists').on('success', function(data) {
		response.render('lists', {listData: data});
	});
});

router.get('/lists/:id', function(request, response, next) {
	rest.get('http://0.0.0.0:8000/lists/' + request.params.id).on('success', function(data) {
		response.render('list', {listData: data});
	});
});

router.post('/lists', function(request, response, next) {
	rest.post('http://0.0.0.0:8000/lists', {data: request.body}).on('complete', function(data) {
		response.redirect('/lists');
	});
});

//================================
//	Items CRUD
//================================

router.get('/items', function(request, response, next) {
	rest.get('http://0.0.0.0:8000/items').on('success', function(data) {
		response.render('items', {data: data});
	});
});

router.get('/items/:id', function(request, response, next) {
	rest.get('http://0.0.0.0:8000/items/' + request.params.id).on('success', function(data) {
		response.render('item', {data: data});
	});
});

router.post('/items', function(request, response, next) {
	rest.post('http://0.0.0.0:8000/items', {data: request.body}).on('complete', function(data) {
		response.redirect(request.get('referer'));
	});
});

router.post('/edit/items/:id', function(request, response, next) {
	rest.post('http://0.0.0.0:8000/edit/items/' + request.params.id, {data: request.body}).on('complete', function(data) {
		response.redirect(request.get('referer'));
	});
});

router.get('/items/:id/destroy', function(request, response, next) {
	rest.get('http://0.0.0.0:8000/items/' + request.params.id + '/destroy', {data: request.body}).on('complete', function(data) {
		response.redirect(request.get('referer'));
	});
});