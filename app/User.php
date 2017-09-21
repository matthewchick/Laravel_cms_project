<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [   //mass assignment to be consistent with DB
		'name',
		'email',
		'password',
		'role_id',
		'photo_id',
		'is_active',
		'',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	// set relation with Role
	public function role() {
		return $this->belongsTo( 'App\Role' );
	}


	public function photo() {
		return $this->belongsTo( 'App\Photo' );
	}

	public function isAdmin(){

		if($this->role->name  == "administrator" && $this->is_active == 1){
			return true;
		}
		return false;
	}
}

