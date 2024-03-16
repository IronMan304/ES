<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentSubjectKey extends Model
{
    use HasFactory;
    protected $table = 'student_subject_key';
    protected $primaryKey = 'id';
    protected $fillable = [
        'student_id',
        'subject_id',
        'first_grading_grade',
        'second_grading_grade',
        'third_grading_grade',
        'fourth_grading_grade',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }
}
