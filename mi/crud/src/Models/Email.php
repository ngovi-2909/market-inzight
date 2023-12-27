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
    protected $casts = [
        'created_at' =>'datetime: Y-m-d H:00:00',
        'updated_at' =>'datetime: Y-m-d H:00:00'
    ];
    public function getExpiredTimeAttribute($value): string
    {
        return ($value != null)?(new Carbon($value))->format('Y-m-d'):"";
    }


}
