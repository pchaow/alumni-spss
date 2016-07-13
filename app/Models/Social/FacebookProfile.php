<?php

namespace App\Models\Social;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: chaow
 * Date: 5/25/2016
 * Time: 3:50 PM
 */
class FacebookProfile extends Model
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}