<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $table = 'alumni';

  /*  public function workplace()
    {
        return $this->hasMany('App\Models\Workplace','alumni_id');
    }*/
    public function questionnaires()
    {
        return $this->hasMany('App\Models\Questionnaire','alumni_id');
    }

}
