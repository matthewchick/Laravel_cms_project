<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $fillable = [   //mass assignment to be consistent with DB
		'category_id',
		'photo_id',
		'title',
		'body'
	];
}
