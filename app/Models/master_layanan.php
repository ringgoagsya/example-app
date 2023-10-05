<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class master_layanan extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $fillable = ['id_layanan','nama_layanan'];
    public function trx_registrasi()
    {
        return $this->hasMany(trx_registrasi::class, 'no_regis', 'no_regis');
    }
}
