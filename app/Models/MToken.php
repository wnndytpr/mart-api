<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MToken extends Model
{
     use HasFactory;

    protected $table = 'token_anggota';
    protected $fillable = ['anggota_id', 'auth_key'];
}