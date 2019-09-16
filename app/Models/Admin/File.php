<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'saved_dir'
    ];

  	public function portfolios () {
  		return $this->belongsToMany('App\Models\Admin\Portfolio', 'rel_portfolio_file', 'file_id', 'portfolio_id')->withPivot('order_number');
  	}

    public function alternative_images () {
        return $this->hasMany('App\Models\Admin\AlternativeImage', 'file_id', 'id');
    }
}
