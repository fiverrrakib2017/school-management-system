<?php

namespace App\Http\Controllers\Backend\Customer;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Customer_Invoice;
use App\Models\Customer_Invoice_Details;
use App\Models\Customer_Transaction_History;
use App\Models\Add_Contract;
use App\Models\Product;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function App\Helpers\__due_payment_received;

class InvoiceController extends Controller
{
    public function create_invoice(){
        $users=User::latest()->get();
        $product=Product::latest()->get();
        $products=Product::with('product_image')->paginate(10);
        return view('Backend.Pages.Customer.invoice_create',compact('users','product','products'));
    }
    public function search_product_data(Request $request){
        if ($request->search=='') {
            $products = Product::with('product_image')->latest()->get();
            return response()->json(['success'=>true,'data' => $products]);
            exit;
        }
        $products = Product::with('product_image')->where('title', 'like', "%$request->search%")->get();
        return response()->json(['success'=>true,'data' => $products]);
    }
    public function show_invoice(){
        return view('Backend.Pages.Customer.invoice');
    }
    public function view_invoice($id){
        $site_details=Add_Contract::find(1);
       $data=  Customer_Invoice::with('customer','items.product')->find($id);
       $pdf = Pdf::loadView('Backend.Pages.Customer.invoice_view',compact('data','site_details'));
       return $pdf->stream('customer_invoice.pdf');
    }
    public function edit_invoice($id){
        $users=User::latest()->get();
        $product=Product::latest()->get();
        $products=Product::with('product_image')->paginate(10);
       $data=  Customer_Invoice::with('customer','items')->where('id',$id)->get();
       return view('Backend.Pages.Customer.invoice_edit',compact('data','users','product','products'));
    }
    public function update_invoice(Request $request){
        /* Validate the request data*/
        $this->__validate_method($request)->validate();
        /*check invoice existing*/
        $invoice = Customer_Invoice::find($request->id);
        if (!$invoice) {
            return response()->json(['success' => false, 'message' => 'Invoice not found'], 404);
        }
        /* Fetch existing invoice details*/
        $existing_items = $invoice->items;
        /*crate a map for existing quantity*/
        $existing_qty=[];
        foreach ($existing_items as $item) {
            $existing_qty[$item->product_id] = $item->qty;
        }
        /*Validate new quantities against current stock*/ 
        foreach ($request->product_id as $index => $productId) {
            $product = Product::find($productId);
            if ($product) {
                $request_qty = $request->qty[$index];
                $old_qty = $existing_qty[$productId] ?? 0;
                $difference = $request_qty - $old_qty;

                if ($difference > 0 && $difference > $product->qty) {
                    return response()->json(['success' => false, 'message' => 'Insufficient quantity for product ID: ' . $productId], 400);
                }
            } else {
                return response()->json(['success' => false, 'message' => 'Product not found for ID: ' . $productId], 404);
            }
        /*Update the invoice*/
        $invoice = Customer_Invoice::find($request->id);
        $invoice->user_id = $request->customer_id;
        $invoice->total_amount = $request->total_amount;
        $invoice->paid_amount = $request->paid_amount ?? 0;
        $invoice->due_amount = $request->due_amount ?? $request->total_amount;
        $invoice->update();

        /* Delete existing invoice items */
        $invoice->items()->delete();

        /* Create new invoice items*/
        $this->__create_invoice($request,$invoice,$existing_qty);
        return response()->json(['success' => true, 'message' => 'Invoice updated successfully'], 201);
    }
    }
    public function show_invoice_data(Request $request){
        $search = $request->search['value'];
        $columnsForOrderBy = ['id', 'customer_name', 'phone_number','total_amount', 'paid_amount', 'due_amount','status','created_at'];
        $orderByColumn = $request->order[0]['column'];
        $orderDirection = $request->order[0]['dir'];

        $query = Customer_Invoice::with('customer')->when($search, function ($query) use ($search) {
            $query->where('total_amount', 'like', "%$search%")
                  ->orWhere('paid_amount', 'like', "%$search%")
                  ->orWhere('due_amount', 'like', "%$search%")
                  ->orWhere('created_at', 'like', "%$search%")
                  ->orWhereHas('customer', function ($query) use ($search) {
                      $query->where('name', 'like', "%$search%")
                            ->orWhere('phone', 'like', "%$search%");
                  });
        }) ->orderBy($columnsForOrderBy[$orderByColumn], $orderDirection)
        ->paginate($request->length);


        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $query->total(),
            'recordsFiltered' => $query->total(),
            'data' => $query->items(),
        ]);
    }
    public function store_invoice(Request $request){
        /* Validate the request data*/
        $this->__validate_method($request)->validate();

        foreach ($request->product_id as $index => $productId) {
           /*Get the product quantity*/
           $product_qty=$this->__get_product_qty($productId);
           /*Check the product quantity*/
           if( $request->qty[$index] >= $product_qty){
            return response()->json(['success' =>false, 'message'=> 'Insufficient quantity for product ID: ' . $productId], 400);
           }
        }
        /*Create the invoice*/
        $invoice = new Customer_Invoice();
        $invoice->user_id = $request->customer_id;
        $invoice->total_amount = $request->total_amount;
        $invoice->paid_amount = $request->paid_amount ?? 0;
        $invoice->due_amount = $request->due_amount ?? $request->total_amount;
        $invoice->save();

        /* Create invoice items*/
        $this->__create_invoice($request,$invoice , $qty=NULL);

        return response()->json(['success' =>true, 'message'=> 'Invoice stored successfully'], 201);

    }
    public function delete_invoice(Request $request){
        $invoice = Customer_Invoice::find($request->id);
        $invoice->delete();
        return response()->json(['success'=>true,'message' => 'Invoice deleted successfully']);
    }
    public function pay_due_amount(Request $request){
      $__response= __due_payment_received($request,new Customer_Invoice(),new Customer_Transaction_History(), 'user_id');
       return ($__response);
    }
    protected function __validate_method($request){
        $ruls=[
            'customer_id' => 'required|integer',
            'product_id' => 'required|array',
            'product_id.*' => 'required|numeric',
            'qty' => 'required|array',
            'qty.*' => 'required|numeric',
            'price' => 'required|array',
            'price.*' => 'required|numeric',
            'total_price' => 'required|array',
            'total_price.*' => 'required|numeric',
            'total_amount' => 'required|numeric',
            'paid_amount' => 'required|numeric',
            'due_amount' => 'required|numeric',
        ];
        return Validator::make($request->all(), $ruls);
    }
    private function __create_invoice($request,$invoice,$existing_qty){
        foreach ($request->product_id as $index => $productId) {
            $item = new Customer_Invoice_Details();
            $item->invoice_id = $invoice->id;
            $item->product_id = $productId;
            $item->qty = $request->qty[$index];
            $item->price = $request->price[$index];
            $item->total_price = $request->qty[$index] * $request->price[$index];
            $item->save();
            /*Update product stock*/
            $product = Product::find($productId);
            if ($product) {
                $old_qty = $existing_qty[$productId] ?? 0;
                $difference= $request->qty[$index]-$old_qty;
                $product->qty-=$difference; 
                $product->save();

                // $old_qty = $existing_qty[$productId] ?? 0;
                // $new_qty = $request->qty[$index];
                // $difference= $new_qty-$old_qty;
                // $product->qty+=$difference; 
                // $product->save();
            }
        }
    }
    public function  __get_product_qty($product_id){
        $product = Product::find($product_id);

        /*Check if the product exists*/
        if (!$product) {
            return 0;
        }

        /*Return the quantity */
        return $product->qty;
    }
}