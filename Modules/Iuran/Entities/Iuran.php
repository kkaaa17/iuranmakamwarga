<?php

namespace Modules\Iuran\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Iuran extends Model
{

    protected $table='iuran';

    use HasFactory;

    protected $fillable = ['id','nik','totalbayar','bulanke','tglbayar'];
    
    // protected static function newFactory()
    // {
    //     return \Modules\Warga\Database\factories\WargaFactory::new();
    // }
}
