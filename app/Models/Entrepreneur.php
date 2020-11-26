<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrepreneur extends Model
{
    protected $table    = 'entrepreneurs';
    protected $fillable = ['deskripsi', 'foto'];
}