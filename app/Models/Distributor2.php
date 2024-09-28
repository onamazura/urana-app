<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distributor2 extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_distributor', 'lokasi', 'kontak', 'email'  
    ];
}
