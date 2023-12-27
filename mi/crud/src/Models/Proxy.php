<?php

namespace mi\crud\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proxy extends Model
{
    use HasFactory;
    protected $fillable = [
    'host',
    'port',
    'username',
    'password',
    'status',
    'blocked_in',
    'created_by',
    ];

    protected $casts = [
        'created_at' =>'datetime: Y-m-d H:00:00',
        'updated_at' =>'datetime: Y-m-d H:00:00'
    ];

}
