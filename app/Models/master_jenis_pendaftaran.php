<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class master_jenis_pendaftaran extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $fillable = ['id_jenis_pendaftaran','nama_jenis_pendaftaran'];
    public function trx_registrasi()
    {
        return $this->hasMany(trx_registrasi::class, 'no_regis', 'no_regis');
    }
}
