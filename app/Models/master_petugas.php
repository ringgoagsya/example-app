<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class master_petugas extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $fillable = ['id_petugas','nama_petugas'];
    public function trx_pelayanan()
    {
        return $this->hasMany(trx_pelayanan::class, 'id_petugas', 'id_petugas');
    }
    public function User()
    {
        return $this->hasOne(User::class, 'id_petugas', 'id_petugas');
    }
}
