<?php

namespace App\Http\Controllers\Backend\Student;
use App\Http\Controllers\Controller;
use App\Models\Customer_ticket;
use App\Models\Section;
use App\Models\Student;
use App\Models\Student_class;
use App\Models\Student_exam;
use App\Models\Student_exam_result;
use App\Models\Student_exam_routine;
use App\Models\Student_subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Exam_result_controller extends Controller
{
    public function create_result()
    {
        $sections = Section::latest()->get();
        $subjects = Student_subject::latest()->get();
        $students = Student::latest()->get();

        return view('Backend.Pages.Student.Exam.Create_result', compact('sections', 'subjects', 'students'));
    }
    public function result_report()
    {
        $sections = Section::latest()->get();
        $subjects = Student_subject::latest()->get();
        $students = Student::latest()->get();
        return view('Backend.Pages.Student.Exam.Result.Result', compact('students', 'sections', 'subjects'));
    }
    public function result_card_print($exam_id, $student_ids)
    {
        $student_ids = explode(',', $student_ids);

        $results = Student_exam_result::with('student', 'subject', 'class', 'section', 'exam')->whereIn('student_id', $student_ids)->where('exam_id', $exam_id)->get()->groupBy('student_id');
        /*Highest Marks*/
        $highest_marks = Student_exam_result::where('exam_id', $exam_id)->select('subject_id', DB::raw('MAX(written_marks + objective_marks + practical_marks) as highest'))->groupBy('subject_id')->pluck('highest', 'subject_id');
        //return $results;

        return view('Backend.Pages.Student.Exam.Result.Print', compact('results', 'highest_marks'));
    }

    public function result_store(Request $request)
    {
        /*Validate the form data*/
        // $this->validateForm($request);
        $examData = $request->all();
        foreach ($examData['results'] as $result) {
            if (!empty($result['written_marks']) || !empty($result['objective_marks']) || !empty($result['prectial_marks']) || $result['is_absent'] == '1') {
                $examResult = Student_exam_result::where([['exam_id', '=', $request->exam_id], ['class_id', '=', $request->class_id], ['section_id', '=', $request->section_id], ['student_id', '=', $result['student_id']], ['subject_id', '=', $request->subject_id]])->first();

                /*If not found, create a new instance*/
                if (!$examResult) {
                    $examResult = new Student_exam_result();
                }
                $examResult->exam_id = $request->exam_id;
                $examResult->class_id = $request->class_id;
                $examResult->section_id = $request->section_id;
                $examResult->student_id = $result['student_id'];
                $examResult->subject_id = $request->subject_id;

                $examResult->practical_marks = $result['prectial_marks'] ?? 0;
                $examResult->objective_marks = $result['objective_marks'] ?? 0;
                $examResult->written_marks = $result['written_marks'] ?? 0;

                /* Absent Student Check */
                $examResult->is_absent = isset($result['is_absent']) && $result['is_absent'] == '1' ? 1 : 0;
                /* Save to the database table*/
                $examResult->save();
            }
        }
        return response()->json([
            'success' => true,
            'message' => 'Added successfully!',
        ]);
    }

    public function result_search_before_upload(Request $request)
    {
        /* Get all students of the class, section*/
        $students = Student::where('current_class', $request->class_id)->where('section_id', $request->section_id)->get();
        $results = Student_exam_result::where('exam_id', $request->exam_id)->where('class_id', $request->class_id)->where('section_id', $request->section_id)->where('subject_id', $request->subject_id)->get()->keyBy('student_id');

        // Attach result data to each student
        $data = $students->map(function ($student) use ($results) {
            $result = $results->get($student->id);

            return [
                'id' => $student->id,
                'name' => $student->name,
                'roll_no' => $student->roll_no,
                'is_absent' => $result->is_absent ?? 0,
                'written_marks' => $result ? (float) $result->written_marks : null,
                'objective_marks' => $result ? (float) $result->objective_marks : null,
                'practical_marks' => $result ? (float) $result->practical_marks : null,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function trabulation_sheet()
    {
        $sections = Section::latest()->get();
        $subjects = Student_subject::latest()->get();
        $students = Student::latest()->get();
        $exam = Student_exam::latest()->get();
        return view('Backend.Pages.Student.Exam.Result.trabulation_sheet', compact('students', 'sections', 'subjects', 'exam'));
    }
    public function trabulation(Request $request)
    {
        $examResults = Student_exam_result::with('student', 'subject', 'class', 'section', 'exam')->where('exam_id', $request->exam_id)->where('class_id', $request->class_id)->get()->groupBy('student_id');

        $subjects = Student_subject::where('class_id', $request->class_id)->get();

        $html = '<table class="table table-bordered table-hover table-condensed mb-none">
    <thead style="background: #f4f4f4; font-family: sans-serif;">
        <tr style="text-align: center; font-weight: bold; font-size: 14px;">
            <th rowspan="2" style="vertical-align: middle;">Sl</th>
            <th rowspan="2" style="vertical-align: middle;">Student Name</th>
            <th rowspan="2" style="vertical-align: middle;">Roll</th>';

        foreach ($subjects as $subject) {
            $html .= "<th colspan='5' style='text-align: center; background: #e0e0e0;'>{$subject->name}</th>";
        }

        $html .= '
            <th rowspan="2" style="vertical-align: middle;">Total Marks</th>
            <th rowspan="2" style="vertical-align: middle;">GPA</th>
            <th rowspan="2" style="vertical-align: middle;">P/F</th>
            <th rowspan="2" style="vertical-align: middle;">Result</th>
            <th rowspan="2" style="vertical-align: middle;">Position</th>
        </tr>
        <tr style="text-align: center; font-size: 12px;">';

        foreach ($subjects as $subject) {
            $html .= '<th>Wr</th><th>Ob</th><th>Pr</th><th>To</th><th>Gp</th>';
        }

        $html .= '</tr>
    </thead>
    <tbody>';

        $sl = 1;
        foreach ($examResults as $studentId => $results) {
            $student = $results->first()->student;

            $html .= '<tr>';
            $html .= '<td>' . $sl++ . '</td>';
            $html .= '<td>' . $student->name . '</td>';
            $html .= '<td>' . $student->roll_no . '</td>';

            $totalMarks = 0;
            $totalPoints = 0;
            $fullMarks = 0;
            $subjectCount = 0;
            $isFail = false;

            foreach ($results as $item) {
                $written_marks = intval($item->written_marks ?? 0);
                $objective_marks = intval($item->objective_marks ?? 0);
                $practical_marks = intval($item->practical_marks ?? 0);

                $total_marks = $written_marks + $objective_marks + $practical_marks;
                $gpa = $this->get_gpa_from_marks($total_marks);
                if ($gpa < 1) {
                    $isFail = true;
                }
                $totalMarks += $total_marks;
                $totalPoints += $gpa;
                $subjectCount++;
                $html .= "<td>{$written_marks}</td><td>{$objective_marks}</td><td>{$practical_marks}</td><td>{$total_marks}</td><td>" . number_format($gpa, 2) . '</td>';
            }

            if ($isFail) {
                $finalGpa = 0;
            }

            /** Pass Count */
            $passCount = $results
                ->filter(function ($item) {
                    $total = intval($item->written_marks ?? 0) + intval($item->objective_marks ?? 0) + intval($item->practical_marks ?? 0);
                    return $total >= 33; //33 is a pass mark
                })
                ->count();

            $resultStatus = $isFail ? '<span class="label label-danger">FAIL</span>' : '<span class="label label-primary">PASS</span>';

            $html .= '<td>' . $totalMarks . '</td>';
            $html .= '<td>' . number_format($finalGpa, 2) . '</td>';
            $html .= '<td>' . $passCount . '/' . $subjectCount . '</td>';
            $html .= '<td>' . $resultStatus . '</td>';
            $html .= '<td> - </td>';
            $html .= '</tr>';
        }

        $html .= '</tbody></table>';

        return $html;
    }
    function get_gpa_from_marks($marks)
    {
        if ($marks >= 80) {
            return 5.0;
        } elseif ($marks >= 70) {
            return 4.0;
        } elseif ($marks >= 60) {
            return 3.5;
        } elseif ($marks >= 50) {
            return 3.0;
        } elseif ($marks >= 40) {
            return 2.0;
        } elseif ($marks >= 33) {
            return 1.0;
        } else {
            return 0.0;
        }
    }

    public function merit_list_sheet()
    {
        $sections = Section::latest()->get();
        $subjects = Student_subject::latest()->get();
        $students = Student::latest()->get();
        $exam = Student_exam::latest()->get();
        return view('Backend.Pages.Student.Exam.Result.merit_list', compact('students', 'sections', 'subjects', 'exam'));
    }

    public function delete(Request $request)
    {
        $object = Student_exam_result::find($request->id);

        if (empty($object)) {
            return response()->json(['error' => 'Not found.'], 404);
        }

        /* Delete it From Database Table */
        $object->delete();

        return response()->json(['success' => true, 'data' => $object, 'message' => 'Deleted successfully.']);
    }
    public function edit($id)
    {
        $data = Student_exam_result::find($id);
        $sections = Section::latest()->get();
        $subjects = Student_subject::latest()->get();
        $students = Student::latest()->get();
        return view('Backend.Pages.Student.Exam.Result_update', compact('data', 'sections', 'subjects', 'students'));
    }

    public function update(Request $request)
    {
        $this->validateForm($request);

        $object = Student_exam_result::findOrFail($request->id);
        $object->exam_id = $request->exam_id;
        $object->class_id = $request->class_id;
        $object->section_id = $request->section_id;
        $object->student_id = $request->student_id;
        $object->subject_id = $request->subject_id;
        $object->marks_obtained = $request->marks_obtained;
        $object->total_marks = $request->total_marks;
        $object->grade = $request->grade;
        $object->remarks = $request->remarks;
        $object->update();

        return response()->json([
            'success' => true,
            'message' => 'Update successfully!',
        ]);
    }
    public function get_exam_result(Request $request)
    {
        $query = Student_exam_result::query();
        if ($request->class_id) {
            $query->where('class_id', $request->class_id);
        }

        if ($request->exam_id) {
            $query->where('exam_id', $request->exam_id);
        }

        if ($request->student_id) {
            $query->where('student_id', $request->student_id);
        }
        if ($request->roll_no) {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('roll_no', $request->roll_no);
            });
        }

        /* Load related models*/
        $data = $query->with(['exam', 'student', 'subject', 'class', 'section'])->get();

        /*Check if data exists*/
        if ($data->isNotEmpty()) {
            return response()->json([
                'success' => true,
                'data' => $data,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No results found.',
        ]);
    }

    private function validateForm($request)
    {
        /*Validate the form data*/
        $rules = [
            'exam_id' => 'required|exists:student_exams,id',
            'class_id' => 'required|exists:student_classes,id',
            'section_id' => 'required|exists:sections,id',
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:student_subjects,id',
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
