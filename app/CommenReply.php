<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommenReply extends Model {
	protected $fillable = [

		'comment_id',
		'author',
		'email',
		'photo',
		'body',
		'is_active'

	];


	public function comment() {

		return $this->belongsTo( 'App\Comment' );


	}
}
