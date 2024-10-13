<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlashSale extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 
        'discount_price', 
        'start_time', 
        'end_time'
    ];

    // Definisikan relasi belongsTo ke model Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
