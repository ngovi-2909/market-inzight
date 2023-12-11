<?php

namespace App\Models;

use App\Http\Controllers\Management\UserController;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'password',
        'is_active',
        'expired_time',
        'created_by'
    ];
    public function setIsActiveAttribute($value): void
    {
        $this->attributes['is_active'] = ($value==1) ? 1 : 0;
    }
    public function convertTrueFalse($value):string
    {
        return $value==1 ? 'True':'False';
    }
    public function getExpiredTimeAttribute($value): string
    {
        return (new Carbon($value))->format('Y-m-d');
    }

}
