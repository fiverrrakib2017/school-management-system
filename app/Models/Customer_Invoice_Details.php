<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_Invoice_Details extends Model
{
    use HasFactory;
    protected $fillable = ['invoice_id', 'product_id', 'qty', 'price', 'total_price'];
    public function invoice()
    {
        return $this->belongsTo(Customer_Invoice::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
