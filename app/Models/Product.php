<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function brand(){
        return $this->belongsTo(Product_Brand::class);
    }
    public function category(){
        return $this->belongsTo(Product_Category::class);
    }
    public function unit(){
        return $this->belongsTo(Unit::class);
    }
    public function store(){
        return $this->belongsTo(Store::class);
    }
}
