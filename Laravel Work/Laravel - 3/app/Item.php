<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
		'title', 
		'due_date',
		'notes',
		'status'
	];

	public function lists() {
		return $this->belongsTo('App\List');
	}
}
