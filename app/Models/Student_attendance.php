<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_attendance extends Model
{
    use HasFactory;
    public function shift(){
        return $this->belongsTo(Student_shift::class,'shift_id','id');
    }
    public function student(){
        return $this->belongsTo(Student::class,'student_id','id');
    }
}
