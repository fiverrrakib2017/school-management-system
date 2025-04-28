<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Student_class;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class classController extends Controller
{
    public function index(){
       // $studentClasses = Student_class::with('sections')->get();
        $data=Section::latest()->get();
        return view('Backend.Pages.Student.Class.index',compact('data'));
    }
    public function all_data(Request $request)
    {
        $search = $request->search['value'] ?? null;

    $columnsForOrderBy = ['id', 'name'];

    $orderByColumnIndex = $request->order[0]['column'] ?? 0;
    $orderByColumn = $columnsForOrderBy[$orderByColumnIndex] ?? 'id';
    $orderDirection = $request->order[0]['dir'] ?? 'asc';

    $query = Student_class::with(['section'])
        ->when($search, function ($q) use ($search) {
            $q->where(function ($subQuery) use ($search) {
                $subQuery->where('name', 'like', "%{$search}%");
            });
        });

    $totalRecords = Student_class::count();
    $filteredRecords = $query->count();

    $items = $query->orderBy($orderByColumn, $orderDirection)
                   ->skip($request->start ?? 0)
                   ->take($request->length ?? 10)
                   ->get();

    return response()->json([
        'draw' => intval($request->draw),
        'recordsTotal' => $totalRecords,
        'recordsFiltered' => $filteredRecords,
        'data' => $items,
    ]);
    }

    public function store(Request $request){
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

        /*Create a new class record*/
        $object = new Student_class();
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
