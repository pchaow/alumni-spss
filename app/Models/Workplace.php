<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workplace extends Model
{
    protected $table = 'workplace';


    public function alumni()
    {
        return $this->hasMany('app\Models\Alumni','alumni_id');
    }
}