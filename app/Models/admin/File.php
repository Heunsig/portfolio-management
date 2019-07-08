<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
	public function portfolios(){
		return $this->belongsToMany('App\Models\admin\Portfolio', 'rel_portfolio_file', 'portfolio_id', 'file_id');
	}
}
