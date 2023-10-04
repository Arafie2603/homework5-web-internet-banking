<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class User extends Model implements Authenticatable
{
    use AuthenticatableTrait;
    use HasFactory;

    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    //     'image'
    // ];

    public function accounts()
    {
        return $this->hasMany(Accounts::class);
    }

    public function getAuthPassword()
    {
        return $this->password;
    }
}
