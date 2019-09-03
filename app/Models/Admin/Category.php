<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function portfolios(){
  		return $this->belongsToMany('App\Models\Admin\Portfolio', 'rel_portfolio_category', 'category_id', 'portfolio_id');
  	}

	public function templates(){
		return $this->belongsToMany('App\Models\Admin\Template', 'rel_template_category', 'category_id', 'template_id');
	}
}
