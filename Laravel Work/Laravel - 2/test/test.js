var request = require('supertest');

describe('JSON API', function() {
	beforeEach(function(){
		server = require('../server.js');
	});

	afterEach(function(){
		server.close;
	});

	it('GET /lists gives a JSON response', function(done) {
		request(server)
		.get('/lists')
		.set('Accept', 'application/json')
		.expect('Content-Type', /json/)
		.expect([
			{id: 1, title: 'work', color: 'red'},
			{id: 2, title: 'school', color: 'blue'},
			{id: 3, title: 'home', color: 'purple'},
			{id: 4, title: 'groceries', color: 'green'}
		], done);
	});

	it('GET /lists/id gives a JSON response', function(done) {
		request(server)
		.get('/lists/1')
		.set('Accept', 'application/json')
		.expect('Content-Type', /json/)
		.expect([
			{title: 'work stuff', status: 'incomplete'},
			{title: 'school stuff', status: 'incomplete'},
			{title: 'home stuff', status: 'completed'},
			{title: 'grocery stuff', status: 'completed'}
		], done);
	});

	it('GET /item/id gives a JSON response', function(done) {
		request(server)
		.get('/item/1')
		.set('Accept', 'application/json')
		.expect('Content-Type', /json/)
		.expect([{title: 'work item', due: '12/05/16', notes: "lkdsjfaklsdjflas;kdf", status: "incomplete"}], done);
	});

	it('POST /lists accepts a JSON request and returns a title', function(done) {
		request(server)
		.post('/lists')
		.send({id: 5, title: 'work', color: 'red'}) 
		.expect('"work"', done);
	});

	it('POST /item accepts a JSON request and returns a title', function(done) {
		request(server)
		.post('/item')
		.send({title: 'work item', due: '12/04/16', notes: "asdfasdfdsafasdfsadfaskdf", status: "complete"}) 
		.expect('"work item"', done);
	});

	it('PUT /item/:pid updates a JSON request', function(done) {
		request(server)
		.put('/item/1')
		.expect(function(response) {
        	response.body.status = 'complete';
      	})
      	.expect(200, {title: 'school item', due: '12/12/16', notes: "zcxvzxcvkdffdsa", status: "complete"}, done);
	});

	it('DELETE /item/:pid deletes a JSON request', function(done) {
		request(server)
		.del('/item/1')
		.send({title: 'school item', due: '12/12/16', notes: "zcxvzxcvkdffdsa", status: "complete"}) 
		.expect(200, done);
	});
});