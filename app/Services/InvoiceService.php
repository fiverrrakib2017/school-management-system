<?php
namespace App\Services; 
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\Product;

class InvoiceService{
    public function createInvoice($type){
        $data=array();
        $data['product']=Product::latest()->get();
        $data['products']=Product::with('product_image')->paginate(10);
        if ($type === 'Customer') {
            $data['customer'] = Customer::latest()->get();
            return view('Backend.Pages.Customer.invoice_create')->with($data);
        } elseif ($type === 'Supplier') {
            $data['supplier']=Supplier::latest()->get();
            return view('Backend.Pages.Supplier.invoice_create')->with($data);
        }

    }
}