<?php

namespace App\Auth;

use Illuminate\Foundation\Auth\User as Authenticatable;

class LoginAdmin extends Authenticatable
{
    protected $table = 'admin_tb';
    protected $hidden = [
        'password', 'remember_token',
    ];
}
