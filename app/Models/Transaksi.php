<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    

    public function user()
    {
    
        return $this->belongsTo(User::class, 'akun_id', 'id_akun');
    }
}
