<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    protected $table = 'usertypes';

    function users(){
        return $this->hasMany('App\Models\User','usertype_id');
    }

}
