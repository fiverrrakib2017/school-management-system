<?php

namespace App\Http\Controllers\Backend\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\Teacher_attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TeacherAttendance_controller extends Controller
{
    public function index()
    {
      
       return view('Backend.Pages.Teacher.Attendance.index');
    }
    public function all_data(Request $request){
        $search = $request->search['value'];
        $columnsForOrderBy = ['id', 'name', 'phone','subject','designation','created_at'];
        $orderByColumn = $columnsForOrderBy[$request->order[0]['column']];
        $orderDirection = $request->order[0]['dir'];
    
        $query = Teacher::when($search, function ($query) use ($search) {

            $query->where('name', 'like', "%$search%")
                  ->orWhere('phone', 'like', "%$search%")
                  ->orWhere('designation', 'like', "%$search%")
                  ->orWhere('subject', 'like', "%$search%");
                //   ->orWhereHas('currentClass', function ($query) use ($search) {
                //       $query->where('name', 'like', "%$search%");
                //   })
                //   ->orWhereHas('section', function ($query) use ($search) {
                //       $query->where('name', 'like', "%$search%");
                //   });
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
        $studentIds = $request->input('student_ids');
    
        if (!empty($studentIds)) {
            foreach ($studentIds as $studentId) {

                $object = new Teacher_attendance();
                $object->teacher_id = $studentId;
                $object->attendance_date =now();
                $object->shift_id = NULL;
                $object->time_in = Carbon::now()->format('H:i:s'); 
                $object->time_out = Carbon::now()->format('H:i:s'); 
                $object->status ='Present';
                /*Save to the database table*/
                $object->save();


            }
            return response()->json([
                'success' => true,
                'message' => 'Completed'
            ]);
        }
        return response()->json([
            'success'=>false,
            'message' => 'No Teacher selected.'
        ], 400);
    }
    
   

    public function attendance_log(){
        return view('Backend.Pages.Teacher.Attendance.Log');
    }
    public function attendance_log_all_data(Request $request) {
        $search = $request->search['value'];
        
        $columnsForOrderBy = ['id', 'teacher.name', 'teacher.phone','teacher.subject', 'teacher.designation', 'status','attendance_date', 'time_in', 'created_at'];
        $orderByColumn = $columnsForOrderBy[$request->order[0]['column']];
        $orderDirection = $request->order[0]['dir'];
    
        $query = Teacher_attendance::with('teacher')
            ->when($search, function ($query) use ($search) {
                $query->where('status', 'like', "%$search%")
                    ->orWhere('attendance_date', 'like', "%$search%")
                    ->orWhere('time_in', 'like', "%$search%")
                    ->orWhereHas('teacher', function ($query) use ($search) {
                        $query->where('name', 'like', "%$search%");
                    })
                    ->orWhereHas('teacher', function ($query) use ($search) {
                        $query->where('subject', 'like', "%$search%");
                    })
                    ->orWhereHas('teacher', function ($query) use ($search) {
                        $query->where('designation', 'like', "%$search%");
                    })
                    ->orWhereHas('teacher', function ($query) use ($search) {
                        $query->where('phone', 'like', "%$search%");
                    });
            });
    
        if ($request->has('date_range') && !empty($request->date_range)) {
            $dateRange = explode(' - ', $request->date_range);
            $startDate = trim($dateRange[0]);
            $endDate = trim($dateRange[1]);
            $query->whereBetween('attendance_date', [$startDate, $endDate]);
        }
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
}