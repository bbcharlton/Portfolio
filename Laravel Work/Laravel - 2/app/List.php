<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class List extends Model
{
    protected $fillable = [
		'name', 
		'color',
		'created_at',
		'updated_at'
	];

	public function users() {
		return $this->hasMany('App\Users');
	}
}
