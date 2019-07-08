<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public function portfolios(){
		return $this->belongsToMany('App\Models\Portfolio', 'rel_portfolio_type', 'type_id', 'portfolio_id');
	}

	public function templates(){
		return $this->belongsToMany('App\Models\Template', 'rel_template_type', 'type_id', 'template_id');
	}
}
