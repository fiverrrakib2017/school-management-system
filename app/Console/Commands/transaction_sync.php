<?php

namespace App\Console\Commands;

use App\Models\Student;
use App\Models\Student_attendance;
use App\Models\Student_leave;
use App\Services\ZktecoService;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
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
        $this->_transaction();
        $this->info('Transaction sync End.');


    }
    protected function _transaction(){

        /***GET Zkteco Transaction Data****/
        $transactions = ZktecoService::get_today_transactions();

        $today = now()->format('Y-m-d');

        foreach ($transactions as $trx) {
            $empCode = $trx['emp_code'];
            $punchTime = Carbon::parse($trx['punch_time'])->format('H:i:s');

            $student = Student::where('code', $empCode)->first();
            if (!$student) continue;

            $attendance = Student_attendance::firstOrNew([
                'student_id' => $student->id,
                'attendance_date' => $today,
            ]);

            if (!$attendance->exists) {
                $attendance->shift_id = 1;
                $attendance->status = 'Present';
                $attendance->time_in = $punchTime;
                $attendance->time_out = $punchTime;
            } else {
                if ($punchTime > $attendance->time_out) {
                    $attendance->time_out = $punchTime;
                }
            }

            $attendance->save();
        }

        /*Handle Absent Student*/
        // $markedStudentIds = Student_attendance::where('attendance_date', $today)->pluck('student_id')->toArray();
        // $allStudentIds = Student::pluck('id')->toArray();

        // $absentees = array_diff($allStudentIds, $markedStudentIds);

        // foreach ($absentees as $studentId) {
        //     $onLeave = Student_leave::where('student_id', $studentId)
        //         ->where('leave_status', 'approved')
        //         ->where('start_date', '<=', $today)
        //         ->where('end_date', '>=', $today)
        //         ->exists();

        //     Student_attendance::create([
        //         'student_id' => $studentId,
        //         'attendance_date' => $today,
        //         'shift_id' => 1,
        //         'status' => $onLeave ? 'Leave' : 'Absent',
        //     ]);
        // }
    }
}
