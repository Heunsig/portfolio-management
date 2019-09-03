<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Icon extends Model
{
	protected $table = 'support_icons';

	public function Portfolios(){
		return $this->belongsToMany('App\Models\Admin\Portfolio', 'rel_portfolio_icon', 'icon_id', 'portfolio_id');
	}

	public function Templates(){
		return $this->belongsToMany('App\Models\Admin\Template', 'rel_template_icon', 'icon_id', 'template_id');
	}
	
}
