<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory; // Указываем всегда
    protected $fillable =[
        'name',
        'image',
        'price',
        'is_active',
        'brand_id',
        'is_popular',
        'description'
    ];
public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}

