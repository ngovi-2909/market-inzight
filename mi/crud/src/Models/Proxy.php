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
      'is_active',
      'created_by',
    ];

    public function setIsActiveAttribute($value): void
    {
        $this->attributes['is_active'] = ($value==1) ? 1 : 0;
    }
    public function convertTrueFalse($value):string
    {
        return $value==1 ? 'True':'False';
    }
}
