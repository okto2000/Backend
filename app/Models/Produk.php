<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    use HasFactory;
    protected $table = 'tbl_produk';
    protected $primaryKey = 'id_produk';
    protected $fillable = ['nama_produk', 'image', 'id_kategori', 'price'];
}
