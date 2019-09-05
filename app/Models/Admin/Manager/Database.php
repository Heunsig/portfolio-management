<?php

namespace App\Models\Admin\Manager;

use Illuminate\Database\Eloquent\Model;

class Database extends Model
{
    protected $connection = 'manager';

    protected $table = 'databases';
}
