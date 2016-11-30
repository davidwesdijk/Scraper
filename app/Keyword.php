<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    protected $fillable = [
    	'keyword'
    ];

    public function results()
    {
    	return $this->hasMany('App\Result');
    }

    public function getResults()
    {
    	return 'I must scrape here';
    }
}
