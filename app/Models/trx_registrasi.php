<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trx_registrasi extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $fillable = ['no_regis','id_pasien','id_layanan','id_jenis_pendaftaran','waktu_regis','status'];
    public function master_pasien()
    {
        return $this->belongsTo(master_pasien::class, 'id_pasien', 'id_pasien');
    }
    public function master_layanan()
    {
        return $this->belongsTo(master_layanan::class, 'id_layanan', 'id_layanan');
    }
    public function master_jenis_pendaftaran()
    {
        return $this->belongsTo(master_jenis_pendaftaran::class, 'id_jenis_pendaftaran', 'id_jenis_pendaftaran');
    }

    public function trx_pelayanan()
    {
        return $this->hasOne(trx_pelayanan::class,'no_regis','no_regis');
    }
}
