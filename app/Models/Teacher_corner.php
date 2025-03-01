<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher_corner extends Model
{
    use HasFactory;
    protected $fillable = ['class_id','section_id','teacher_id','subject_id','lession'];
    public function class(){
        return $this->belongsTo(Student_class::class);
    }
    public function section(){
        return $this->belongsTo(Section::class);
    }
    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
    public function subject(){
        return $this->belongsTo(Student_subject::class);
    }
}
