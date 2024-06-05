<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\Student_class;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class classController extends Controller
{
    public function index(){
        return view('Backend.Pages.Student.Class.index');
    }
    public function all_data(Request $request){
        $search = $request->search['value'];
        $columnsForOrderBy = ['id', 'name','status', 'created_at'];
        $orderByColumn = $request->order[0]['column'];
        $orderDirectection = $request->order[0]['dir'];

        $object = Student_class::when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%$search%");
            $query->where('status', 'like', "%$search%");
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
    public function store(Request $request){
        /*Validate the incoming request data*/
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        /*Create a new class record*/
        $object = new Student_class();
        $object->name = $request->name;
        $object->status = $request->status;

        /* Save the class record to the database*/
        $object->save();

        /* Return success response*/
        return response()->json([
            'success' => true,
            'message' => 'Added successfully!'
        ]);
    }

    public function edit($id){
        $object = Student_class::find($id);

        if ($object) {
            return response()->json([
                'success' => true,
                'data' => $object
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Class not found'
        ], 404);
    }

    public function update(Request $request){
        /*Validate the incoming request data*/
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $object = Student_class::find($request->id);

        if (!$object) {
            return response()->json([
                'success' => false,
                'message' => 'Class not found'
            ], 404);
        }

        /* Update the Class record */
        $object->name = $request->name;
        $object->status = $request->status;

        /* Save the updated Class record to the database*/
        $object->save();

        /* Return success response*/
        return response()->json([
            'success' => true,
            'message' => 'Class updated successfully!'
        ]);
    }

    public function delete(Request $request){
        $object = Student_class::find($request->id);

        if (!$object) {
            return response()->json([
                'success' => false,
                'message' => 'Section not found'
            ], 404);
        }

        /* Delete the class record from the database */
        $object->delete();

        /* Return success response*/
        return response()->json([
            'success' => true,
            'message' => 'Class deleted successfully!'
        ]);
    }
}
