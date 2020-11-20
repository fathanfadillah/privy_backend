<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Core extends Model
{
    protected $table    = 'cores';
    protected $fillable = ['title', 'deskripsi', 'foto'];
}