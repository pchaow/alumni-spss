<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questionnaires extends Model
{
    protected $table = 'questionnaires';


    public function alumni()
    {
        return $this->belongsTo('App\Models\Alumni');
    }
}
