<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Student_class;
use App\Models\Student_subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Subject_controller extends Controller
{
    public function index(){
      // return  Student_subject::with('class')->get();
       $classes = Student_class::get();
        return view('Backend.Pages.Student.Subject.index',compact('classes'));
    }
    public function all_data(Request $request)
    {
        $search = $request->search['value'];
        $columnsForOrderBy = ['id', 'name', 'created_at'];
        $orderByColumnIndex = $request->order[0]['column'];
        $orderDirection = $request->order[0]['dir'];
        $orderByColumn = $columnsForOrderBy[$orderByColumnIndex];

        $query =  Student_subject::with('class');

        /*Apply the search filter*/ 
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                ->orWhereHas('class', function($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                });
            });
        }

        /* Get the total count of records*/
        $totalRecords = Student_subject::count();

        // Get the count of filtered records
        $filteredRecords = $query->count();

        /* Apply ordering, pagination and get the data*/
        $items = $query->orderBy($orderByColumn, $orderDirection)
                    ->skip($request->start)
                    ->take($request->length)
                    ->get();
    

        /* Format the data for DataTables*/
        // $formattedData = $items->map(function ($item) {
        //     return [
        //         'id' => $item->id,
        //         'name' => $item->name,
        //         'subjects' => $item->subjects->pluck('name')->implode(', '),
        //     ];
        // });

        /* Return the response in JSON format*/
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $items,
        ]);
    }

    public function store(Request $request){
        /*Validate the incoming request data*/
        $validator = Validator::make($request->all(), [
            'class_id' => 'required|integer',
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        /*Create a new  record*/
        $object = new Student_subject();
        $object->class_id = $request->class_id;
        $object->name = $request->name;

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
