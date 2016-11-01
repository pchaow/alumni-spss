<?php

namespace App\Models;

use App\Models\Social\UpProfile;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['firstname', 'lastname', 'username', 'national_id', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];


    public function usertype()
    {
        return $this->belongsTo('App\Models\UserType', 'usertype_id');
    }

    public function up()
    {
        return $this->hasOne(UpProfile::class);
    }

    public function roles()
    {
        return $this->usertype();
    }


    public function isAdmin()
    {
        $role = $this->roles()->where("name", '=', 'ADMIN')->first();
        if ($role) {
            return true;
        } else {
            return false;
        }
    }

    public function hasRole($roles)
    {

        if (is_array($roles)) {
            foreach ($roles as $need_role) {
                if ($this->checkIfUserHasRole($need_role)) {
                    return true;
                }
            }
        } else {
            return $this->checkIfUserHasRole($roles);
        }
        return false;
    }

    private function getUserRole()
    {
        return $this->roles()->getResults();
    }

    private function checkIfUserHasRole($need_role)
    {
        return $this->roles()->where('name', '=', $need_role)->first();
    }
}
