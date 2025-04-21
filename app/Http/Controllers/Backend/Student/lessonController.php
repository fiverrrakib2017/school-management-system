<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Student_lesson;
use App\Models\Student_subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class lessonController extends Controller
{
    public function create()
    {
        $subjects = Student_subject::latest()->get();
        $sections = Section::latest()->get();
        return view('Backend.Pages.Student.Lesson.create', compact('subjects', 'sections'));
    }

    public function get_all_data(Request $request)
    {
        $search = $request->search['value'];
        $columnsForOrderBy = ['id', 'name', 'year', 'start_date', 'end_date'];
        $orderByColumn = $request->order[0]['column'];
        $orderDirectection = $request->order[0]['dir'];

        $object = Student_lesson::when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%$search%");
            $query->where('year', 'like', "%$search%");
            $query->where('start_date', 'like', "%$search%");
            $query->where('end_date', 'like', "%$search%");
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
        $this->validateForm($request);

        $lesson = new Student_lesson();
        $lesson->class_id = $request->class_id;
        $lesson->section_id = $request->section_id;
        $lesson->teacher_id = $request->teacher_id;
        $lesson->subject_id = $request->subject_id;
        $lesson->lesson_date = $request->lesson_start_date;
        $lesson->lesson_name = $request->lesson_name;
        $lesson->lesson_range = $request->lesson_range;
        $lesson->approx_duration = $request->approx_duration;
        $lesson->question_and_answer = $request->question_and_answer;
        $lesson->message = $request->message;
        $lesson->status = 'pending';
        $lesson->is_repeated = 'yes';

        $lesson->save();

        if ($request->has('is_send_message') && $request->is_send_message == true) {
            //Send Message Logic Here
        }
        return response()->json([
            'success' => true,
            'message' => 'Added Successfully!',
        ]);
    }

    public function delete(Request $request)
    {
        $object = Student_lesson::find($request->id);

        if (empty($object)) {
            return response()->json(['error' => 'Examincation not found.'], 404);
        }

        /* Delete it From Database Table */
        $object->delete();

        return response()->json(['success' => true, 'message' => 'Deleted successfully.']);
    }
    public function edit($id)
    {
        $data = Student_lesson::find($id);
        if ($data) {
            return response()->json(['success' => true, 'data' => $data]);
            exit();
        } else {
            return response()->json(['success' => false, 'message' => 'Data Not Found.']);
        }
    }
    public function update(Request $request, $id)
    {
        $this->validateForm($request);

        $object = Student_lesson::findOrFail($id);
        $object->name = $request->name;
        $object->year = $request->year;
        $object->start_date = $request->start_date;
        $object->end_date = $request->end_date;
        $object->update();

        return response()->json([
            'success' => true,
            'message' => 'Update successfully!',
        ]);
    }
    private function validateForm($request)
    {
        /*Validate the form data*/
        $rules = [
            'class_id' => 'required|exists:student_classes,id',
            'section_id' => 'nullable|exists:sections,id',
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:student_subjects,id',
            'lesson_start_date' => 'required|date',
            'lesson_name' => 'required|string|max:255',
            'lesson_range' => 'required|string|max:100',
            'approx_duration' => 'required|string|max:50',
            'question_and_answer' => 'required|string|max:50',
            'message' => 'nullable|string',
            'is_send_message' => 'nullable|boolean',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'errors' => $validator->errors(),
                ],
                422,
            );
        }
    }
}
