<?php

namespace Modules\Warga\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Warga extends Model
{

    protected $table='warga';

    use HasFactory;

    protected $fillable = ['nik','nama','ttl','alamat','jk','nohp','iuran'];
    
    // protected static function newFactory()
    // {
    //     return \Modules\Warga\Database\factories\WargaFactory::new();
    // }
}
