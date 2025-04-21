<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_lesson extends Model
{
    use HasFactory;
    public function currentClass()
    {
        return $this->belongsTo(Student_class::class, 'class_id');
    }
    public function section(){
        return $this->belongsTo(Section::class, 'section_id','id');
    }
    public function previousClass()
    {
        return $this->belongsTo(Student_class::class, 'previous_class');
    }
    public function subject(){
        return $this->belongsTo(Student_subject::class, 'subject_id');
    }
    public function teacher(){
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
