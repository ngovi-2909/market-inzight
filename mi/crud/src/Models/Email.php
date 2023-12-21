<?php

namespace mi\crud\Models;

use mi\crud\Http\Controllers\Management\UserController;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'password',
        'blocked_in',
        'status',
        'expired_time',
        'created_by'
    ];
    public function getExpiredTimeAttribute($value): string
    {
        return ($value != null)?(new Carbon($value))->format('Y-m-d'):"";
    }


}
