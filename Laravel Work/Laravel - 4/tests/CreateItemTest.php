<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateItemTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testView()
    {
        $this->visit('/create')
        	->seeInElement('h1', 'Create New')
        	->dontSeeInElement('h1', 'Work')
        ;
    }

    public function testForm() {
    	$this->visit('/create')
    		->type('Schedule client call', 'title')
    		->type('Set it up for Tuesday', 'description')
    		->type('12/05/16', 'date')
    		->type('1:00pm', 'time')
    		->type('Starbucks', 'location')
    		->select('never', 'repeat')
    		->press('Save')
    		->seePageIs('/')
    	;
    }
}
