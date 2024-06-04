<?php

namespace App\Http\Controllers\Backend\Accounts\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Account_transaction;
use App\Models\Master_ledger;
use App\Models\Ledger;
use Illuminate\Http\Request;

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
           $object->ledger_id=$request->ledger_id;
           $object->sub_ledger_id=$request->sub_ledger_id;
           $object->qty=$request->qty;
           $object->value=$request->amount;
           $object->total=$request->total;
           $object->save();
           return response()->json(['success' =>true, 'message'=>'Added Successfully']);
    }
}
