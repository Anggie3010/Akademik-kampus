<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Course;

class Enrollment extends Model
{
    protected $table = 'enrollments';

    protected $fillable = [
        'student_id',
        'course_id',
        'grade',
        'attendance',
        'status',
    ];

    /**
     * Relasi ke model Student
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    /**
     * Relasi ke model Course
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
