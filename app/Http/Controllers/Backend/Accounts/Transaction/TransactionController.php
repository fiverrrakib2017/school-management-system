<?php

namespace App\Http\Controllers\Backend\Accounts\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Account_transaction;
use App\Models\Master_ledger;
use App\Models\Ledger;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index(){
        $master_ledger=Master_ledger::where('status',1)->latest()->get();
        $ledger=Ledger::where('status',1)->latest()->get();
        return view('Backend.Pages.Accounts.Transaction.index',compact('ledger','master_ledger'));
    }
    public function store(Request $request){
        $request->validate([
            'transaction_type'=>'required|integer',
            'ledger_id'=>'required|integer|max:255',
            'sub_ledger_id'=>'required|integer|max:255',
            'qty'=>'required|integer',
            'amount'=>'required|integer',
            'total'=>'required|integer',
            
           ]);
           $object=new Account_transaction();
           $object->type=$request->transaction_type;
           $object->refer_no=$request->refer_no;
           $object->description=$request->description;
           $object->master_ledger_id=$request->transaction_type;
           $object->ledger_id=$request->ledger_id;
           $object->sub_ledger_id=$request->sub_ledger_id;
           $object->qty=$request->qty;
           $object->value=$request->amount;
           $object->total=$request->total;
           $object->save();
           return response()->json(['success' =>true, 'message'=>'Added Successfully']);
    }
    public function transaction_report(){
        $master_ledger=Master_ledger::where('status',1)->latest()->get();
        return view('Backend.Pages.Accounts.Transaction.Report.index',compact('master_ledger'));
    }
    public function report_generate(Request $request)
    {
        /*Validate date inputs*/ 
        $request->validate([
            'from_date' => 'required|date',
            'master_ledger_id' => 'required|integer',
            'to_date' => 'required|date|after_or_equal:from_date',
        ]);

        /* Get data based on selected date range*/
        $from_date = Carbon::createFromFormat('Y-m-d', $request->from_date)->startOfDay();
        $to_date = Carbon::createFromFormat('Y-m-d', $request->to_date)->endOfDay();
        $master_ledger_id = $request->master_ledger_id;

        /* Fetch data with relations*/
        $transactions = Account_transaction::with(['ledger', 'sub_ledger'])
        ->where('master_ledger_id', $master_ledger_id)
         ->whereBetween('created_at', [$from_date, $to_date])
        ->get()
        ->groupBy('ledger.ledger_name');

        $master_ledger = Master_ledger::where('status', 1)->latest()->get();
        $ledger = Ledger::where('status', 1)->latest()->get();

        return view('Backend.Pages.Accounts.Transaction.Report.index', compact('transactions', 'master_ledger', 'ledger'));
    }

}
