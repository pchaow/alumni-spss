<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    protected $table = 'questionnaire';


    public function alumni()
    {
        return $this->belongsTo('App\Models\Alumni');
    }
}