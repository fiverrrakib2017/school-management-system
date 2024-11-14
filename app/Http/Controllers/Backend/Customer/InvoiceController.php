<?php

namespace App\Http\Controllers\Backend\Customer;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Account_transaction;
use App\Models\Customer;
use App\Models\Customer_Invoice;
use App\Models\Customer_Invoice_Details;
use App\Models\Customer_Transaction_History;
use App\Models\Add_Contract;
use App\Models\Ledger;
use App\Models\Product;
use App\Models\Sub_ledger;
use App\Models\User;
use App\Services\InvoiceService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;


class InvoiceController extends Controller
{
    protected $invoiceService;
    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService=$invoiceService;
    }
    public function create_invoice(){
        return $this->invoiceService->createInvoice('Customer');
    }

    public function show_invoice(){
        return view('Backend.Pages.Customer.invoice');
    }
    public function view_invoice($id){
    //    $data=  Customer_Invoice::with('customer','items.product')->find($id);
    //    $pdf = Pdf::loadView('Backend.Pages.Customer.invoice_view',compact('data'));
    //    return $pdf->stream('customer_invoice.pdf');
    }
    public function edit_invoice($id){
       $invoice_data=  Customer_Invoice::with('customer','items.product')->find($id);
       return view('Backend.Pages.Customer.invoice_edit',compact('invoice_data'));
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
        $invoice->customer_id = $request->customer_id;
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
        /* 1= user id by default */
        return response()->json($this->invoiceService->store_invoice($request,1,'customer'));
    }

    public function delete_invoice(Request $request){
        $invoice = Customer_Invoice::find($request->id);
        $invoice->delete();
        return response()->json(['success'=>true,'message' => 'Invoice deleted successfully']);
    }
    public function pay_due_amount(Request $request){
        $request->validate([
            'id' => 'required|integer',
            'amount' => 'required|numeric',
        ]);

        $invoice =Customer_Invoice::find($request->id);
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
        $object = new Customer_Transaction_History();
        $object->invoice_id = $request->id;
        $object->customer_id = $invoice->customer_id;
        $object->amount = $request->amount;
        $object->status = 1;
        $object->save();

        return response()->json(['success'=>true,'message' => 'Payment successful'], 200);
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
