<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Student_class;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index(){
        return view('Backend.Pages.Student.index');
    }
    public function create(){
         $data=Student_class::latest()->get();
        return view('Backend.Pages.Student.create',compact('data'));
    }
    public function edit($id){
        $data = Student::find($id);

        if ($data) {
            return view('Backend.Pages.Student.edit',compact('data'));
        }
    }
    public function all_data(Request $request){
        $search = $request->search['value'];
        $columnsForOrderBy = ['id', 'name','gender','status', 'created_at'];
        $orderByColumn = $request->order[0]['column'];
        $orderDirectection = $request->order[0]['dir'];

        $object = Student::when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%$search%");
            $query->where('gender', 'like', "%$search%");
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
    public function store(Request $request)
    {
        /*Validate the incoming request data*/
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|string|max:10',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'guardian_name' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'current_address' => 'required|string|max:255',
            'permanent_address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'nullable|string|email|max:255',
            'current_class' => 'required|max:50',
            'previous_school' => 'nullable|string|max:255',
            'previous_class' => 'nullable|max:50',
            'academic_results' => 'nullable|string|max:255',
            'blood_group' => 'nullable|string|max:10',
            'health_conditions' => 'nullable|string|max:255',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string|max:15',
            'religion' => 'nullable|string|max:50',
            'nationality' => 'nullable|string|max:50',
            'remarks' => 'nullable|string',
            'status'=>'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        /* Handle the file upload*/
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/photos'), $filename);
        } else {
            $filename = null;
        }

        /*Create a new student record*/
        $student = new Student();
        $student->name = $request->name;
        $student->birth_date = $request->birth_date;
        $student->gender = $request->gender;
        $student->father_name = $request->father_name;
        $student->mother_name = $request->mother_name;
        $student->guardian_name = $request->guardian_name;
        $student->photo = $filename;
        $student->current_address = $request->current_address;
        $student->permanent_address = $request->permanent_address;
        $student->phone = $request->phone;
        $student->email = $request->email;
        $student->current_class = $request->current_class;
        $student->previous_school = $request->previous_school;
        $student->previous_class = $request->previous_class;
        $student->academic_results = $request->academic_results;
        $student->blood_group = $request->blood_group;
        $student->health_conditions = $request->health_conditions;
        $student->emergency_contact_name = $request->emergency_contact_name;
        $student->emergency_contact_phone = $request->emergency_contact_phone;
        $student->religion = $request->religion;
        $student->nationality = $request->nationality;
        $student->remarks = $request->remarks;
        $student->status = $request->status;

        /* Save the student record to the database*/
        $student->save();

        /* Return success response*/
        return response()->json([
            'success' => true,
            'message' => 'Student added successfully!'
        ]);
    }
    public function update(Request $request, $id=NULL){
        /*Validate the incoming request data*/
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|string|max:10',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'guardian_name' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'current_address' => 'required|string|max:255',
            'permanent_address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'nullable|string|email|max:255',
            'current_class' => 'required|string|max:50',
            'previous_school' => 'nullable|string|max:255',
            'previous_class' => 'nullable|string|max:50',
            'academic_results' => 'nullable|string|max:255',
            'blood_group' => 'nullable|string|max:10',
            'health_conditions' => 'nullable|string|max:255',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string|max:15',
            'religion' => 'nullable|string|max:50',
            'nationality' => 'nullable|string|max:50',
            'remarks' => 'nullable|string',
            'status'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $student = Student::find($id);
        $student->name = $request->name;
        $student->birth_date = $request->birth_date;
        $student->gender = $request->gender;
        $student->father_name = $request->father_name;
        $student->mother_name = $request->mother_name;
        $student->guardian_name = $request->guardian_name;
         /* Handle the file upload*/
         if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/photos'), $filename);
            $student->photo = $filename;
        }

        $student->current_address = $request->current_address;
        $student->permanent_address = $request->permanent_address;
        $student->phone = $request->phone;
        $student->email = $request->email;
        $student->current_class = $request->current_class;
        $student->previous_school = $request->previous_school;
        $student->previous_class = $request->previous_class;
        $student->academic_results = $request->academic_results;
        $student->blood_group = $request->blood_group;
        $student->health_conditions = $request->health_conditions;
        $student->emergency_contact_name = $request->emergency_contact_name;
        $student->emergency_contact_phone = $request->emergency_contact_phone;
        $student->religion = $request->religion;
        $student->nationality = $request->nationality;
        $student->remarks = $request->remarks;
        $student->status = $request->status;
        /* Save the student record to the database*/
        $student->update();

        /* Return success response*/
        return response()->json([
            'success' => true,
            'message' => 'Student Update Successfully!'
        ]);
    }

    public function delete(Request $request)
    {
        $student = Student::find($request->id);

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found!'
            ], 404);
        }

        /*Check if the student has a photo*/
        if ($student->photo) {
            /* Delete the student's photo file*/
            $photoPath = public_path('uploads/photos/' . $student->photo);
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
        }

        /* Delete the student record from the database*/
        $student->delete();

        return response()->json([
            'success' => true,
            'message' => 'Student deleted successfully!'
        ]);
    }

}
