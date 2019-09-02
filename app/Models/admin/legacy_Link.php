<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table = 'links';

    protected $fillable = ['name', 'link'];
}
