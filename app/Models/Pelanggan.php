<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    protected $table = 'tbl_pelanggan';
    protected $primaryKey = 'id_pelanggan';
    protected $fillable = ['username', 'nama', 'alamat', 'notelp', 'email', 'password'];
}
