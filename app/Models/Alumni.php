<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $table = 'alumni';

    public function workplace()
    {
        return $this->hasMany('app\Models\workplace','alumni_id');
    }

}