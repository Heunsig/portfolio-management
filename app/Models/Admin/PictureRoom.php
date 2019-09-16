<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class PictureRoom extends Model
{
    protected $table = 'picture_rooms';

    protected $appends = [
        'first_picture'
    ];

    public function pictures()
    {
        return $this->morphToMany('App\Models\Admin\File', 'fileable', 'fileables', 'fileable_id', 'file_id');
    }

    public function getFirstPictureAttribute() {
        return $this->pictures()->where('is_image', true)->orderBy('order_number', 'asc')->first();
    }
}
