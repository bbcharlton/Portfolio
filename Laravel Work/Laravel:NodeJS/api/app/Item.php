<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function lists() {
		return $this->belongsTo('App\MyList');
	}

	public $timestamps = false;
}
