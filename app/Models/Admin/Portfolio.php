<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{

	protected $append = [
		'first_picture'
	];

	public function files () {
		return $this->morphToMany('App\Models\Admin\File', 'fileable', 'fileables', 'fileable_id', 'file_id');
	}

	public function categories(){
		return $this->belongsToMany('App\Models\Admin\Category', 'rel_portfolio_category', 'portfolio_id', 'category_id');
	}

	public function icons(){
		return $this->belongsToMany('App\Models\Admin\Icon', 'rel_portfolio_icon', 'portfolio_id', 'icon_id');
	}

	public function links() {
		return $this->hasMany('App\Models\Admin\Link', 'portfolio_id');
	}

	public function getFirstPictureAttribute() {
		return $this->files()->where('is_image', true)->orderBy('order_number', 'asc')->first();
	}

	// public function getFirstPictureAttribute() {
 //        return $this->morphToMany('App\Models\Admin\File', 'fileable', 'fileables', 'fileable_id', 'file_id')
 //                    ->withPivot('caption')->orderBy('order_number', 'asc')->first();
 //    }

	// public function files(){
	// 	return $this->belongsToMany('App\Models\Admin\File', 'rel_portfolio_file', 'portfolio_id', 'file_id')
	// 	->withPivot('order_number', 'is_thumbnail');
	// }

	// public function select_file($id){
	// 	return $this->belongsToMany('App\Models\Admin\File', 'rel_portfolio_file', 'portfolio_id', 'file_id')
	// 	->withPivot('order_number', 'is_thumbnail')->wherePivot('order_number', $id)->first();	
	// }

	// public function select_frist_file(){
	// 	return $this->belongsToMany('App\Models\Admin\File', 'rel_portfolio_file', 'portfolio_id', 'file_id')
	// 		->withPivot('order_number', 'is_thumbnail')->orderBy('order_number', "asc")->first();	
	// }

	

	// public function pictures() {
	// 	return $this->morphToMany('App\Models\Admin\File', 'picturable', 'picturables', 'picturable_id', 'file_id')
 //                    ->withPivot('caption');
	// }

	// public function getFirstPictureAttribute() {
	// 	return $this->belongsToMany('App\Models\Admin\File', 'rel_portfolio_file', 'portfolio_id', 'file_id')
	// 				->withPivot('order_number', 'is_thumbnail')->orderBy('order_number', "asc")->first();	
	// }
}
