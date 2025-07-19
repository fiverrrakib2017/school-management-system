<?php

namespace App\Console\Commands;

use App\Models\Student;
use App\Models\Student_attendance;
use App\Models\Student_leave;
use App\Models\Teacher;
use App\Models\Teacher_attendance;
use App\Services\ZktecoService;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

use function App\Helpers\send_message;

class transaction_sync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:transaction_sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Transaction sync Started.');
        $this->process_transaction(Student::class, Student_attendance::class, 'student_id');
        $this->process_transaction(Teacher::class, Teacher_attendance::class, 'teacher_id');
        $this->info('Transaction sync End.');
    }
    protected function process_transaction($model, $attendanceModel, $relationKey){
        $transactions = ZktecoService::get_today_transactions();
        $today = now()->format('Y-m-d');

        foreach ($transactions as $trx) {
            $empCode = $trx['emp_code'];
            $punchTime = Carbon::parse($trx['punch_time'])->format('H:i:s');

            $person = $model::where('code', $empCode)->first();
            if (!$person) continue;

            $attendance = $attendanceModel::firstOrNew([
                $relationKey => $person->id,
                'attendance_date' => $today,
            ]);
            $_is_new_entry =false;
            if (!$attendance->exists) {
                $attendance->shift_id = 1;
                $attendance->status = 'Present';
                $attendance->time_in = $punchTime;
                $_is_new_entry =true;
            } else {
                if (is_null($attendance->time_out)) {
                    if ($punchTime > $attendance->time_in) {
                        $attendance->time_out = $punchTime;
                    }
                } else {
                    if ($punchTime > $attendance->time_out) {
                        $attendance->time_out = $punchTime;
                    }
                }
            }

            $attendance->save();
            /*send sms notification*/
             if ($model === Student::class && $_is_new_entry) {
                $this->send_student_sms_notification($attendance);
            }
        }
    }
    protected function send_student_sms_notification($student_attendance) {
        /*Sms Settings Check*/
        $sms_settings = \App\Models\Zkteco_sms_settings::first();
        if(!$sms_settings || !$sms_settings->sms_enable || !$sms_settings->on_present) {
            return;
        }
         /*Get Sms Template*/
        $template = $sms_settings->present_template ?? 'Dear {name}, you have been marked present at {time}.';
        $message = str_replace(['{name}', '{date}' , '{time}'], [$student_attendance->student->name , $student_attendance->attendance_date, $student_attendance->time_in], $template);
        $this->info('Send Sms to ' . $student_attendance->student->phone . ' - ' . $message);
        send_message($student_attendance->student->phone, $message);
    }
    // protected function _transaction(){

    //     /***GET Zkteco Transaction Data****/
    //     $transactions = ZktecoService::get_today_transactions();

    //     $today = now()->format('Y-m-d');

    //     foreach ($transactions as $trx) {
    //         $empCode = $trx['emp_code'];
    //         $punchTime = Carbon::parse($trx['punch_time'])->format('H:i:s');

    //         $student = Student::where('code', $empCode)->first();
    //         if (!$student) continue;

    //         $attendance = Student_attendance::firstOrNew([
    //             'student_id' => $student->id,
    //             'attendance_date' => $today,
    //         ]);

    //          if (!$attendance->exists) {
    //             $attendance->shift_id = 1;
    //             $attendance->status = 'Present';
    //             $attendance->time_in = $punchTime;
    //         } else {
    //             if (is_null($attendance->time_out)) {
    //                 if ($punchTime > $attendance->time_in) {
    //                     $attendance->time_out = $punchTime;
    //                 }
    //             } else {
    //                 if ($punchTime > $attendance->time_out) {
    //                     $attendance->time_out = $punchTime;
    //                 }
    //             }
    //         }

    //         $attendance->save();
    //     }

    //     /*Handle Absent Student*/
    //     // $markedStudentIds = Student_attendance::where('attendance_date', $today)->pluck('student_id')->toArray();
    //     // $allStudentIds = Student::pluck('id')->toArray();

    //     // $absentees = array_diff($allStudentIds, $markedStudentIds);

    //     // foreach ($absentees as $studentId) {
    //     //     $onLeave = Student_leave::where('student_id', $studentId)
    //     //         ->where('leave_status', 'approved')
    //     //         ->where('start_date', '<=', $today)
    //     //         ->where('end_date', '>=', $today)
    //     //         ->exists();

    //     //     Student_attendance::create([
    //     //         'student_id' => $studentId,
    //     //         'attendance_date' => $today,
    //     //         'shift_id' => 1,
    //     //         'status' => $onLeave ? 'Leave' : 'Absent',
    //     //     ]);
    //     // }
    // }
}
