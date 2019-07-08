<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
	public function files(){
		return $this->belongsToMany('App\Models\admin\File', 'rel_portfolio_file', 'portfolio_id', 'file_id')
			->withPivot('order_number', 'is_thumbnail');
	}

	public function select_file($id){
		return $this->belongsToMany('App\Models\admin\File', 'rel_portfolio_file', 'portfolio_id', 'file_id')
			->withPivot('order_number', 'is_thumbnail')->wherePivot('order_number', $id)->first();	
	}

	public function types(){
		return $this->belongsToMany('App\Models\admin\Type', 'rel_portfolio_type', 'portfolio_id', 'type_id');
	}

	public function icons(){
		return $this->belongsToMany('App\Models\admin\Icon', 'rel_portfolio_icon', 'portfolio_id', 'icon_id');
	}
}
