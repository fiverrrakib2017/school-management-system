<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Student_class;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SectionController extends Controller
{
    public function index(){
        $classes = Student_class::with('sections')->latest()->get();
       
        return view('Backend.Pages.Student.Section.index',compact('classes'));
    }
    public function all_data(Request $request){
        $search = $request->search['value'];
        $columnsForOrderBy = ['id','class_id', 'name', 'created_at'];
        $orderByColumn = $columnsForOrderBy[$request->order[0]['column']];
        $orderDirection = $request->order[0]['dir'];

        $query = Section::with(['studentClass'])->when($search, function ($query) use ($search) {

            $query->where('name', 'like', "%$search%")
                  ->orWhereHas('studentClass', function ($query) use ($search) {
                      $query->where('name', 'like', "%$search%");
                  });
        });

        $total = $query->count();
        $items = $query->orderBy($orderByColumn, $orderDirection)
                       ->skip($request->start)
                       ->take($request->length)
                       ->get();

        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $items,
        ]);
    }
    public function store(Request $request){
        /*Validate the incoming request data*/
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'class_name' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        /*Create a new Section record*/
        $section = new Section();
        $section->name = $request->name;
        $section->class_id = $request->class_name;
        $section->status = 1;

        /* Save the section record to the database*/
        $section->save();

        /* Return success response*/
        return response()->json([
            'success' => true,
            'message' => 'Section added successfully!'
        ]);
    }

    public function edit($id){
        $section = Section::find($id);

        if ($section) {
            return response()->json([
                'success' => true,
                'data' => $section
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Section not found'
        ], 404);
    }

    public function update(Request $request){
        /*Validate the incoming request data*/
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'class_name' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $section = Section::find($request->id);

        if (!$section) {
            return response()->json([
                'success' => false,
                'message' => 'Section not found'
            ], 404);
        }

        /* Update the section record */
        $section->name = $request->name;
        $section->class_id = $request->class_name;
        $section->status = 1;

        /* Save the updated section record to the database*/
        $section->save();

        /* Return success response*/
        return response()->json([
            'success' => true,
            'message' => 'Section updated successfully!'
        ]);
    }

    public function delete(Request $request){
        $section = Section::find($request->id);

        if (!$section) {
            return response()->json([
                'success' => false,
                'message' => 'Section not found'
            ], 404);
        }

        /* Delete the section record from the database */
        $section->delete();

        /* Return success response*/
        return response()->json([
            'success' => true,
            'message' => 'Section deleted successfully!'
        ]);
    }
}
