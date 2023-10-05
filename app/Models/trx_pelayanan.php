<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trx_pelayanan extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $fillable = ['no_regis','no_rekam_medis','id_petugas','id_pembayaran','waktu_mulai','waktu_selesai','status'];
    public function master_petugas()
    {
        return $this->belongsTo(master_petugas::class, 'id_petugas', 'id_petugas');
    }
    public function master_metode_pembayaran()
    {
        return $this->belongsTo(master_metode_pembayaran::class, 'id_metode_pembayaran', 'id_metode_pembayaran');
    }
    public function trx_registrasi()
    {
        return $this->belongsTo(trx_registrasi::class, 'no_regis', 'no_regis');
    }

}
