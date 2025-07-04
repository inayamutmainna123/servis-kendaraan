<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Costumer extends Model
{
    use HasUlids;

    protected $table = 'costumer';

    protected $fillable = [
        'avatar',
        'nama_costumer',
        'email',
        'no_telepon',
        'alamat',
    ];

    

}
