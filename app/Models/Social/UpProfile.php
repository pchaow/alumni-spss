<?php

namespace App\Models\Social;


use App\Models\User;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: chaow
 * Date: 5/25/2016
 * Time: 3:50 PM
 */
class UpProfile extends Model
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function upProfileType()
    {
        return $this->belongsTo(UpProfileType::class);
    }

}