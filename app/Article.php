<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	/**
	 * The attributes default values.
	 * 
	 * @var array
	 */
    protected $attributes = [
    	'title' => '',
    	'text' => '',
    	'link' => '',
        'image_link' => '',
    	'author' => ''
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'title', 'text', 'link', 'image_link', 'author'
    ];

    public function setLinkAttribute($value)
    {
        $this->attributes['link'] = strtolower($value);
    }

}
