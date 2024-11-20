<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_exam_routine extends Model
{
    use HasFactory;
    protected $fillable = [
        'exam_id',
        'class_id',
        'subject_id',
        'exam_date',
        'start_time',
        'end_time',
        'room_number',
        'invigilator'
    ];
    public function exam(){
        return $this->belongsTo(Student_exam::class);
    }
    public function class(){
        return $this->belongsTo(Student_class::class);
    }
    public function subject(){
        return $this->belongsTo(Student_subject::class);
    }
}
