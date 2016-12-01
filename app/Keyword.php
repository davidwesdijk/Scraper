<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    /**
     * Define the fillable fields
     * @var array
     */
    protected $fillable = [
    	'keyword'
    ];

    /**
     * A keyword instance has many results
     * @return Relation
     */
    public function results()
    {
    	return $this->hasMany('App\Result');
    }
}
