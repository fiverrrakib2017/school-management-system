<?php

namespace App\Http\Controllers\Backend\Student;
use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Student;
use App\Models\Student_class;
use App\Models\Student_exam_routine;
use App\Models\Student_subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ExamRoutine_controller extends Controller
{
    public function index()
    {
        $sections = Section::latest()->get();
        return view('Backend.Pages.Student.Exam.Routine.index', compact('sections'));
    }
    public function create()
    {
        $sections = Section::latest()->get();
        // $subjects = Student_subject::latest()->get();
        return view('Backend.Pages.Student.Exam.Routine.create', compact('sections'));
    }

    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'exam_id' => 'required|integer',
            'class_id' => 'required|integer',
            'routines' => 'required|array',
            'routines.*.subject_id' => 'required|integer',
            'routines.*.exam_date' => 'required|date',
            'routines.*.start_time' => 'required',
            'routines.*.end_time' => 'required',
        ]);

        // Fetch existing exam routines
        $existingRoutines = Student_exam_routine::where([['exam_id', '=', $request->exam_id], ['class_id', '=', $request->class_id], ['section_id', '=', $request->section_id]])->get();

        // Process each routine submitted in the request
        foreach ($request->routines as $routineData) {
            try {
                $start_time = Carbon::parse($routineData['start_time'])->format('H:i:s');
                $end_time = Carbon::parse($routineData['end_time'])->format('H:i:s');
            } catch (\Exception $e) {
                return response()->json(['error' => 'Invalid time format: ' . $e->getMessage()], 422);
            }

            // $has_written = !empty($routineData['written_full']) && !empty($routineData['written_pass']);
            // $has_objective = !empty($routineData['objective_full']) && !empty($routineData['objective_pass']);
            // $has_practical = !empty($routineData['practical_full']) && !empty($routineData['practical_pass']);

            // Check if the routine already exists, if not create a new one
            $examRoutine = Student_exam_routine::where([['exam_id', '=', $request->exam_id], ['class_id', '=', $request->class_id], ['section_id', '=', $request->section_id], ['subject_id', '=', $routineData['subject_id']], ['exam_date', '=', $routineData['exam_date']]])->first();

            // If not found, create a new instance
            if (!$examRoutine) {
                $examRoutine = new Student_exam_routine();
            }

            // Set data to the examRoutine
            $examRoutine->exam_id = $request->exam_id;
            $examRoutine->class_id = $request->class_id;
            $examRoutine->section_id = $request->section_id;
            $examRoutine->subject_id = $routineData['subject_id'];
            $examRoutine->exam_date = $routineData['exam_date'];
            $examRoutine->start_time = $start_time;
            $examRoutine->end_time = $end_time;
            $examRoutine->room_number = $routineData['room_number'];

            $examRoutine->has_written = empty($routineData['written_full']) && empty($routineData['written_pass']) ? 0 : 1;

            $examRoutine->written_full = $routineData['written_full'] ?? null;
            $examRoutine->written_pass = $routineData['written_pass'] ?? null;

            $examRoutine->has_objective = empty($routineData['objective_full']) && empty($routineData['objective_pass']) ? 0 : 1;
            $examRoutine->objective_full = $routineData['objective_full'] ?? null;
            $examRoutine->objective_pass = $routineData['objective_pass'] ?? null;

            $examRoutine->has_practical = empty($routineData['practical_full']) && empty($routineData['practical_pass']) ? 0 : 1;
            $examRoutine->practical_full = $routineData['practical_full'] ?? null;
            $examRoutine->practical_pass = $routineData['practical_pass'] ?? null;

            $examRoutine->save();
        }
        $routinesToDelete = $existingRoutines->filter(function ($existingRoutine) use ($request) {
            foreach ($request->routines as $routineData) {
                if ($existingRoutine->subject_id == $routineData['subject_id'] && $existingRoutine->exam_date == $routineData['exam_date']) {
                    return false;
                }
            }
            return true;
        });

        foreach ($routinesToDelete as $routineToDelete) {
            $routineToDelete->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully!',
        ]);
    }
    public function get_exam_attendance(Request $request){
        $class_id = $request->class_id;
        $exam_id = $request->exam_id;

        $exam_routine = Student_exam_routine::with('subject')->where('class_id', $class_id)
                                            ->where('exam_id', $exam_id)
                                            ->get();

        $students = Student::where('current_class', $class_id)->get();

        $html = '<table class="table table-bordered table-hover table-sm text-center">';
        $html .= '<thead><tr><th>Roll</th><th>Name</th>';

        if ($exam_routine->count() > 0) {
            foreach ($exam_routine as $routine) {
                $html .= '<th>' . $routine->subject->name . '<br/>' . date('d.M.Y', strtotime($routine->exam_date)) . '</th>';
            }
        } else {
            $html .= '<th>No Data Found</th>';
        }

        $html .= '</tr></thead><tbody>';

        if ($students->count() > 0) {
            foreach ($students as $student) {
                $html .= '<tr>';
                $html .= '<td>' . $student->roll_no . '</td>';
                $html .= '<td>' . $student->name . '</td>';

                if ($exam_routine->count() > 0) {
                    foreach ($exam_routine as $routine) {
                        $html .= '<td></td>'; // Empty cell for attendance mark or data
                    }
                } else {
                    $html .= '<td colspan="1">No Exam Routine Available</td>';
                }

                $html .= '</tr>';
            }
        } else {
            $html .= '<tr><td colspan="' . ($exam_routine->count() + 2) . '">No Students Found</td></tr>';
        }

        $html .= '</tbody></table>';

        return $html;
    }



    public function delete(Request $request)
    {
        $object = Student_exam_routine::find($request->id);

        if (empty($object)) {
            return response()->json(['error' => 'Not found.'], 404);
        }

        /* Delete it From Database Table */
        $object->delete();

        return response()->json(['success' => true, 'data' => $object, 'message' => 'Deleted successfully.']);
    }
    public function edit($id)
    {
        $data = Student_exam_routine::find($id);
        if ($data) {
            return response()->json(['success' => true, 'data' => $data]);
            exit();
        } else {
            return response()->json(['success' => false, 'message' => 'Not found.']);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validateForm($request);

        $object = Student_exam_routine::findOrFail($id);
        $object->exam_id = $request->exam_id;
        $object->class_id = $request->class_id;
        $object->subject_id = $request->subject_id;
        $object->exam_date = $request->exam_date;
        $object->start_time = $request->start_time;
        $object->end_time = $request->end_time;
        $object->room_number = $request->room_number;
        $object->invigilator = $request->invigilator_name;
        $object->update();

        return response()->json([
            'success' => true,
            'message' => 'Update successfully!',
        ]);
    }
    public function get_exam_routine(Request $request)
    {
        $class_id = $request->class_id;
        $exam_id = $request->exam_id;
        $data = Student_exam_routine::with(['exam', 'class', 'subject'])
            ->where(['exam_id' => $exam_id, 'class_id' => $class_id])
            ->get();
        $subjects = Student_subject::where('class_id', $class_id)->get(['id', 'name']);
        if ($data) {
            return response()->json(['success' => true, 'data' => $data, 'subjects' => $subjects]);
            exit();
        } else {
            return response()->json(['success' => false, 'message' => 'Not found.']);
        }
    }
    private function validateForm($request)
    {
        /*Validate the form data*/
        $rules = [
            'exam_id' => 'required|integer',
            'class_id' => 'required|integer',
            'routines' => 'required|array',
            'routines.*.subject_id' => 'required|integer',
            'routines.*.exam_date' => 'required|date',
            'routines.*.start_time' => 'required',
            'routines.*.end_time' => 'required',
            'routines.*.room_number' => 'required',
            'routines.*.invigilator_name' => 'required|string',
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
