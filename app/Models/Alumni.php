<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $table = 'alumni';

    public function workplace()
    {
        return $this->hasMany('app\Models\Workplace','alumni_id');
    }
    public function questionnaire()
    {
        return $this->hasMany('app\Models\Questionnaire','questionnaire_id');
    }

}