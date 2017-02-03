<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'body', 'imageURL', 'poster_id',
    ];

    public function users() {
		return $this->belongsTo('App\User');
	}
}
