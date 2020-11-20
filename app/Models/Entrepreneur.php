<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrepreneur extends Model
{
    protected $table    = 'Entrepreneurs';
    protected $fillable = ['deskripsi', 'foto'];
}