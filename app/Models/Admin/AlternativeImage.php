<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class AlternativeImage extends Model
{
    protected $table = 'alternative_images';

    protected $fillable = [
        'size',
        'saved_dir'
    ];
}
