<?php
namespace App\Services;
use App\Models\Customer;
use App\Models\Customer_Invoice;
use App\Models\Account_transaction;
use App\Models\Customer_Invoice_Details;
use App\Models\Supplier_Invoice_Details;
use App\Models\Ledger;
use App\Models\Sub_ledger;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Supplier_Invoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class InvoiceService{
    public function createInvoice($type){
        $data=array();
        $data['product']=Product::latest()->get();
        if ($type === 'Customer') {
            $data['customer'] = Customer::latest()->get();
            return view('Backend.Pages.Customer.invoice_create')->with($data);
        } elseif ($type === 'Supplier') {
            $data['supplier']=Supplier::latest()->get();
            return view('Backend.Pages.Supplier.invoice_create')->with($data);
        }

    }
    public function store_invoice($request, $userId=1, $type = 'customer')
    {
        $this->__validate_method($request);
        DB::beginTransaction();
        try {
            $invoice = new Customer_Invoice();
            $invoice = $type === 'supplier' ? new Supplier_Invoice() : new Customer_Invoice();
            $invoice->transaction_number = "TRANSID-".strtoupper(uniqid());
            $invoice->usr_id = $userId;

            /*Create A logic for customer and supplier*/
            if (!empty($type) && isset($type) && $type === 'customer') {
                $invoice->customer_id = $request->client_id;
            }else{
                $invoice->supplier_id = $request->client_id;
            }

            $invoice->invoice_date = $request->date;
            $invoice->sub_total = $request->table_total_amount ?? 0;
            $invoice->discount = $request->table_discount_amount ?? 0;
            $invoice->grand_total = $request->table_total_amount ?? 0;
            $invoice->due_amount = $request->table_due_amount ?? 0;
            $invoice->paid_amount = $request->table_paid_amount ?? 0;
            $invoice->note = $request->note ?? '';
            $invoice->status = $request->table_status ?? 0;
            $invoice->save();
            /* Add invoice details */
            foreach ($request->table_product_id as $index => $productId) {
                if (!empty($request->table_status) && $request->table_status == '1' && isset($request->table_status)) {
                    $product = Product::find($productId);
                    if (!empty($product)) {
                        $sub_ledger_id = $product->sales_ac;
                        $sub_ledger_id = $type === 'supplier' ? $product->purchase_ac : $product->sales_ac;
                        $sub_ledger = Sub_ledger::find($sub_ledger_id);

                        if (!empty($sub_ledger)) {
                            $ledger_id = $sub_ledger->ledger_id;
                            $master_ledger = Ledger::find($ledger_id);

                            if (!empty($master_ledger)) {
                                $master_ledger_id = $master_ledger->master_ledger_id ;
                                /*Ledger Transaction Data Insert*/
                                $account_transaction=new Account_transaction();
                                $account_transaction->type=$master_ledger_id;
                                $account_transaction->refer_no=$type==='supplier'?'SI-'.strtoupper(uniqid()):'CI-'.strtoupper(uniqid());
                                $account_transaction->transaction_number=$invoice->transaction_number;
                                $account_transaction->description='default===oops';
                                $account_transaction->master_ledger_id=$master_ledger_id;
                                $account_transaction->ledger_id=$ledger_id;
                                $account_transaction->sub_ledger_id=$sub_ledger_id;
                                $account_transaction->qty=$request->table_qty[$index];
                                $account_transaction->value=intval($request->table_price[$index]);
                                $account_transaction->total=intval($request->table_qty[$index] * $request->table_price[$index]);
                                $account_transaction->save();
                            }
                        }
                    }

                }
                $inv_details = $type ==='customer' ? new Customer_Invoice_Details() : new Supplier_Invoice_Details();
                $inv_details->invoice_id = $invoice->id;
                $inv_details->transaction_number = $invoice->transaction_number;
                $inv_details->product_id = $productId;
                $inv_details->qty = $request->table_qty[$index];
                $inv_details->price = intval($request->table_price[$index]);
                $inv_details->total_price = intval($request->table_qty[$index] * $request->table_price[$index]);
                $inv_details->status = $request->table_status ?? 0;
                $inv_details->save();
            }

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Invoice created successfully.']);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Error creating invoice: ' . $e->getMessage()]);
        }
    }
    private function __validate_method($request){

        /*Validate the form data*/
        $rules=[
           'client_id' => 'required|exists:customers,id',
           'date' => 'required|date',
           'table_product_id' => 'required|array',
           'table_product_id.*' => 'exists:products,id',
           'table_qty' => 'required|array',
           'table_qty.*' => 'integer|min:1',
           'table_price' => 'required|array',
           'table_price.*' => 'numeric|min:0',
           'table_total_price' => 'required|array',
           'table_total_price.*' => 'numeric|min:0',
           'products' => 'required|array',
           'products.*.product_id' => 'required|exists:products,id',
           'products.*.qty' => 'required|integer|min:1',
           'products.*.price' => 'required|numeric|min:0',
       ];
       $validator = Validator::make($request->all(), $rules);

       if ($validator->fails()) {
           return response()->json([
               'success' => false,
               'errors' => $validator->errors()
           ], 422);
       }
   }
}
