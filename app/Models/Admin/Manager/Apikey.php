<?php

namespace App\Models\Admin\Manager;

use Illuminate\Database\Eloquent\Model;

class Apikey extends Model
{
    protected $connection = 'manager';

    protected $table = 'api_keys';

    public function databases () {
      return $this->hasMany('App\Models\Admin\Manager\Database', 'user_id', 'user_id');
    }

    public function referrers () {
      return $this->hasMany('App\Models\Admin\Manager\Referrer', 'key', 'key');
    }
}
