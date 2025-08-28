<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MAnggota extends Model
{
    use HasFactory;

    protected $table = 'anggota';
    protected $fillable = ['nama', 'email', 'password'];
}