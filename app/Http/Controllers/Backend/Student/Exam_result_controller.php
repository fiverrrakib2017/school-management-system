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

        $results = Student_exam_result::with(['student.currentClass', 'student.section', 'subject', 'class', 'section', 'exam'])
            ->whereIn('student_id', $student_ids)
            ->where('exam_id', $exam_id)
            ->get()
            ->groupBy('student_id');

        $highest_marks = Student_exam_result::where('exam_id', $exam_id)->select('subject_id', DB::raw('MAX(written_marks + objective_marks + practical_marks) as highest'))->groupBy('subject_id')->pluck('highest', 'subject_id');

        $first_student = $results->first()->first()->student;

        $routines = DB::table('student_exam_routines')->where('exam_id', $exam_id)->where('class_id', $first_student->currentClass->id)->where('section_id', $first_student->section_id)->get()->keyBy('subject_id');

        return view('Backend.Pages.Student.Exam.Result.Print', compact('results', 'highest_marks', 'routines'));
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

        $students = Student::where('current_class', $request->class_id)
        ->where('section_id', $request->section_id)
        ->orderBy('roll_no', 'asc')
        ->get();

        $results = Student_exam_result::where('exam_id', $request->exam_id)->where('class_id', $request->class_id)->where('section_id', $request->section_id)->where('subject_id', $request->subject_id)->get()->keyBy('student_id');

        // Attach result data to each student
        $data = $students->map(function ($student) use ($results) {
            $result = $results->get($student->id);

            return [
                'id' => $student->id,
                'name' => $student->name,
                'roll_no' => $student->roll_no,
                'is_absent' => $result->is_absent ?? 0,
                'written_marks' => $result ? (float) $result->written_marks : 0,
                'objective_marks' => $result ? (float) $result->objective_marks : 0,
                'practical_marks' => $result ? (float) $result->practical_marks : 0,
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
        // Get exam results grouped by student_id
        $examResults = Student_exam_result::with('student', 'subject', 'class', 'section', 'exam')->where('exam_id', $request->exam_id)->where('class_id', $request->class_id)->where('section_id', $request->section_id)->get()->groupBy('student_id');

        // Get subjects for the class
        $subjects = Student_subject::where('class_id', $request->class_id)->where('section_id', $request->section_id)->get();
        /* Fetch routines for exam*/
        $routines = DB::table('student_exam_routines')->where('exam_id', $request->exam_id)->where('class_id', $request->class_id)->where('section_id', $request->section_id)->get()->keyBy('subject_id');
        if ($routines->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Routine not found',
            ]);
            exit();
        }
        /* Prepare position data array*/
        $positionData = [];
        foreach ($examResults as $studentId => $results) {
            $totalMarks = 0;
            $isFail = false;
            $subjectCount = 0;
            $totalPoints = 0;

            foreach ($results as $item) {
                // Get marks from the results
                $written = intval($item->written_marks ?? 0);
                $objective = intval($item->objective_marks ?? 0);
                $practical = intval($item->practical_marks ?? 0);
                $total = $written + $objective + $practical;

                /*Get routine for the subject*/
                $routine = $routines[$item->subject_id] ?? null;
                if ($routine === null) {
                    $gpa = 0;
                } else {
                    /* Calculate GPA based on available data*/
                    $gpa = $this->get_gpa_from_marks($written, $objective, $practical, $routine->written_pass, $routine->objective_pass, $routine->practical_pass, $routine->written_full, $routine->objective_full, $routine->practical_full);
                }

                $totalMarks += $total;
                $totalPoints += $gpa;
                $subjectCount++;

                /*Check if the student has failed in any subject*/
                if ($gpa < 1) {
                    $isFail = true;
                }
            }

            /*Calculate final GPA*/
            $finalGpa = $isFail ? 0 : $totalPoints / $subjectCount;

            /* Store position data*/
            $positionData[] = [
                'student_id' => $studentId,
                'totalMarks' => $totalMarks,
                'gpa' => round($finalGpa, 2),
            ];
        }

        /*Sort position data by total marks in descending order*/
        usort($positionData, function ($a, $b) {
            return $b['totalMarks'] <=> $a['totalMarks'];
        });

        /* Assign positions*/
        $positions = [];
        foreach ($positionData as $index => $data) {
            $positions[$data['student_id']] = $index + 1;
        }

        /* Generate HTML table*/
        $html = '<table class="table table-bordered table-hover table-condensed mb-none">
        <thead style="background: #f4f4f4; font-family: sans-serif;">
            <tr style="text-align: center; font-weight: bold; font-size: 14px;">
                <th rowspan="2" style="vertical-align: middle;">Sl</th>
                <th rowspan="2" style="vertical-align: middle;">Student Name</th>
                <th rowspan="2" style="vertical-align: middle;">Roll</th>';

        /* Add subject columns dynamically*/
        $get_subject_from_routine=Student_exam_routine::with('subject')->where('exam_id', $request->exam_id)->where('class_id', $request->class_id)->where('section_id', $request->section_id)->get();

        foreach ($get_subject_from_routine as $item) {
            $html .= "<th colspan='5' style='text-align: center; background: #e0e0e0;'>{$item->subject->name}</th>";
        }

        $html .= '
            <th rowspan="2" style="vertical-align: middle;">Total Marks</th>
            <th rowspan="2" style="vertical-align: middle;">GPA</th>
            <th rowspan="2" style="vertical-align: middle;">P/F</th>
            <th rowspan="2" style="vertical-align: middle;">Result</th>
            <th rowspan="2" style="vertical-align: middle;">Position</th>
        </tr>
        <tr style="text-align: center; font-size: 12px;">';

        /*Add subcolumns for each subject (marks breakdown)*/
        foreach ($get_subject_from_routine as $item) {
            $html .= '<th>Wr</th><th>Ob</th><th>Pr</th><th>To</th><th>Gp</th>';
        }

        $html .= '</tr></thead><tbody>';

        /*Add student data in table rows*/
        $sl = 1;
        foreach ($examResults as $studentId => $results) {
            $student = $results->first()->student;
            $totalMarks = 0;
            $isFail = false;
            $totalPoints = 0;
            $subjectCount = 0;
            $passCount = 0;

            $html .= '<tr>';
            $html .= '<td>' . $sl++ . '</td>';
            $html .= '<td>' . $student->name . '</td>';
            $html .= '<td>' . $student->roll_no . '</td>';

            foreach ($subjects as $subject) {
                $item = $results->firstWhere('subject_id', $subject->id);

                if ($item) {
                    if ($item->is_absent == 1) {
                        $html .= '<td colspan="5" style="text-align: center; color: red;">Absent</td>';
                        $isFail = true;
                        $subjectCount++;
                    } else {
                        $written = intval($item->written_marks ?? 0);
                        $objective = intval($item->objective_marks ?? 0);
                        $practical = intval($item->practical_marks ?? 0);
                        $total = $written + $objective + $practical;

                        /*Get routine for the subject*/
                        $routine = $routines[$subject->id] ?? null;
                        if ($routine === null) {
                            $gpa = 0;
                        } else {
                            $gpa = $this->get_gpa_from_marks($written, $objective, $practical, $routine->written_pass, $routine->objective_pass, $routine->practical_pass, $routine->written_full, $routine->objective_full, $routine->practical_full);
                        }

                        $totalMarks += $total;
                        $totalPoints += $gpa;
                        $subjectCount++;

                        if ($gpa < 1) {
                            $isFail = true;
                        } else {
                            $passCount++;
                        }

                        $html .= "<td>{$written}</td><td>{$objective}</td><td>{$practical}</td><td>{$total}</td><td>" . number_format($gpa, 2) . '</td>';
                    }
                } else {
                    $html .= '<td colspan="5" style="text-align: center; color: gray;">N/A</td>';
                }
            }

            $finalGpa = $subjectCount > 0 ? ($isFail ? 0 : $totalPoints / $subjectCount) : 0;
            $resultStatus = $isFail ? '<span class="label label-danger">FAIL</span>' : '<span class="label label-primary">PASS</span>';
            $position = $positions[$studentId] ?? '-';
            $failCount = $subjectCount - $passCount;
            $html .= '<td>' . $totalMarks . '</td>';
            $html .= '<td>' . number_format($finalGpa, 2) . '</td>';
            $html .= '<td>' . $passCount . '/' . $failCount . '</td>';
            $html .= '<td>' . $resultStatus . '</td>';
            $html .= '<td>' . $position . '</td>';
            $html .= '</tr>';
        }

        $html .= '</tbody></table>';

        return $html;
    }

    function get_gpa_from_marks($written = null, $objective = null, $practical = null, $written_pass, $objective_pass = null, $practical_pass = null, $written_full_marks = null, $objective_full_marks = null, $practical_full_marks = null)
    {
        $is_fail = false;

        if (($written !== null && $written < $written_pass) || ($objective !== null && $objective < $objective_pass) || ($practical !== null && $practical < $practical_pass)) {
            $is_fail = true;
        }
        if (!$is_fail) {
            $total_marks = 0;
            $total_full_marks = 0;

            if ($written !== null) {
                $total_marks += $written;
                $total_full_marks += $written_full_marks;
            }
            if ($objective !== null) {
                $total_marks += $objective;
                $total_full_marks += $objective_full_marks;
            }
            if ($practical !== null) {
                $total_marks += $practical;
                $total_full_marks += $practical_full_marks;
            }

            /* Calculate percentage*/
            if ($total_full_marks > 0) {
                $percentage = ($total_marks / $total_full_marks) * 100;
            } else {
                $percentage = 0;
            }

            // Return GPA based on percentage
            if ($percentage >= 80) {
                return 5.0;
            } elseif ($percentage >= 70) {
                return 4.0;
            } elseif ($percentage >= 60) {
                return 3.5;
            } elseif ($percentage >= 50) {
                return 3.0;
            } elseif ($percentage >= 40) {
                return 2.0;
            } elseif ($percentage >= 33) {
                return 1.0;
            } else {
                return 0.0;
            }
        } else {
            return 0.0;
        }
    }

    public function show_merit_list(Request $request)
    {
        $examResults = Student_exam_result::with('student')->where('exam_id', $request->exam_id)->where('class_id', $request->class_id)->where('section_id', $request->section_id)->get()->groupBy('student_id');

        /* Fetch routines for exam*/
        $routines = DB::table('student_exam_routines')->where('exam_id', $request->exam_id)->where('class_id', $request->class_id)->where('section_id', $request->section_id)->get()->keyBy('subject_id');

        $positionData = [];

        foreach ($examResults as $studentId => $results) {
            $totalMarks = 0;
            $isFail = false;
            $subjectCount = 0;
            $totalPoints = 0;

            foreach ($results as $item) {
                if ($item->absent == 1) {
                    $isFail = true;
                    $subjectCount++;
                    continue;
                }

                $written = intval($item->written_marks ?? 0);
                $objective = intval($item->objective_marks ?? 0);
                $practical = intval($item->practical_marks ?? 0);
                $total = $written + $objective + $practical;

                /*Get routine for the subject*/
                $routine = $routines[$item->subject_id] ?? null;
                if ($routine === null) {
                    $gpa = 0;
                } else {
                    /* Calculate GPA based on available data*/
                    $gpa = $this->get_gpa_from_marks($written, $objective, $practical, $routine->written_pass, $routine->objective_pass, $routine->practical_pass, $routine->written_full, $routine->objective_full, $routine->practical_full);
                }

                $totalMarks += $total;
                $totalPoints += $gpa;
                $subjectCount++;

                if ($gpa < 1) {
                    $isFail = true;
                }
            }

            $gpaFinal = $subjectCount > 0 ? ($isFail ? 0 : $totalPoints / $subjectCount) : 0;

            $positionData[] = [
                'student_id' => $studentId,
                'name' => $results->first()->student->name,
                'roll' => $results->first()->student->roll_no,
                'totalMarks' => $totalMarks,
                'gpa' => round($gpaFinal, 2),
                'is_fail' => $isFail,
            ];
        }

        /*Sort by total marks descending*/
        usort($positionData, function ($a, $b) {
            return $b['totalMarks'] <=> $a['totalMarks'];
        });

        /*Assign merit position*/
        foreach ($positionData as $index => &$data) {
            $data['position'] = $index + 1;
        }

        /* Generate HTML table*/
        $html = '<table class="table table-bordered table-hover table-striped text-center align-middle">
        <thead>
            <tr>
                <th rowspan="2">Sl</th>
                <th rowspan="2">Student Name</th>
                <th rowspan="2">Roll</th>
                <th rowspan="2">Total Marks</th>
                <th rowspan="2">Merit Position</th>
                <th rowspan="2">GPA</th>
                <th rowspan="2">Result</th>
            </tr>
        </thead>
        <tbody>';

        $sl = 1;
        foreach ($positionData as $student) {
            $html .= '<tr>';
            $html .= '<td>' . $sl++ . '</td>';
            $html .= '<td>' . $student['name'] . '</td>';
            $html .= '<td>' . $student['roll'] . '</td>';
            $html .= '<td>' . $student['totalMarks'] . '</td>';
            $html .= '<td>' . $student['position'] . '</td>';
            $html .= '<td>' . number_format($student['gpa'], 2) . '</td>';

            $html .= '<td>';
            if ($student['is_fail']) {
                $html .= '<span class="badge bg-danger">FAIL</span>';
            } else {
                $html .= '<span class="badge bg-success">PASS</span>';
            }
            $html .= '</td>';

            $html .= '</tr>';
        }

        $html .= '</tbody></table>';

        return $html;
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
