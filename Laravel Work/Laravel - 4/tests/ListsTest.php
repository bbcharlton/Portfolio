<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ListsTest extends TestCase {
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testView() {
        $this->visit('/')
        	->see('Lists')
        	->see('Work')
        	->seeLink('Work', '/lists/2');
    }

    public function testLink() {
    	$this->visit('/')
    		->click('Work')
    		->seePageIs('/lists/2');
    }
}
