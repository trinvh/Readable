<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Kodeine\Acl\Traits\HasRole;

class User extends Authenticatable
{
    use HasRole;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function gravatar() {
        return "http://www.gravatar.com/avatar/".md5(strtolower(trim($this->email)));
    }
    
    public function collections() {
        return $this->hasMany(\App\Models\Novel\Collection::class);
    }
}
