<?php

namespace App\Http\Controllers\Backend\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Customer_Invoice;
use App\Models\Customer_Transaction_History;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function App\Helpers\__get_invoice_data;

class CustomerController extends Controller
{
    public function index()
    {
        return view('Backend.Pages.Customer.index');
    }
    public function create()
    {
        return view('Backend.Pages.Customer.Create');
    }
    public function get_all_data(Request $request)
    {
        $search = $request->search['value'];
        $columnsForOrderBy = ['id', 'profile_image','fullname','phone_number', 'created_at'];
        $orderByColumn = $request->order[0]['column'];
        $orderDirectection = $request->order[0]['dir'];
    
        $object = Customer::when($search, function ($query) use ($search) {
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
        // Validate the form data
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

        // Handle file upload
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('Backend/uploads/photos'), $imageName);
        } else {
            $imageName = '';
        }

        // Create a new Customer
        $object = new Customer();
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
        // Save to the database table
        $object->save();

        // Redirect to the index page or show success message
        //return redirect()->route('admin.customer.index')->with('success', 'Customer added successfully');
        return response()->json([
            'success' => true,
            'message' => 'Customer added successfully!'
        ]);
    }


    public function delete(Request $request)
    {
        $object = Customer::find($request->id);

        if (empty($object)) {
            return response()->json(['error' => 'Customer not found.'], 404);
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
        $data = Customer::find($id);
        return view('Backend.Pages.Customer.Update', compact('data'));
    }
    public function view($id) {
        $total_invoice=Customer_Invoice::where('customer_id',$id)->count();
        $total_paid_amount=Customer_Invoice::where('customer_id',$id)->sum('paid_amount');
        $total_due_amount=Customer_Invoice::where('customer_id',$id)->sum('due_amount');
        $invoices = Customer_Invoice::where('customer_id', $id)->get();
        $data = Customer::find($id);
        $customer_transaction_history=Customer_Transaction_History::where('customer_id',$id)->get();
        return view('Backend.Pages.Customer.Profile',compact('data','total_invoice','total_paid_amount','total_due_amount','invoices','customer_transaction_history'));
    }

    public function update(Request $request, $id)
    {
        /*Validate the form data*/ 
        $rules=[
            'fullname' => 'required|string',
            'email_address' => 'required|email',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone_number' => 'nullable|string',
            'e_contract' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:1,0',
            'marital_status' => 'nullable|in:1,2,3',
            'verification_status' => 'nullable|in:1,2',
            'verification_info' => 'nullable|string',
            'opening_balance' => 'nullable|numeric',
            'bank_name' => 'nullable|string',
            'bank_account_name' => 'nullable|string',
            'bank_acc_no' => 'nullable|string',
            'bank_routing_no' => 'nullable|numeric',
            'bank_payment_status' => 'nullable|in:1,2',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
        
        /* Find the Customer*/

        $object = Customer::findOrFail($id);
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
        $object->update();

        return response()->json([
            'success' => true,
            'message' => 'Customer Update successfully!'
        ]);
    }
}
