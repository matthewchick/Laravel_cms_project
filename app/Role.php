<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	protected $fillable = [   //mass assignment to be consistent with DB
		'name'
	];
	// https://laravel.com/docs/5.2/eloquent-relationships - A user has one role
	public function user()
	{
		return $this->hasOne('App\User', 'role_id');
	}
}
