<?php

namespace App\Http\Controllers\Backend\Supplier;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Add_Contract;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Supplier_Invoice;
use App\Models\Customer_Invoice;
use App\Models\Supplier_Invoice_Details;
use App\Models\Supplier_Transaction_History;
use App\Services\InvoiceService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class Supplier_invoiceController extends Controller
{
    protected $invoiceService;
    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService=$invoiceService;
    }
    public function create_invoice(){
        return $this->invoiceService->createInvoice('Supplier');
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
        return view('Backend.Pages.Supplier.invoice');
    }
    public function view_invoice($id){
       $data=  Supplier_Invoice::with('supplier','items.product')->find($id);
       $pdf = Pdf::loadView('Backend.Pages.Supplier.invoice_view',compact('data'));
       return $pdf->stream('supplier_invoice.pdf');
    }
    public function edit_invoice($id){
        $supplier=Supplier::latest()->get();
        $product=Product::latest()->get();
        $products=Product::with('product_image')->paginate(10);
        $data=Supplier_Invoice::with('supplier','items')->where('id',$id)->get();
       return view('Backend.Pages.Supplier.invoice_edit',compact('data','supplier','product','products'));
    }
    public function update_invoice(Request $request){
        /* Validate the request data*/
        $this->__validate_method($request)->validate();
        /*check invoice existing*/
        $invoice = Supplier_Invoice::find($request->id);
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
        $invoice = Supplier_Invoice::find($request->id);
        $invoice->supplier_id = $request->supplier_id;
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
        $columnsForOrderBy = ['id', 'fullname', 'phone_number','total_amount', 'paid_amount', 'due_amount','status','created_at'];
        $orderByColumn = $request->order[0]['column'];
        $orderDirection = $request->order[0]['dir'];

        $query = Supplier_Invoice::with('supplier')->when($search, function ($query) use ($search) {
            $query->where('total_amount', 'like', "%$search%")
                  ->orWhere('paid_amount', 'like', "%$search%")
                  ->orWhere('due_amount', 'like', "%$search%")
                  ->orWhere('created_at', 'like', "%$search%")
                  ->orWhereHas('supplier', function ($query) use ($search) {
                      $query->where('fullname', 'like', "%$search%")
                            ->orWhere('phone_number', 'like', "%$search%");
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
        $validator = Validator::make($request->all(), [
            'supplier_id' => 'required|integer',
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
        ]);
        /* If validation fails, return the error response*/
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        /*Create the invoice*/
        $invoice = new Supplier_Invoice();
        $invoice->supplier_id = $request->supplier_id;
        $invoice->total_amount = $request->total_amount;
        $invoice->paid_amount = $request->paid_amount ?? 0;
        $invoice->due_amount = $request->due_amount ?? $request->total_amount;
        $invoice->save();


        /* Create invoice items*/
        foreach ($request->product_id as $index => $productId) {
            $invoiceItem = new Supplier_Invoice_Details();
            $invoiceItem->invoice_id = $invoice->id;
            $invoiceItem->product_id = $productId;
            $invoiceItem->qty = $request->qty[$index];
            $invoiceItem->price = $request->price[$index];
            $invoiceItem->total_price = $request->qty[$index] * $request->price[$index];
            $invoiceItem->save();
            
            /*Update product stock*/ 
            $product = Product::find($productId);
            if ($product) {
                $product->qty += $request->qty[$index];
                $product->save();
            }
        }
        return response()->json(['success' =>true, 'message'=> 'Invoice stored successfully'], 201);

    }
    public function delete_invoice(Request $request){
        $invoice = Supplier_Invoice::find($request->id);
        $invoice->delete();
        return response()->json(['success'=>true,'message' => 'Invoice deleted successfully']);
    }
    public function pay_due_amount(Request $request){
        $request->validate([
            'id' => 'required|integer',
            'amount' => 'required|numeric',
        ]);

        $invoice =Supplier_Invoice::find($request->id);
        $dueAmount = $invoice->due_amount;

        if ($request->amount > $dueAmount) {
            return response()->json(['success' => false, 'message' => 'Over Amount Not Allowed'], 400);
        }

        $paid_amount = $invoice->paid_amount + $request->amount;
        $due_amount = max($invoice->due_amount - $request->amount, 0);

        $invoice->update([
            'paid_amount' => $paid_amount,
            'due_amount' => $due_amount,
        ]);
        /*Log transaction history*/ 
        $object = new Supplier_Transaction_History();
        $object->invoice_id = $request->id;
        $object->supplier_id = $invoice->supplier_id;
        $object->amount = $request->amount;
        $object->status = 1;
        $object->save();

        return response()->json(['success'=>true,'message' => 'Payment successful'], 200);
    }
    protected function __validate_method($request){
        $ruls=[
            'supplier_id' => 'required|integer',
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
            $item = new Supplier_Invoice_Details();
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
                $product->qty+=$difference; 
                $product->save();
            }
        }
    }
}
