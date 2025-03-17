<?php

namespace App\Http\Controllers\Backend\Accounts\Master_Ledger;

use App\Http\Controllers\Controller;
use App\Models\Master_Ledger;
use Illuminate\Http\Request;

class MasterLedgerController extends Controller
{
    public function index(){
        return view('Backend.Pages.Accounts.Master_Ledger.index');
    }
    public function get_all_data(Request $request){
        $search = $request->search['value'];
        $columnsForOrderBy = ['id', 'name','status','status', 'created_at'];
        $orderByColumn = $request->order[0]['column'];
        $orderDirectection = $request->order[0]['dir'];

        $object = Master_ledger::when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%$search%");
            $query->where('status', 'like', "%$search%");
            $query->where('created_at', 'like', "%$search%");
        })->orderBy($columnsForOrderBy[$orderByColumn], $orderDirectection);

        $total = $object->count();
        $item = $object->skip($request->start)->take($request->length)->get();

        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $item,
        ]);
    }
}
