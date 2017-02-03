<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyList extends Model
{
	public function items() {
		return $this->hasMany('App\Item');
	}

	public $timestamps = false;
}
