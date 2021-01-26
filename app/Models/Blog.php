<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table    = 'blogs';
    protected $fillable = ['judul', 'kategori', 'tanggal_terbit', 'pembukaan', 'isi', 'foto'];
}
