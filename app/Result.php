<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
	protected $table = 'keyword_results';

	protected $fillable = [
		'title',
		'url',
		'description'
	];

    public function keyword()
    {
    	return $this->belongsTo('App\Keyword');
    }

    public function getResults($keyword)
	{
		return 'Scraping...';
	}
}
