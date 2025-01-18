<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;
    protected $table = 'products'; // Ensure this matches your table name

    protected $fillable = [
        'product_id',
        'name',
        'description',
        'price',
        'stock',
        'image',
    ];
}
