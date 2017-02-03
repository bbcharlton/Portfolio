<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ListTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testView()
    {
        $this->visit('/lists/2')
        	->seeInElement('h1', 'Work')
        	->seeLink('Design new icons', '/item/1')
        	->seeLink('new item', '/create')
        ;
    }

    public function testLink() {
    	$this->visit('/lists/2')
    		->click('new item')
    		->seePageIs('/create')
    	;
    }
}
