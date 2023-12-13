<?php

namespace MI\Crud\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'is_super_user',
        'is_active',
    ];

//    /**
//     * The attributes that should be hidden for serialization.
//     *
//     * @var array<int, string>
//     */
////    protected $hidden = [
////        'password',
////        'remember_token',
////    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_super_user'=>'boolean',
        'is_active'=>'boolean',
    ];


    public function setCheckBoxAttribute($attr,$value): void
    {
        $this->attributes[$attr] = ($value==1) ? 1 : 0;
    }
    public function setHashPasswordAttribute($value): void
    {
        $this->attributes['password'] = Hash::make($value);
    }
    public function convertTrueFalse($value):string
    {
        return $value==1 ? 'True':'False';
    }

}
