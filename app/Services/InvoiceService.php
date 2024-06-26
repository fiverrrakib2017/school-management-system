<?php
namespace App\Services; 
use App\Models\Customer;
use App\Models\Product;

class InvoiceService{
    public function createInvoice($type){
        $data=[
            'customer'=>Customer::latest()->get(), 
            'product'=>Product::latest()->get(),
            'products'=>Product::with('product_image')->paginate(10),
        ];
        if ($type === 'Customer') {
            $customer = $data['customer'];
            $product = $data['product'];
            $products = $data['products'];
            return view('Backend.Pages.Customer.invoice_create', compact('customer','product' ,'products'));
        } elseif ($type === 'Supplier') {
            
        }

    }
}