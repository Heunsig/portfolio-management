<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
	public function files(){
		return $this->belongsToMany('App\Models\File', 'rel_portfolio_file', 'portfolio_id', 'file_id')
			->withPivot('order_number', 'is_thumbnail');
	}

	public function select_file($id){
		return $this->belongsToMany('App\Models\File', 'rel_portfolio_file', 'portfolio_id', 'file_id')
			->withPivot('order_number', 'is_thumbnail')->wherePivot('order_number', $id)->first();	
	}

	public function select_frist_file(){
		return $this->belongsToMany('App\Models\File', 'rel_portfolio_file', 'portfolio_id', 'file_id')
			->withPivot('order_number', 'is_thumbnail')->orderBy('order_number', "asc")->first();	
	}

	public function categories(){
		return $this->belongsToMany('App\Models\Category', 'rel_portfolio_category', 'portfolio_id', 'category_id');
	}

	public function icons(){
		return $this->belongsToMany('App\Models\Icon', 'rel_portfolio_icon', 'portfolio_id', 'icon_id');
	}

	public function links() {
		return $this->hasMany('App\Models\Link', 'portfolio_id');
	}
}
