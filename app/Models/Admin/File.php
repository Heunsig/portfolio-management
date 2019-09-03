<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
	public function portfolios(){
		return $this->belongsToMany('App\Models\Admin\Portfolio', 'rel_portfolio_file', 'file_id', 'portfolio_id')->withPivot('order_number');
	}
}
