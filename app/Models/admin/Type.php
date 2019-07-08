<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public function portfolios(){
		return $this->belongsToMany('App\Models\admin\Portfolio', 'rel_portfolio_type', 'type_id', 'portfolio_id');
	}
}
