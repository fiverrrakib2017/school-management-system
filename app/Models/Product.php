<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function product_image(){
        return $this->hasMany(Product_image::class);
    }
    public function brand(){
        return $this->belongsTo(Product_Brand::class);
    }
    public function category(){
        return $this->belongsTo(Product_Category::class);
    }
    public function sub_category(){
        return $this->belongsTo(Product_sub_category::class, 'sub_cat_id');
    }
}
