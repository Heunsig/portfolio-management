<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Icon extends Model
{
	protected $table = 'support_icons';

	public function Portfolios(){
		return $this->belongsToMany('App\Models\admin\Portfolio', 'rel_portfolio_icon', 'icon_id', 'portfolio_id');
	}
	
}
