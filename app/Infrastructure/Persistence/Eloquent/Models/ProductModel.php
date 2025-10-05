<?php

namespace App\Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    
    protected $fillable = [
        'name',
        'category', 
        'status',
        'quantity'
    ];
    
    public $timestamps = true;
}
