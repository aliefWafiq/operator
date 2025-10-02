<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class operators extends Model implements AuthenticatableContract
{

    use HasFactory;
    use Authenticatable;
    protected $fillable = [
        'namaOperator',
        'email',
        'password'
    ];
}
