<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $guarded = [];

	public function seo()
	{
		return $this->hasOne('App\Models\Seo', 'menu_id', 'id');
	}

	public function language()
	{
		return $this->belongsTo('App\Models\Language', 'language_id', 'id');
	}
}
