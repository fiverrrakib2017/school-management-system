<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    public function create(){
        return view('Backend.Pages.Teacher.create');
    }
    public function index(){
        return view('Backend.Pages.Teacher.index');
    }
    public function all_data(Request $request){
        $search = $request->search['value'];
        $columnsForOrderBy = ['id', 'name','gender','status', 'created_at'];
        $orderByColumn = $request->order[0]['column'];
        $orderDirectection = $request->order[0]['dir'];

        $object = Teacher::when($search, function ($query) use ($search) {
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
    public function store(Request $request){
        /*Validate the incoming request data*/
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:teachers',
            'phone' => 'required|string|max:15',
            'subject' => 'required|string|max:255',
            'hire_date' => 'required|date',
            'address' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'gender' => 'required|string',
            'birth_date' => 'required|date',
            'national_id' => 'required|string|max:255|unique:teachers',
            'religion' => 'required|string|max:255',
            'blood_group' => 'nullable|string|max:255',
            'highest_education' => 'required|string|max:255',
            'previous_school' => 'nullable|string|max:255',
            'designation' => 'required|string|max:255',
            'salary' => 'required|integer',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string|max:15',
            'remarks' => 'nullable|string|max:500',
            'status'=>'required|integer'
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
        /*Create a new teacher record*/
        $teacher = new Teacher();
        $teacher->name = $request->name;
        $teacher->email = $request->email;
        $teacher->phone = $request->phone;
        $teacher->subject = $request->subject;
        $teacher->hire_date = $request->hire_date;
        $teacher->address = $request->address;
        $teacher->photo = $filename;
        $teacher->father_name = $request->father_name;
        $teacher->mother_name = $request->mother_name;
        $teacher->gender = $request->gender;
        $teacher->birth_date = $request->birth_date;
        $teacher->national_id = $request->national_id;
        $teacher->religion = $request->religion;
        $teacher->blood_group = $request->blood_group;
        $teacher->highest_education = $request->highest_education;
        $teacher->previous_school = $request->previous_school;
        $teacher->designation = $request->designation;
        $teacher->salary = $request->salary;
        $teacher->emergency_contact_name = $request->emergency_contact_name;
        $teacher->emergency_contact_phone = $request->emergency_contact_phone;
        $teacher->remarks = $request->remarks;
        $teacher->status = $request->status;

        /* Save the teacher record to the database*/
        $teacher->save();

        /* Return success response*/
        return response()->json([
            'success' => true,
            'message' => 'Teacher added successfully!'
        ]);
    }
    public function edit($id){
        $data = Teacher::find($id);

        if ($data) {
            return view('Backend.Pages.Teacher.edit',compact('data'));
        }
    }
    public function view($id){
        $teacher = Teacher::find($id);

        if ($teacher) {
            return view('Backend.Pages.Teacher.view',compact('teacher'));
        }
    }
    public function update(Request $request, $id=NULL){
        /* Find the teacher record */
        $teacher = Teacher::findOrFail($id);
        /* Validate the incoming request data */
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:teachers,email,' . $teacher->id,
            'phone' => 'required|string|max:15',
            'subject' => 'required|string|max:255',
            'hire_date' => 'required|date',
            'address' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'gender' => 'required|string',
            'birth_date' => 'required|date',
            'national_id' => 'required|string|max:255|unique:teachers,national_id,' . $teacher->id,
            'religion' => 'required|string|max:255',
            'blood_group' => 'nullable|string|max:255',
            'highest_education' => 'required|string|max:255',
            'previous_school' => 'nullable|string|max:255',
            'designation' => 'required|string|max:255',
            'salary' => 'required|integer',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string|max:15',
            'remarks' => 'nullable|string|max:500',
            'status' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $teacher->name = $request->name;
        $teacher->email = $request->email;
        $teacher->phone = $request->phone;
        $teacher->subject = $request->subject;
        $teacher->hire_date = $request->hire_date;
        $teacher->address = $request->address;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/photos'), $filename);
            $teacher->photo = $filename;
        }

        $teacher->father_name = $request->father_name;
        $teacher->mother_name = $request->mother_name;
        $teacher->gender = $request->gender;
        $teacher->birth_date = $request->birth_date;
        $teacher->national_id = $request->national_id;
        $teacher->religion = $request->religion;
        $teacher->blood_group = $request->blood_group;
        $teacher->highest_education = $request->highest_education;
        $teacher->previous_school = $request->previous_school;
        $teacher->designation = $request->designation;
        $teacher->salary = $request->salary;
        $teacher->emergency_contact_name = $request->emergency_contact_name;
        $teacher->emergency_contact_phone = $request->emergency_contact_phone;
        $teacher->remarks = $request->remarks;
        $teacher->status = $request->status;
        /* Save the teacher record to the database*/
        $teacher->update();

        /* Return success response*/
        return response()->json([
            'success' => true,
            'message' => 'Teacher Update Successfully!'
        ]);
    }
    public function delete(Request $request)
    {
        $teacher = Teacher::find($request->id);

        if (!$teacher) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found!'
            ], 404);
        }

        /*Check if the Teacher has a photo*/
        if ($teacher->photo) {
            /* Delete the Teacher's photo file*/
            $photoPath = public_path('uploads/photos/' . $teacher->photo);
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
        }

        /* Delete the Teacher record from the database*/
        $teacher->delete();

        return response()->json([
            'success' => true,
            'message' => 'Teacher deleted successfully!'
        ]);
    }
}
