<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $table = 'tbl_karyawan';
    protected $primaryKey = 'id_karyawan';
    protected $fillable = ['username','nama','alamat','notelp','gaji','status', 'email', 'password'];
}
