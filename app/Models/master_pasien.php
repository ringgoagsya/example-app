<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class master_pasien extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $fillable = ['id_pasien','nama_pasien','jenis_kelamin','tanggal_lahir'];
    public function trx_registrasi()
    {
        return $this->hasMany(trx_registrasi::class, 'no_regis', 'no_regis');
    }
}
