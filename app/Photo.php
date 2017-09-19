<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
	protected $fillable = [
		'file'
	];

	protected $uploads ='/images/';

	//$photo represent the value of that column, File is the name of the column
	public function getFileAttribute($photo){   //get accessor

		return $this->uploads . $photo;

	}
}
