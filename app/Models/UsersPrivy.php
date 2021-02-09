<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersPrivy extends Model
{
    protected $table    = 'users';
    protected $fillable = ['status_login'];
}
