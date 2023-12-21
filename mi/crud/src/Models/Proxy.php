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

}
