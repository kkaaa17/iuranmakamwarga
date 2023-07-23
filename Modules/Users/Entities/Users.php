<?php

namespace Modules\Users\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Users extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'username',
        'password',
        'role',
        // 'created_by',
        // 'created_date',
        // 'updated_by',
        // 'updated_date'
    ];

    // protected $guarded = [
    //     'created_at',
    //     'updated_at'
    // ];

    // protected static function newFactory()
    // {
    //     return \Modules\Users\Database\factories\UsersFactory::new();
    // }
}
