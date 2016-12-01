<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
	/**
	 * Define the table name for the Result instances
	 * @var string
	 */
	protected $table = 'keyword_results';

	/**
	 * Define the fillable fields
	 * @var array
	 */
	protected $fillable = [
		'title',
		'url',
		'description'
	];

	/**
	 * A result belongs to a keyword
	 * @return Relation
	 */
    public function keyword()
    {
    	return $this->belongsTo('App\Keyword');
    }
}
