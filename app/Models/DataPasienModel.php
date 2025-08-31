<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataPasienModel extends Model
{
    protected $table = 'data_pasien';
    protected $fillable = [
        'nama_pasien',
        'umur',
        'alamat',
        'nomor_telepon',
        'rs_id',
    ];

    public function rumah_sakit()
    {
        return $this->belongsTo(RumahSakitModel::class, 'rs_id');
    }
}
