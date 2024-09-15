<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriLembaga extends Model
{
    use HasFactory;

    protected $table = 'das_kategori_lembaga';
    protected $fillable = [
        'kategori_lembaga',
        'deskripsi_kategori_lembaga',
        'is_active',
        'is_deleted',
    ];
}
