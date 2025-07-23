<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Send_message extends Model
{
    use HasFactory;
    public function student(){
        return $this->belongsTo(Student::class,'student_id', 'id');
    }
    public function section(){
        return $this->belongsTo(Section::class,'section_id', 'id');
    }
}
