<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    public function files(){
		return $this->belongsToMany('App\Models\File', 'rel_template_file', 'template_id', 'file_id')
			->withPivot('order_number', 'is_thumbnail');
	}

	public function select_file($id){
		return $this->belongsToMany('App\Models\File', 'rel_template_file', 'template_id', 'file_id')
			->withPivot('order_number', 'is_thumbnail')->wherePivot('order_number', $id)->first();	
	}

	public function select_frist_file(){
		return $this->belongsToMany('App\Models\File', 'rel_template_file', 'template_id', 'file_id')
			->withPivot('order_number', 'is_thumbnail')->orderBy('order_number', "asc")->first();	
	}

	public function types(){
		return $this->belongsToMany('App\Models\Type', 'rel_template_type', 'template_id', 'type_id');
	}

	public function icons(){
		return $this->belongsToMany('App\Models\Icon', 'rel_template_icon', 'template_id', 'icon_id');
	}
}
