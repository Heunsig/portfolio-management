<?php

namespace App\Models\Admin\Manager;

use Illuminate\Database\Eloquent\Model;

class Referrer extends Model
{
    protected $connection = 'manager';

    protected $table = 'referrers';

    protected $fillable = ['referrer'];
}
