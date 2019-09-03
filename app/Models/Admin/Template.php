<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    public function files(){
		return $this->belongsToMany('App\Models\Admin\File', 'rel_template_file', 'template_id', 'file_id')
			->withPivot('order_number', 'is_thumbnail');
	}

	public function select_file($id){
		return $this->belongsToMany('App\Models\Admin\File', 'rel_template_file', 'template_id', 'file_id')
			->withPivot('order_number', 'is_thumbnail')->wherePivot('order_number', $id)->first();	
	}

	public function select_frist_file(){
		return $this->belongsToMany('App\Models\Admin\File', 'rel_template_file', 'template_id', 'file_id')
			->withPivot('order_number', 'is_thumbnail')->orderBy('order_number', "asc")->first();	
	}

	public function categories(){
		return $this->belongsToMany('App\Models\Admin\Category', 'rel_template_category', 'template_id', 'category_id');
	}

	public function icons(){
		return $this->belongsToMany('App\Models\Admin\Icon', 'rel_template_icon', 'template_id', 'icon_id');
	}
}
