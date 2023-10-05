<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class master_metode_pembayaran extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $fillable = ['id_metode_pembayaran','nama_metode_pembayaran'];
    public function trx_pelayanan()
    {
        return $this->hasMany(trx_pelayanan::class, 'id_metode_pembayaran', 'id_metode_pembayaran');
    }
}
