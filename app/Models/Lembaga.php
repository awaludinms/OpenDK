<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lembaga extends Model
{
    use HasFactory;

    protected $table = 'das_lembaga';

    protected $fillable = [
        'nama_lembaga',
        'kode_lembaga',
        'nomor_sk_pendirian_lembaga',
        'das_kategori_lembaga_id',
        'penduduk_id',
        'deskripsi_lembaga',
        'logo_lembaga',
        'jumlah_anggota_lemmbaga',
        'is_active',
        'is_deleted',
    ];

    public function kategori_lembaga()
    {
        return $this->belongsTo(KategoriLembaga::class, 'das_kategori_lembaga_id');
    }

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'penduduk_id');
    }

}
