<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RumahSakitModel extends Model
{
    protected $table = 'data_rs';
    protected $fillable = [
        'nama_rumah_sakit',
        'alamat',
        'nomor_telepon',
        'email',
    ];
}
