<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
	protected $guarded = [];

	public function menu()
	{
		return $this->belongsTo('App\Models\Menu', 'menu_id', 'id');
	}

	public function language()
	{
		return $this->belongsTo('App\Models\Language', 'language_id', 'id');
	}
}
