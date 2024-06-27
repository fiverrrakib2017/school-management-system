<?php

namespace App\Http\Controllers\Backend\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use App\Models\Supplier_Invoice;
use App\Models\Supplier_Transaction_History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function index()
    {
        return view('Backend.Pages.Supplier.index');
    }
    public function create()
    {
        return view('Backend.Pages.Supplier.Create');
    }
    public function get_all_data(Request $request)
    {
        $search = $request->search['value'];
        $columnsForOrderBy = ['id', 'profile_image','fullname','phone_number', 'created_at'];
        $orderByColumn = $request->order[0]['column'];
        $orderDirectection = $request->order[0]['dir'];
    
        $object = Supplier::when($search, function ($query) use ($search) {
            $query->where('profile_image', 'like', "%$search%");
            $query->where('fullname', 'like', "%$search%");
            $query->where('phone_number', 'like', "%$search%");
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
    public function store(Request $request)
    {
        /* Validate the form data*/
        $rules=[
            'fullname' => 'required|string',
            'email_address' => 'required|email',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone_number' => 'required|string',
            'e_contract' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'address' => 'required|string',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:1,0',
            'marital_status' => 'required|in:1,2,3',
            'verification_status' => 'required|in:1,2',
            'verification_info' => 'nullable|string',
            'opening_balance' => 'nullable|numeric',
            'bank_name' => 'required|string',
            'bank_account_name' => 'required|string',
            'bank_acc_no' => 'required|string',
            'bank_routing_no' => 'required|numeric',
            'bank_payment_status' => 'required|in:1,2',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        /*Handle file upload*/
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('Backend/uploads/photos'), $imageName);
        } else {
            $imageName = '';
        }

        /* Create a new Supplier*/
        $object = new Supplier();
        $object->fullname = $request->fullname;
        $object->profile_image = $imageName;
        $object->email_address = $request->email_address;
        $object->phone_number = $request->phone_number;
        $object->emergency_contract = $request->e_contract;
        $object->city = $request->city;
        $object->state = $request->state;
        $object->address = $request->address;
        $object->dob = $request->date_of_birth;
        $object->gender = $request->gender;
        $object->marital_status = $request->marital_status;
        $object->verification_status = $request->verification_status;
        $object->verification_info = $request->verification_info;
        $object->opening_balance = $request->opening_balance;
        $object->bank_name = $request->bank_name;
        $object->bank_acc_name = $request->bank_account_name;
        $object->bank_acc_no = $request->bank_acc_no;
        $object->bank_routing_no = $request->bank_routing_no;
        $object->bank_payment_status = $request->bank_payment_status;
        /*Save to the database table*/
        $object->save();
        return response()->json([
            'success' => true,
            'message' => 'Supplier added successfully'
        ]);
    }


    public function delete(Request $request)
    {
        $object = Supplier::find($request->id);

        if (empty($object)) {
            return response()->json(['error' => 'Supplier not found.'], 404);
        }

        /* Image Find And Delete it From Local Machine */
        if (!empty($object->profile_image)) {
            $imagePath = public_path('Backend/uploads/photos/' . $object->profile_image);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        /* Delete it From Database Table */
        $object->delete();

        return response()->json(['success' =>true, 'message'=> 'Deleted successfully.']);
    }
    public function edit($id)
    {
        $data = Supplier::find($id);
        return view('Backend.Pages.Supplier.Update', compact('data'));
    }
    public function view($id) {
        $total_invoice=Supplier_Invoice::where('supplier_id',$id)->count();
        $total_paid_amount=Supplier_Invoice::where('supplier_id',$id)->sum('paid_amount');
        $total_due_amount=Supplier_Invoice::where('supplier_id',$id)->sum('due_amount');
        $invoices = Supplier_Invoice::where('supplier_id', $id)->get();
        $data = Supplier::find($id);
        $supplier_transaction_history=Supplier_Transaction_History::where('supplier_id',$id)->get();
        return view('Backend.Pages.Supplier.Profile',compact('data','total_invoice','total_paid_amount','total_due_amount','invoices','supplier_transaction_history'));
    }

    public function update(Request $request, $id)
    {
        /* Validate the form data*/
        $rules=[
            'fullname' => 'required|string',
            'email_address' => 'required|email',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone_number' => 'required|string',
            'e_contract' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'address' => 'required|string',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:1,0',
            'marital_status' => 'required|in:1,2,3',
            'verification_status' => 'required|in:1,2',
            'verification_info' => 'nullable|string',
            'opening_balance' => 'nullable|numeric',
            'bank_name' => 'required|string',
            'bank_account_name' => 'required|string',
            'bank_acc_no' => 'required|string',
            'bank_routing_no' => 'required|numeric',
            'bank_payment_status' => 'required|in:1,2',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
        
        /* Find the Customer*/
        $object = Supplier::findOrFail($id);
        $object->fullname = $request->fullname;
       // Handle profile image update
        if ($request->hasFile('profile_image')) {
            // Delete previous image
            if (!empty($object->profile_image)) {
                $imagePath = public_path('Backend/uploads/photos/' . $object->profile_image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $imageName = time() . '.' . $request->file('profile_image')->getClientOriginalExtension();
            $request->file('profile_image')->move(public_path('Backend/uploads/photos'), $imageName);

            $object->profile_image = $imageName;
        }
        $object->email_address = $request->email_address;
        $object->phone_number = $request->phone_number;
        $object->emergency_contract = $request->e_contract;
        $object->city = $request->city;
        $object->state = $request->state;
        $object->address = $request->address;
        $object->dob = $request->date_of_birth;
        $object->gender = $request->gender;
        $object->marital_status = $request->marital_status;
        $object->verification_status = $request->verification_status;
        $object->verification_info = $request->verification_info;
        $object->opening_balance = $request->opening_balance;
        $object->bank_name = $request->bank_name;
        $object->bank_acc_name = $request->bank_account_name;
        $object->bank_acc_no = $request->bank_acc_no;
        $object->bank_routing_no = $request->bank_routing_no;
        $object->bank_payment_status = $request->bank_payment_status;
        /*Save to the database table*/
        $object->update();
        return response()->json([
            'success' => true,
            'message' => 'Supplier Update successfully'
        ]);
    }
}
